<template>
	<v-app id="inspire" class="app guest">
		<app-toolbar />

		<div id="home" lang="en">
			<v-content>
				<router-view></router-view>
				<app-footer />
			</v-content>
		</div>
	</v-app>
</template>
<script>
import { AppToolbar, AppFooter } from "./index";

export default {
	components: {
		AppToolbar,
		AppFooter
	}
};
</script>