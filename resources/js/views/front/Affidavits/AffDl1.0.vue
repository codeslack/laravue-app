<template>
	<div class="list-table">
		<v-container grid-list-xl fluid>
			<v-layout row wrap>
				<v-flex lg12>
					<v-data-table
						:headers="headers"
						:items="desserts"
						:options.sync="options"
						:server-items-length="totalDesserts"
						:footer-props="{
							showFirstLastPage: true,
							'items-per-page-options': [5, 15, 30, 50]
						}"
						:items-per-page="15"
						:loading="loading"
						loading-text="Loading... Please wait"
						class="elevation-1"
						item-key="identifier"
					>
						<template v-slot:top>
							<v-toolbar flat color="white">
								<v-text-field
									flat
									solo
									prepend-icon="mdi-magnify"
									placeholder="Type something"
									v-model="search"
									hide-details
									class="dhidden-sm-and-down"
									@keyup="searchit"
								></v-text-field>
								<div class="flex-grow-1"></div>
								<v-dialog v-model="dialog" max-width="500px">
									<template v-slot:activator="{ on }">
										<v-chip outlined color="teal" v-on="on">
											New
											<v-icon right color="teal">mdi-plus-circle-outline</v-icon>
										</v-chip>
									</template>
									<v-card>
										<v-card-title>
											<span class="headline">{{ formTitle }}</span>
										</v-card-title>

										<v-card-text>
											<v-container>
												<v-row>
													<v-col cols="12" sm="6" md="4">
														<v-text-field v-model="editedItem.name" label="Name"></v-text-field>
													</v-col>
													<v-col cols="12" sm="6" md="4">
														<v-text-field v-model="editedItem.fname" label="Father Name"></v-text-field>
													</v-col>
													<v-col cols="12" sm="6" md="4">
														<v-text-field v-model="editedItem.dob" label="DOB"></v-text-field>
													</v-col>
													<v-col cols="12" sm="6" md="4">
														<v-select :items="id_names" v-model="editedItem.id_name" label="Id Name"></v-select>
													</v-col>

													<v-col cols="12" sm="6" md="4">
														<v-text-field v-model="editedItem.id_no" label="Id No"></v-text-field>
													</v-col>
													<v-col cols="12" sm="6" md="4">
														<v-text-field v-model="editedItem.place" label="Place"></v-text-field>
													</v-col>
													<v-col cols="12" sm="6" md="6">
														<v-text-field v-model="editedItem.to_date" label="Date"></v-text-field>
													</v-col>
													<v-col cols="12" sm="6" md="6">
														<v-text-field v-model="editedItem.mobile_no" label="Mobile No"></v-text-field>
													</v-col>
													<v-col cols="12" sm="12">
														<v-text-field v-model="editedItem.address" label="Address"></v-text-field>
													</v-col>
													<v-col cols="12" sm="12">
														<!-- <v-file-input
															show-size
															counter
															small-chips
															multiple
															label="File input"
															:rules="showErrors"
														></v-file-input>-->
														<v-file-input label="Attachment" v-model="editedItem.attachments" multiple></v-file-input>
													</v-col>
												</v-row>
											</v-container>
										</v-card-text>

										<v-card-actions>
											<div class="flex-grow-1"></div>
											<v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
											<v-btn color="blue darken-1" text @click="save">Save</v-btn>
										</v-card-actions>
									</v-card>
								</v-dialog>
							</v-toolbar>
							<v-divider></v-divider>
						</template>

						<template v-slot:item.action="{ item }">
							<v-btn class="mr-2" color="primary" fab dark small @click="editItem(item)">
								<v-icon small>mdi-pencil-outline</v-icon>
							</v-btn>

							<v-btn color="pink" fab dark small @click="deleteItem(item)">
								<v-icon small>mdi-trash-can-outline</v-icon>
							</v-btn>
						</template>

						<template v-slot:no-data>
							<v-btn color="primary" @click="getDataFromApi">Reset</v-btn>
						</template>
					</v-data-table>
				</v-flex>
			</v-layout>
		</v-container>
	</div>
