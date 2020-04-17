<template>
	<v-dialog v-model="show" max-width="500px">
		<v-card class="mx-auto mt-5">
			<v-card-title>
				<h1 class="display-1">Login</h1>
			</v-card-title>

			<v-card-text>
				<v-form>
					<v-text-field label="Username" prepend-icon="mdi-account-circle" autofocus />
					<v-text-field
						:type="showPassword ? 'text' : 'password'"
						label="Password"
						prepend-icon="mdi-lock"
						:append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
						@click:append="showPassword = !showPassword"
					/>
				</v-form>
			</v-card-text>

			<v-card-actions>
				<v-btn color="success">Register</v-btn>
				<v-spacer></v-spacer>
				<v-btn color="info">Login</v-btn>
			</v-card-actions>
		</v-card>
	</v-dialog>
</template>
<script>
export default {
	data: () => ({
		dialog: false,
		showPassword: false
	}),
	props: {
		value: Boolean
	},
	computed: {
		show: {
			get() {
				return this.value;
			},
			set(value) {
				this.$emit("input", value);
			}
		}
	}
};
</script>