<template>
	<v-layout row class="align-center layout ml-2 px-4 pt-4 app--page-header">
		<div class="page-header-left">
			<h3 class="pr-3">{{ $route.meta.title || "" }}</h3>
		</div>
		<v-breadcrumbs :items="breadcrumbs">
			<template v-slot:divider>
				<v-icon>mdi-forward</v-icon>
			</template>
		</v-breadcrumbs>

		<v-spacer></v-spacer>
		<div class="page-header-right">
			<v-tooltip bottom>
				<template v-slot:activator="{ on }">
					<v-btn icon v-on="on">
						<v-icon class="text--secondary">mdi-refresh</v-icon>
					</v-btn>
				</template>
				<span>Refresh</span>
			</v-tooltip>
		</div>
	</v-layout>
</template>

<script>
export default {
	data() {
		return {
			title: "Dashboard",
			breadcrumbs: []
		};
	},
	watch: {
		"$route.path": function(newVal) {
			this.computeBreadcrumbs();
		}
	},
	methods: {
		computeBreadcrumbs() {
			let breadcrumbs = [
				{
					text: "Home",
					href: "/dashboard",
					disabled: false
				}
			];
			let appends = [];
			appends = this.$route.matched.map(item => {
				return {
					text: item.meta.title || "",
					href: item.path || "/dashboard",
					disabled: item.path === this.$route.path
				};
			});
			this.breadcrumbs = breadcrumbs.concat(appends);
		}
	},
	created() {
		this.computeBreadcrumbs();
	}
};
</script>
<style>
.disabled {
	color: grey;
	pointer-events: none;
	text-decoration: blink;
}
</style>