</template>
<script>
import _ from "lodash";
import moment from "moment";
import objectToFormData from "./../../../api/toFormData.js";
export default {
	data() {
		return {
			desserts: [],
			search: "",
			totalDesserts: 0,
			pagination: { rowsPerPage: 15 },
			loading: false,
			dialog: false,
			options: {},
			headers: [
				{
					text: "Name",
					value: "name"
				},
				{
					text: "Father Name",
					value: "fname"
				},
				{
					text: "DOB",
					value: "dob"
				},
				{
					text: "Mobile No",
					value: "mobile_no"
				},
				{
					text: "Address",
					value: "address"
				},
				{ text: "Actions", value: "action", sortable: false }
			],
			id_names: [
				"Aadhaar Card",
				"Voter Card",
				"Pan Card",
				"Passport",
				"Board Certificate"
			],
			editedIndex: -1,
			editedItem: {
				name: "",
				fname: "",
				dob: "",
				id_name: "",
				id_no: "",
				to_date: new Date().toISOString().substr(0, 10),
				place: "",
				mobile_no: "",
				address: "",
				attachments: null
			},
			defaultItem: {
				name: "",
				fname: "",
				dob: "",
				id_name: "",
				id_no: "",
				to_date: moment(new Date().toISOString().substr(0, 10)).format(
					"DD-MM-YYYY"
				),
				place: "",
				mobile_no: "",
				address: "",
				attachments: null
			},

			showErrors: [
				value =>
					!value ||
					value.size < 5000000 ||
					"Attachment size should be less than 5 MB!"
			]
		};
	},
	computed: {
		formTitle() {
			return this.editedIndex === -1 ? "New Item" : "Edit Item";
		},

		computedDateFormattedMomentjs() {
			return this.defaultItem.to_date
				? moment(this.defaultItem.to_date).format("DD-MM-YYYY")
				: "";
		},
		parms(nv) {
			return {
				...this.options,
				query: this.search
			};
		}
	},

	watch: {
		options: {
			handler() {
				this.getDataFromApi().then(data => {
					this.desserts = data.items;
					this.totalDesserts = data.total;
				});
			},
			deep: true
		},

		dialog(val) {
			val || this.close();
		}
	},
	methods: {
		getDataFromApi() {
			this.loading = true;
			return new Promise((resolve, reject) => {
				const { sortBy, sortDesc, page, itemsPerPage } = this.options;
				let search = this.search.trim().toLowerCase();

				axios
					.get(
						"/driving-affidavits?page=" +
							page +
							"&itemsPerPage=" +
							itemsPerPage +
							"&q=" +
							search
					)
					.then(resp => {
						let listOfObjects = Object.keys(resp.data.data).map(
							key => {
								return resp.data.data[key];
							}
						);
						let items = listOfObjects;

						console.log("search", search);

						if (search) {
							items = items.filter(item => {
								return Object.values(item)
									.join(",")
									.toLowerCase()
									.includes(search);
							});
						}

						if (sortBy.length === 1 && sortDesc.length === 1) {
							items = items.sort((a, b) => {
								const sortA = a[sortBy[0]];
								const sortB = b[sortBy[0]];

								if (sortDesc[0]) {
									if (sortA < sortB) return 1;
									if (sortA > sortB) return -1;
									return 0;
								} else {
									if (sortA < sortB) return -1;
									if (sortA > sortB) return 1;
									return 0;
								}
							});
						}

						const total = resp.data.meta.pagination.total;

						setTimeout(() => {
							this.loading = false;
							resolve({
								items,
								total
							});
						}, 1000);
					})
					.catch(error => {
						if (error.resp) {
							console.log(error.resp);
						}
					});
			});
		},

		editItem(item) {
			this.editedIndex = this.desserts.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.dialog = true;
		},

		async deleteItem(item) {
			if (
				await this.$root.$confirm(
					"Delete?",
					"Are you sure you want to delete, won't be able to revert this!",
					{ color: "red" }
				)
			) {
				this.$root.$dialogLoader.start(
					"Deleting...",
					{},
					() => {
						return new Promise((resolve, reject) => {
							axios
								.delete(
									"/driving-affidavits/" + item.identifier
								)
								.then(resp => {
									const index = this.desserts.indexOf(item);
									this.desserts.splice(index, 1);
									Fire.$emit("AfterEvents");
									resolve();
								})
								.catch(err => {
									console.log(err);
									reject(err);
								});
						});
					},
					true
				);
			}
		},

		close() {
			this.dialog = false;
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = -1;
			}, 300);
		},

		save() {
			if (this.editedIndex > -1) {
				Object.assign(this.desserts[this.editedIndex], this.editedItem);
			} else {
				this.desserts.push(this.editedItem);
			}

			let postData = objectToFormData(this.editedItem);

			return new Promise((resolve, reject) => {
				axios
					.post("/driving-affidavits", postData)
					.then(resp => {
						resolve(resp);
						toastr["success"]("Successfully register.", "Success");
						Fire.$emit("AfterEvents");
						this.close();
					})
					.catch(err => {
						let errorInfos = err.response.data.errors;
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
					});
			});
		},
		searchit: _.debounce(() => {
			Fire.$emit("searching");
		}, 1000)
	},
	created() {
		Fire.$on("AfterEvents", () => {
			this.getDataFromApi().then(data => {
				this.desserts = data.items;
				this.totalDesserts = data.total;
			});
		});

		Fire.$on("searching", () => {
			this.getDataFromApi().then(data => {
				this.desserts = data.items;
				this.totalDesserts = data.total;
			});
		});
	}
};
</script>