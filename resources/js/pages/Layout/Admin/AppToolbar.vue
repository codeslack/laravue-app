<template>
	<v-app-bar app color="primary darken-1" dark>
		<v-app-bar-nav-icon @click="handleDrawerToggle"></v-app-bar-nav-icon>

		<v-text-field
			flat
			clearable
			rounded
			hide-details
			solo-inverted
			label="Search"
			prepend-inner-icon="mdi-magnify"
		></v-text-field>
		<div class="flex-grow-1"></div>

		<v-spacer></v-spacer>
		<v-toolbar-items>
			<v-btn icon href="#">
				<v-icon class="fa-2x">mdi-github-circle</v-icon>
			</v-btn>
			<v-btn icon @click="handleFullScreen()">
				<v-icon>mdi-fullscreen</v-icon>
			</v-btn>

			<v-menu
				offset-y
				origin="center center"
				class="elelvation-1"
				:nudge-bottom="1"
				transition="scale-transition"
			>
				<template v-slot:activator="{ on, attrs }">
					<v-btn icon text v-bind="attrs" v-on="on">
						<v-badge color="red" overlap>
							<span slot="badge">3</span>
							<v-icon medium>mdi-bell-outline</v-icon>
						</v-badge>
					</v-btn>
				</template>
				<notification-list></notification-list>
			</v-menu>

			<v-menu offset-y origin="center center" :nudge-bottom="1" transition="scale-transition">
				<template v-slot:activator="{ on, attrs }">
					<v-btn icon large text v-bind="attrs" v-on="on">
						<v-avatar size="30px">
							<img src="/assets/w4.jpg" alt="avatar" />
						</v-avatar>
					</v-btn>
				</template>
				<v-list class="pa-0">
					<v-list-item
						v-for="(item, index) in items"
						:to="!item.href ? { name: item.name } : null"
						:href="item.href"
						@click="item.click"
						ripple="ripple"
						:disabled="item.disabled"
						:target="item.target"
						rel="noopener"
						:key="index"
					>
						<v-list-item-action v-if="item.icon">
							<v-icon>{{ item.icon }}</v-icon>
						</v-list-item-action>
						<v-list-item-content>
							<v-list-item-title>{{ item.title }}</v-list-item-title>
						</v-list-item-content>
					</v-list-item>
				</v-list>
			</v-menu>
		</v-toolbar-items>
	</v-app-bar>
</template>
<script>
import NotificationList from "./../../../components/NotificationList";
import helpers from "./../../../plugins/helpers";
export default {
	name: "AppToolbar",
	components: {
		NotificationList
	},
	data() {
		return {
			items: [
				{
					icon: "mdi-account-circle",
					href: "#",
					title: "profile",
					click: this.handleProfile
				},
				{
					icon: "mdi-settings",
					href: "#",
					title: "settings",
					click: this.handleSetting
				},
				{
					icon: "mdi-fullscreen-exit",
					href: "#",
					title: "Logout",
					click: this.handleLogut
				}
			],

			links: [
				{ url: "h", icon: "mdi-bell", tip: "h1" },
				{ url: "h2", icon: "mdi-bell", tip: "h12" },
				{ url: "h3", icon: "mdi-bell", tip: "h13" }
			]
		};
	},
	computed: {
		toolbarColor() {
			// return this.$vuetify.options.extra.mainNav;
		}
	},
	methods: {
		handleDrawerToggle() {
			console.log("this is woking");
			this.$emit("side-icon-click");
		},
		handleFullScreen() {
			helpers.toggleFullScreen();
		},
		handleLogut() {
			//handle logout

			this.$store.dispatch("logout").then(() => {
				toastr["success"]("Successfully logout", "Success");
				this.$router.push("/");
			});
		},
		handleSetting() {},
		handleProfile() {}
	}
};
</script>

<style lang="stylus" scoped></style>
