<template>
	<v-toolbar color="#458ef7" dark>
		<v-toolbar-title>
			<v-btn to="/" text rounded>{{title}}</v-btn>
		</v-toolbar-title>
		<v-spacer></v-spacer>
		<v-btn
			v-for="link in links"
			:key="link.id"
			:to="link.path"
			text
			rounded
			class="d-none d-sm-flex my-2"
		>
			<v-icon>{{ link.icon }}</v-icon>
			{{ link.title }}
		</v-btn>
	</v-toolbar>
</template>

<script>
export default {
	data() {
		return {
			title: "Code Slack",
			links: [
				{
					id: 1,
					title: "About",
					path: "/about",
					icon: "mdi-flag"
				},
				{
					id: 2,
					title: "Contact",
					path: "/contact",
					icon: "mdi-phone"
				},
				{
					id: 3,
					title: "Blog",
					path: "/blog",
					icon: "mdi-account"
				},
				{
					id: 4,
					title: "Login",
					path: "/auth/login",
					icon: "mdi-lock"
				}
			]
		};
	}
};
</script>