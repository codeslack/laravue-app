<template>
	<div class="app-root">
		<router-view></router-view>
		<confirm ref="confirm"></confirm>
		<dialog-loader ref="dialogLoader"></dialog-loader>
	</div>
</template>
<script>
import DialogLoader from "./components/DialogLoader";
import Confirm from "./components/Confirm";
export default {
	components: {
		Confirm,
		DialogLoader
	},
	mounted() {
		this.$root.$confirm = this.$refs.confirm.open;
		this.$root.$dialogLoader = this.$refs.dialogLoader;
	},
	created: function() {
		this.$http.interceptors.response.use(undefined, function(err) {
			console.log("Request Interceptor", err);
			return new Promise(function(resolve, reject) {
				if (
					err.status === 401 &&
					err.config &&
					!err.config.__isRetryRequest
				) {
					this.$store.dispatch(logout);
				}
				throw err;
			});
		});
	}
};
</script>