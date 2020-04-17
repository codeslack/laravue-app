<template>
	<div class="list-table">
		<v-container grid-list-xl fluid>
			<v-layout row wrap>
				<v-flex lg12>
					<list-data
						url="/driving/process"
						initialize="hekllo"
						:btnAddon="true"
						labeled="Driving Licence"
					></list-data>
				</v-flex>
			</v-layout>
		</v-container>
	</div>
</template>

<script>
import ListData from "./componentes/ListData.vue";
export default {
	components: {
		ListData
	}
};
</script>

<style></style>
