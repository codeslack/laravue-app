<template>
	<v-fab-transition>
		<v-btn
			fab
			small
			dark
			fixed
			bottom
			right
			color="red"
			class="mb-8"
			v-show="fab"
			@click="toTop"
			v-scroll="onScroll"
		>
			<v-icon>mdi-chevron-up</v-icon>
		</v-btn>
	</v-fab-transition>
</template>

<script>
export default {
	name: "AppFab",

	data: () => ({
		fab: false
	}),

	methods: {
		onScroll(e) {
			if (typeof window === "undefined") return;
			const top = window.pageYOffset || e.target.scrollTop || 0;
			this.fab = top > 300;
		},
		toTop() {
			this.$router.push({ hash: "" });
			this.$vuetify.goTo(0);
		}
	}
};
</script>
