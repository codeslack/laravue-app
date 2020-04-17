<template>
	<v-container id="user-wallet" fluid>
		<v-row justify="center">
			<v-col cols="12" md="8">
				<v-widget title="Wallet Info">
					<template slot="widget-content">
						<v-data-table
							:headers="headers"
							:items="desserts"
							:options.sync="options"
							:server-items-length="totalDesserts"
							:footer-props="{
								showFirstLastPage: true,
								'items-per-page-options': [5, 15, 20, 50]
							}"
							:items-per-page="20"
							:loading="loading"
							loading-text="Loading... Please wait"
							class="elevation-1 vwidget-table-wallet"
							item-key="identifier"
							dense
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
									<v-spacer></v-spacer>
									<template v-if="btnAddon">
										<v-chip outlined color="teal" @click.stop="showDialogForm = true">
											New
											<v-icon right color="teal">mdi-plus-circle-outline</v-icon>
										</v-chip>
										<wallet-form
											v-model="showDialogForm"
											labeled="Wallet Request"
											url="/user/wallet"
											:hiddenProp="hideItems"
											@update-events="updateEvents"
										/>
									</template>
								</v-toolbar>
								<v-divider></v-divider>
							</template>

							<template v-slot:item.amount="{ item }">
								<span>{{item.amount | toINR}}</span>
							</template>

							<template v-slot:item.status="{ item }">
								<v-chip
									small
									class="ma-2"
									text-color="white"
									v-html="item.status"
									:color="item.status_color"
								></v-chip>
							</template>
						</v-data-table>
					</template>
				</v-widget>
			</v-col>
			<v-col cols="12" md="4">
				<v-widget :enableHeader="false">
					<template slot="widget-content">
						<div class="text-center">
							<v-avatar color="grey darken-2" size="120">
								<v-img class="elevation-6" :src="getProfilePhoto()"></v-img>
							</v-avatar>
						</div>
						<v-card-text class="text-center">
							<v-sheet class="my-5 py-5" color="purple">
								<h2 dark class="headline mb-2 white--text">Wallet Update Timing</h2>

								<p dark class="font-weight-light white--text">wallet update, when bank ladger shown</p>
							</v-sheet>

							<v-btn
								color="primary darken-1"
								dark
								rounded
								class="mr-0"
							>Balance {{ walletBalance | toINRCrDr }}</v-btn>
						</v-card-text>
					</template>
				</v-widget>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
import _ from "lodash";
import VWidget from "@/components/widgets/VWidget";
import WalletForm from "@/components/widgets/form/WalletForm";
export default {
	components: {
		VWidget,
		WalletForm
	},
	data() {
		return {
			isProcessing: false,
			selectedFile: null,
			password: null,
			photo: "profile.svg",
			showDialogForm: false,
			btnAddon: true,
			hideItems: {},
			desserts: [],
			search: "",
			totalDesserts: 0,
			pagination: { rowsPerPage: 15 },
			loading: false,
			btnLoading: false,
			options: {},
			headers: [
				{
					text: "Trans Date",
					value: "trans_date",
					sortable: false,
					width: "120px"
				},
				{
					text: "Order Id",
					value: "order_id",
					sortable: false,
					width: "150px"
				},
				{
					text: "Amount",
					value: "amount",
					sortable: false,
					width: "100px",
					align: "right"
				},
				{
					text: "Status",
					value: "status",
					sortable: false,
					width: "70px",
					align: "center"
				}
			]
		};
	},
	computed: {
		walletBalance() {
			return this.$store.getters.walletBalance;
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
		}
	},

	methods: {
		getProfilePhoto() {
			return baseUrl + "/img/profile/" + this.photo;
		},
		updateEvents() {
			console.log("updateEvents");
			this.getDataFromApi().then(data => {
				this.desserts = data.items;
				this.totalDesserts = data.total;
			});
		},
		getDataFromApi() {
			this.loading = true;
			return new Promise((resolve, reject) => {
				const { sortBy, sortDesc, page, itemsPerPage } = this.options;
				let search = this.search.trim().toLowerCase();

				axios
					.get(
						"/user/wallet?page=" +
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
<style lang="sass">
.vwidget-table-wallet
	table
		th + th, td + td
			border-left: 1px solid #dddddd

	tbody tr:not(:last-child) td:not(.v-data-table__mobile-row)
		border-bottom: none !important
</style>
