<template>
	<v-dialog v-model="show" max-width="500px">
		<v-card>
			<v-card-actions>
				<v-btn color="primary" @click.stop="show=false">Close</v-btn>
			</v-card-actions>
		</v-card>
	</v-dialog>
</template>
<script>
export default {
	data: () => ({
		dialog: false
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