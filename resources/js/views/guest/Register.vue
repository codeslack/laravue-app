<template>
	<v-form @submit.prevent="register">
		<v-text-field
			v-model="name"
			label="User name"
			prepend-icon="mdi-account-circle"
			autofocus
			:error-messages="nameErrors"
			@change="$v.name.$touch()"
			required
			dark
		/>
		<v-text-field
			v-model="email"
			label="User email"
			prepend-icon="mdi-email-outline"
			:error-messages="emailErrors"
			@change="$v.email.$touch()"
			required
			dark
		/>

		<v-text-field
			v-model="mobile"
			label="User mobile"
			prepend-icon="mdi-cellphone-iphone"
			:error-messages="mobileErrors"
			@change="$v.mobile.$touch()"
			required
			dark
		/>
		<v-text-field
			v-model="password"
			:type="showPassword ? 'text' : 'password'"
			label="Password"
			prepend-icon="mdi-lock"
			:append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
			@click:append="showPassword = !showPassword"
			:error-messages="passwordErrors"
			@change="$v.password.$touch()"
			required
			dark
		/>
		<v-text-field
			v-model="password_confirmation"
			type="password"
			label="Retype Password"
			prepend-icon="mdi-lock"
			:error-messages="passwordRepetErrors"
			@change="$v.password_confirmation.$touch()"
			required
			dark
		/>

		<div class="d-flex flex-row" flat tile>
			<v-chip class="ma-2" text-color="white" outlined dark to="/auth/login">
				Login
				<v-icon right>mdi-account-key</v-icon>
			</v-chip>
			<v-spacer></v-spacer>
			<v-chip class="ma-2" text-color="white" outlined dark to="/">
				Go Back
				<v-icon right>mdi-home-circle-outline</v-icon>
			</v-chip>
		</div>

		<v-card-actions>
			<v-btn
				color="#4dc0b5"
				class="ma-2"
				:loading="loading"
				:disabled="loading"
				block
				dark
				text-color="white"
				type="submit"
			>Register</v-btn>
		</v-card-actions>
	</v-form>
</template>
<script>
import {
	required,
	minLength,
	maxLength,
	numeric,
	email,
	sameAs
} from "vuelidate/lib/validators";
export default {
	data() {
		return {
			loader: null,
			loading: false,
			showPassword: false,
			name: "",
			email: "",
			mobile: "",
			password: "",
			password_confirmation: ""
		};
	},
	validations: {
		name: {
			required
		},
		mobile: {
			required,
			numeric,
			minLength: minLength(10),
			maxLength: maxLength(10)
		},
		password: {
			required,
			minLength: minLength(8)
		},
		password_confirmation: {
			sameAsPassword: sameAs("password")
		},
		email: {
			required,
			email,
			async isUnique(value) {
				if (value === "") return true;

				let response = await window.axios.post(
					"/auth/email-exist",
					{ email: value }
				);
				return response.data;
			}
		}
	},

	computed: {
		nameErrors() {
			const errors = [];
			if (!this.$v.name.$dirty) return errors;
			!this.$v.name.required && errors.push("Name is required");
			return errors;
		},

		mobileErrors() {
			const errors = [];
			if (!this.$v.mobile.$dirty) return errors;
			!this.$v.mobile.numeric &&
				errors.push("Mobile Number Accepts only numerics");
			!this.$v.mobile.minLength &&
				errors.push(
					"Requires entry to have a specified minimum 10 numeric value."
				);
			!this.$v.mobile.maxLength &&
				errors.push(
					"Requires entry to have a specified maximum 10 numeric value"
				);
			!this.$v.mobile.required && errors.push("Mobile is required");
			return errors;
		},

		emailErrors() {
			const errors = [];
			if (!this.$v.email.$dirty) return errors;
			!this.$v.email.isUnique &&
				errors.push("This email is already registered");

			!this.$v.email.email && errors.push("Must be valid e-mail");
			!this.$v.email.required && errors.push("E-mail is required");
			return errors;
		},
		passwordErrors() {
			const errors = [];
			if (!this.$v.password.$dirty) return errors;

			!this.$v.password.minLength &&
				errors.push("Password must be at most 8 characters");
			!this.$v.password.required && errors.push("Password is required.");
			return errors;
		},
		passwordRepetErrors() {
			const errors = [];
			if (!this.$v.password_confirmation.$dirty) return errors;

			!this.$v.password_confirmation.sameAsPassword &&
				errors.push("Passwords must be identical.");
			return errors;
		}
	},

	methods: {
		register() {
			this.$v.$touch();

			if (!this.$v.$error) {
				let postData = {
					name: this.name,
					mobile: this.mobile,
					email: this.email,
					password: this.password,
					password_confirmation: this.password_confirmation
				};

				this.$store
					.dispatch("register", postData)
					.then(resp => {
						this.$router.push("/");
					})
					.catch(err => console.log(err));
			}
		}
	},
	watch: {
		loader() {
			const l = this.loader;
			console.log("log", l);
			this[l] = !this[l];

			setTimeout(() => (this[l] = false), 3000);

			this.loader = null;
		}
	}
};
</script>