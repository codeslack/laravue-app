<template>
	<div id="pageAff">
		<v-container grid-list-xl fluid>
			<v-layout row wrap>
				<div>This is a Aff Birth</div>
				<v-btn @click="handelToaster">Toaster</v-btn>
			</v-layout>
		</v-container>
	</div>
</template>
<script>
import MiniStatistic from "./../../../components/widgets/statistic/MiniStatistic";
export default {
	components: {
		MiniStatistic
	},
	data() {
		return {};
	},
	methods: {
		handelToaster() {
			console.log("ok");
			toastr["success"]("response.data.message", "Success");
		}
	}
};
</script>
