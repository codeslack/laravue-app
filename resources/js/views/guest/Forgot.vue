<template>
	<v-form>
		<v-text-field dark label="User email" prepend-icon="mdi-account-circle" autofocus />

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
				@click="register"
				block
				type="submit"
				dark
				text-color="white"
			>Send Link</v-btn>
		</v-card-actions>
	</v-form>
</template>
<script>
export default {
	data() {
		return {
			loader: null,
			loading: false,
			showPassword: false,
			valid: false,
			e1: false,
			password: "",
			passwordRules: [v => !!v || "Password is required"],
			email: "",
			emailRules: [
				v => !!v || "E-mail is required",
				v =>
					/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
					"E-mail must be valid"
			]
		};
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