<template>
	<v-dialog v-model="show" persistent max-width="320px">
		<v-card>
			<v-card-title>
				<span class="title">New {{ labeled }}</span>
			</v-card-title>
			<v-card-text>
				<v-container>
					<v-row>
						<v-col cols="12" sm="12" md="12">
							<v-text-field v-model="editedItem.name" label="Name"></v-text-field>
						</v-col>
					</v-row>
				</v-container>
			</v-card-text>
			<v-card-actions>
				<div class="flex-grow-1"></div>
				<v-tooltip top>
					<template v-slot:activator="{ on }">
						<v-btn
							class="ma-2"
							color="red"
							v-on="on"
							:dark="!isProcessing"
							:disabled="isProcessing"
							@click.stop="show=false"
						>
							Close
							<v-icon dark right>mdi-cancel</v-icon>
						</v-btn>
					</template>
					<span>Close</span>
				</v-tooltip>

				<v-tooltip top>
					<template v-slot:activator="{ on }">
						<v-btn class="ma-2" color="primary" dark v-on="on" :loading="isProcessing" @click="onSave">
							Save
							<v-icon dark right>mdi-checkbox-marked-circle</v-icon>
						</v-btn>
					</template>
					<span>Save</span>
				</v-tooltip>
			</v-card-actions>
		</v-card>
	</v-dialog>
</template>
<script>
import _ from "lodash";
import { get, byMethod } from "./../../lib/api";
export default {
	name: "DialogForm",
	props: {
		value: {
			default: Boolean
		},
		labeled: {
			default: "new Label"
		},
		url: {
			required: true
		},
		hiddenProp: Object
	},
	data() {
		return {
			addOndialog: false,
			isProcessing: false,
			store: this.url,
			method: "POST",
			comboSearch: "",
			options: null,
			editedIndex: -1,
			editedItem: {
				name: ""
			},
			defaultItem: {
				name: ""
			},
			items: []
		};
	},
	computed: {
		show: {
			get() {
				return this.value;
			},
			set(value) {
				this.$emit("input", value);
				Fire.$emit("closed");
			}
		},
		parms(nv) {
			return {
				...this.options,
				query: this.search
			};
		}
	},

	watch: {
		comboSearch(val) {
			val &&
				val !== this.editedItem.name &&
				this.getDataFromDialogApi(val);
		},

		addOndialog(val) {
			val || this.close();
		}
	},
	methods: {
		getDataFromDialogApi() {
			let comboSearch = this.comboSearch.trim().toLowerCase();
			get(`${this.store}?name=${comboSearch}`).then(resp => {
				this.items = resp.data.data;
			});
		},

		editItem(item) {
			this.editedIndex = this.items.indexOf(item);
			this.editedItem = Object.assign({}, item);
		},

		close() {
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = -1;
			}, 300);
		},

		onSave() {
			this.isProcessing = true;

			if (this.hiddenProp) {
				this.editedItem[this.hiddenProp.field] = this.hiddenProp.value;
			}

			byMethod(this.method, this.store, this.editedItem)
				.then(resp => {
					if (resp.data) {
						toastr["success"]("Successfully register.", "Success");
						this.isProcessing = false;
						this.show = false;
					}
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
					toastr["error"](errorInfos, "Error");
				}
			}

			this.isProcessing = false;
		},

		searchit: _.debounce(() => {
			Fire.$emit("searching");
		}, 1000)
	},
	created() {
		Fire.$on("closed", () => {
			this.close();
		});

		Fire.$on("searching", () => {
			this.getDataFromDialogApi().then(data => {
				this.desserts = data.items;
				this.totalDesserts = data.total;
			});
		});
	}
};
</script>
