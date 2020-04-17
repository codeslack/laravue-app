<template>
    <v-form @submit.prevent="login">
        <v-text-field
            v-model="email"
            label="User email"
            prepend-icon="mdi-account-circle"
            autofocus
            :error-messages="emailErrors"
            @input="$v.email.$touch()"
            @blur="$v.email.$touch()"
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
            @input="$v.password.$touch()"
            @blur="$v.password.$touch()"
            required
            dark
        />

        <div class="d-flex flex-row" flat tile>
            <v-checkbox dark label="Remember Me"></v-checkbox>
            <v-spacer></v-spacer>
            <v-chip
                class="mt-5 ma-2"
                text-color="white"
                outlined
                dark
                to="/auth/forgot"
            >
                Forgot Password?
                <v-icon right>mdi-account-question-outline</v-icon>
            </v-chip>
        </div>

        <v-card-actions>
            <v-btn
                color="#4dc0b5"
                class="ma-2"
                :loading="loading"
                :disabled="loading"
                block
                type="submit"
                dark
                text-color="white"
                >Login</v-btn
            >
        </v-card-actions>
    </v-form>
</template>
<script>
import { required, minLength, email } from "vuelidate/lib/validators";
export default {
    data() {
        return {
            loading: false,
            showPassword: false,
            email: "user@me.com",
            password: "password"
        };
    },
    validations: {
        password: {
            required,
            minLength: minLength(8)
        },
        email: {
            required,
            email
        }
    },

    computed: {
        passwordErrors() {
            const errors = [];
            if (!this.$v.password.$dirty) return errors;

            !this.$v.password.minLength &&
                errors.push("Password must be at most 8 characters");
            !this.$v.password.required && errors.push("Password is required.");
            return errors;
        },
        emailErrors() {
            const errors = [];
            if (!this.$v.email.$dirty) return errors;
            !this.$v.email.email && errors.push("Must be valid e-mail");
            !this.$v.email.required && errors.push("E-mail is required");
            return errors;
        }
    },

    methods: {
        yourAction(resp) {
            if (resp) {
                if (resp.type === "admin") {
                    this.$router.push("/admin");
                } else if (resp.type === "user") {
                    this.$router.push("/dashboard");
                }
            }
        },
        login() {
            this.loading = true;
            this.$v.$touch();

            if (!this.$v.$error) {
                let email = this.email;
                let password = this.password;
                this.$store
                    .dispatch("login", { email, password })
                    .then(resp => {
                        let infos = resp.data;

                        if (infos.type === "admin") {
                            this.$router.push("/admin");
                        } else if (infos.type === "user") {
                            this.$router.push("/dashboard");
                        } else {
                            this.$router.push("/");
                        }
                    })
                    .catch(err => console.log(err))
                    .finally(() => {
                        this.loading = false;
                    });
            } else {
                this.loading = false;
            }
        }
    },
    mounted() {
        this.$store.dispatch("fetchAccessToken").then(resp => {
            this.yourAction(resp.data);
            return resp;
        });
    }
};
</script>
