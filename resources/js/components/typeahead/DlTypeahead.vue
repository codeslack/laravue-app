<template>
	<v-autocomplete
		v-model="editedItem"
		:loading="comboLoading"
		:items="items"
		:search-input.sync="comboSearch"
		item-value="name"
		item-text="name"
		persistent-hint
		:label="labeled"
		return-object
	>
		<template v-slot:append-outer v-if="btnAddon">
			<v-icon right color="teal" @click.stop="showDialogForm = true">mdi-plus-circle-outline</v-icon>
			<dialog-form
				v-model="showDialogForm"
				:labeled="labeled"
				:url="url"
				:hiddenProp="hiddenProp"
				@close="myDialogClose"
			/>
		</template>
		<template v-slot:no-data>
			<v-list-item>
				<v-list-item-content>
					<v-list-item-title>
						No results matching "
						<strong>{{ comboSearch }}</strong>". Press
						<kbd>plus sign</kbd> to create a new one
					</v-list-item-title>
				</v-list-item-content>
			</v-list-item>
		</template>
		<template v-slot:selection="data">{{ data.item.name }}</template>
		<template v-slot:item="data">
			<table dense class="ty-my-table">
				<tr>
					<td width="100px">{{data.item.name | upperCase}}</td>
					<td width="200px">{{data.item.detail}}</td>
					<td width="100px" align="right">{{data.item.retailer | toINR}}</td>
				</tr>
			</table>
		</template>
	</v-autocomplete>
</template>
<script>
import Vue from "vue";
import DialogForm from "./DialogForm";
import { get, byMethod } from "./../../lib/api";
export default {
	components: {
		DialogForm
	},
	props: {
		initialize: {},
		url: {
			required: true
		},
		tabindex: {
			default: 0
		},
		selected: {
			default: null
		},
		btnAddon: {
			default: false
		},
		labeled: {
			default: "Label"
		},
		hiddenProp: Object
	},

	data() {
		return {
			isProcessing: false,
			showDialogForm: false,
			comboSearch: "",
			comboLoading: false,
			items: []
		};
	},
	computed: {
		parms(nv) {
			return {
				query: this.comboSearch
			};
		},
		editedItem: {
			get() {
				return this.initialize;
			},
			set(value) {
				this.$emit("input", value);
				this.$emit("change", value);
			}
		}
	},
	watch: {
		comboSearch(val) {
			if (this.timer) {
				clearTimeout(this.timer);
				this.timer = null;
			}
			this.timer = setTimeout(() => {
				this.getDataFromTypeaheadApi();
			}, 800);
		}
	},
	methods: {
		myDialogClose() {
			this.myDialogVisible = false;
		},
		getDataFromTypeaheadApi() {
			let comboSearch = this.comboSearch
				? this.comboSearch.trim().toLowerCase()
				: "";

			get(this.url, { name: comboSearch })
				.then(resp => {
					Vue.set(this.$data, "items", resp.data.data);
				})
				.catch(err => {
					this.errorResponse(err);
				});
		},
		errorResponse(err) {
			if (err.response) {
				let errorInfos = err.response.data.error;
				if (
					err.response.status === 401 ||
					err.response.status === 422
				) {
					for (let i in errorInfos) {
						if (errorInfos.hasOwnProperty(i)) {
							toastr["error"](errorInfos[i], "Error");
						}
					}
				} else {
					toastr["error"](err.message, "Error");
				}
			}

			this.isProcessing = false;
		}
	},
	mounted() {
		this.getDataFromTypeaheadApi();
	}
};
</script>
<style scoped>
.ty-my-table > tr > td {
	font-size: 12px;
}
</style>