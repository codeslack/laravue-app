<template>
	<v-app>
		<v-app-bar app color="primary" dark>
			<v-app-bar-nav-icon></v-app-bar-nav-icon>
			<v-toolbar-title>Code Slack</v-toolbar-title>
			<v-spacer></v-spacer>
			<v-btn
				v-for="link in links"
				:key="link"
				color="white"
				text
				rounded
				class="d-none d-sm-flex my-2"
			>{{ link }}</v-btn>
		</v-app-bar>

		<v-content>
			<v-container fluid>
				<router-link tab="li" to="/">Home</router-link>
				<router-link tab="li" to="/about">About</router-link>
				<router-view></router-view>
			</v-container>
		</v-content>

		<v-footer color="primary lighten-1" padless>
			<v-row justify="center" no-gutters>
				<v-btn v-for="link in links" :key="link" color="white" text rounded class="my-2">{{ link }}</v-btn>
				<v-col class="primary lighten-2 py-4 text-center white--text" cols="12">
					{{ new Date().getFullYear() }} —
					<strong>CodeSlack</strong>
				</v-col>
			</v-row>
		</v-footer>
	</v-app>
</template>

<script>
export default {
	name: "App",
	data: () => ({
		showPassword: false,
		links: ["Home", "About Us", "Team", "Contact Us", "Login"]
	})
};
</script>
