<template>
	<v-card class="mx-auto" fluid>
		<v-toolbar flat color="white">
			<v-text-field flat solo prepend-icon="mdi-magnify" placeholder="Type something" hide-details></v-text-field>

			<v-spacer></v-spacer>

			<template v-if="btnAddon">
				<v-chip
					outlined
					color="teal"
					@click.stop="
                        showDialogForm = true;
                        hiddenProp = null;
                    "
				>
					New
					<v-icon right color="teal">mdi-plus-circle-outline</v-icon>
				</v-chip>
				<dialog-form
					v-model="showDialogForm"
					:labeled="labeled"
					:url="url"
					:hiddenProp="hiddenProp"
					@update-cart="updateCart"
				/>
			</template>
		</v-toolbar>

		<v-container fluid>
			<v-row dense>
				<v-col v-for="item in items" :key="item.order_id" cols="12" sm="3" md="3">
					<v-card>
						<v-list-item>
							<v-list-item-avatar color="grey darken-3">
								<v-img class="elevation-6" :src="imageUrl.avatar"></v-img>
							</v-list-item-avatar>
							<v-list-item-content>
								<v-card-title class="pa-0" v-text="item.service_code"></v-card-title>
								<v-list-item-subtitle v-text="item.name"></v-list-item-subtitle>
								<v-list-item-subtitle v-text="item.order_id"></v-list-item-subtitle>
							</v-list-item-content>
						</v-list-item>

						<v-speed-dial
							:key="item.identifier"
							top
							right
							direction="bottom"
							:open-on-hover="true"
							transition="slide-y-reverse-transition"
							absolute
						>
							<template v-slot:activator>
								<v-btn :key="item.identifier" color="blue darken-2" dark fab x-small>
									<v-icon v-if="item.identifier">mdi-buffer</v-icon>
									<v-icon v-else>mdi-account-circle</v-icon>
								</v-btn>
							</template>
							<v-btn fab dark x-small color="green" @click="editItem(item)">
								<v-icon>mdi-pencil</v-icon>
							</v-btn>
							<v-btn fab dark x-small color="indigo">
								<v-icon>mdi-plus</v-icon>
							</v-btn>
							<v-btn fab dark x-small color="red">
								<v-icon>mdi-delete</v-icon>
							</v-btn>
						</v-speed-dial>

						<v-img
							:src="imageUrl.background"
							class="white--text align-end"
							gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
							height="100px"
						></v-img>
						<v-progress-linear v-model="skill" color="blue-grey" height="20" reactive>
							<template v-slot="{ value }">{{ Math.ceil(value) }}%</template>
						</v-progress-linear>
						<v-divider class="mx-4"></v-divider>
						<v-list>
							<v-list-item v-if="item.app_no">
								<v-list-item-content>
									<v-list-item-subtitle v-text="item.app_no"></v-list-item-subtitle>
								</v-list-item-content>
								<v-list-item-action>
									<v-icon>mdi-alpha-a-circle-outline</v-icon>
								</v-list-item-action>
							</v-list-item>

							<v-list-item>
								<v-list-item-content>
									<v-list-item-subtitle v-text="item.date_of_birth"></v-list-item-subtitle>
								</v-list-item-content>
								<v-list-item-action>
									<v-icon>mdi-calendar-month-outline</v-icon>
								</v-list-item-action>
							</v-list-item>

							<v-list-item>
								<v-list-item-content>
									<v-list-item-subtitle v-text="item.mobile_no"></v-list-item-subtitle>
								</v-list-item-content>
								<v-list-item-action>
									<v-icon>mdi-cellphone-iphone</v-icon>
								</v-list-item-action>
							</v-list-item>

							<v-list-item>
								<v-list-item-content>
									<v-list-item-subtitle v-text="item.email"></v-list-item-subtitle>
								</v-list-item-content>
								<v-list-item-action>
									<v-icon>mdi-email</v-icon>
								</v-list-item-action>
							</v-list-item>
						</v-list>

						<v-card-actions>
							<v-spacer></v-spacer>

							<v-chip-group v-model="selection" active-class="deep-purple accent-4 white--text" column>
								<v-chip>16-03-2020</v-chip>

								<v-chip>19:30PM</v-chip>
							</v-chip-group>
							<v-btn icon :key="item.identifier" @click="toggle(item.identifier)">
								<v-icon :key="item.identifier">
									{{
									isActive === item.identifier
									? "mdi-chevron-up"
									: "mdi-chevron-down"
									}}
								</v-icon>
							</v-btn>
						</v-card-actions>
						<v-expand-transition>
							<div :key="item.identifier" v-show="isActive === item.identifier">
								<v-divider></v-divider>

								<v-card-text>
									I'm a thing. But, like most politicians, he
									promised more than he could deliver. You
									won't have time for sleeping, soldier, not
									with all the bed making you'll be doing.
									Then we'll go with that data file! Hey, you
									add a one and two zeros to that or we walk!
									You're going to do his laundry? I've got to
									find a way to escape.
								</v-card-text>
							</div>
						</v-expand-transition>
					</v-card>
				</v-col>
			</v-row>
		</v-container>

		<div class="text-center">
			<v-container>
				<v-row justify="center">
					<v-col cols="8">
						<v-container class="max-width">
							<v-pagination
								v-model="pagination.current_page"
								:length="pagination.total_pages"
								:total-visible="7"
								circle
								class="my-4"
							></v-pagination>
						</v-container>
					</v-col>
				</v-row>
			</v-container>
		</div>
		<v-container>
			<v-row>
				<v-col cols="12" sm="6" md="3">
					<div class="v-card v-card--outlined v-sheet theme--light">
						<a
							href="/en/components/buttons/"
							class="v-list-item--doc v-list-item v-list-item--link theme--light primary--text"
							tabindex="0"
						>
							<div
								class="v-avatar v-list-item__avatar indigo darken-1"
								style="height: 40px; min-width: 40px; width: 40px;"
							>
								<i aria-hidden="true" class="v-icon notranslate mdi mdi-view-dashboard theme--dark"></i>
							</div>
							<div class="v-list-item__content">
								<div class="v-list-item__title">
									<span>buttons</span>
								</div>
								<div class="v-list-item__subtitle">
									<span>components</span>
								</div>
							</div>
							<!---->
							<div class="v-list-item__action">
								<i aria-hidden="true" class="v-icon notranslate mdi mdi-arrow-right theme--light"></i>
							</div>
						</a>
					</div>
				</v-col>
				<v-col cols="12" sm="6" md="3">
					<div class="v-card v-card--outlined v-sheet theme--light">
						<a
							href="/en/components/images/"
							class="v-list-item--doc v-list-item v-list-item--link theme--light primary--text"
							tabindex="0"
						>
							<div
								class="v-avatar v-list-item__avatar indigo darken-1"
								style="height: 40px; min-width: 40px; width: 40px;"
							>
								<i aria-hidden="true" class="v-icon notranslate mdi mdi-view-dashboard theme--dark"></i>
							</div>
							<div class="v-list-item__content">
								<div class="v-list-item__title">
									<span>images</span>
								</div>
								<div class="v-list-item__subtitle">
									<span>components</span>
								</div>
							</div>
							<!---->
							<div class="v-list-item__action">
								<i aria-hidden="true" class="v-icon notranslate mdi mdi-arrow-right theme--light"></i>
							</div>
						</a>
					</div>
				</v-col>
				<v-col cols="12" sm="6" md="3">
					<div class="v-card v-card--outlined v-sheet theme--light">
						<a
							href="/en/styles/typography/"
							class="v-list-item--doc v-list-item v-list-item--link theme--light primary--text"
							tabindex="0"
						>
							<div
								class="v-avatar v-list-item__avatar deep-purple accent-4"
								style="height: 40px; min-width: 40px; width: 40px;"
							>
								<i aria-hidden="true" class="v-icon notranslate mdi mdi-palette theme--dark"></i>
							</div>
							<div class="v-list-item__content">
								<div class="v-list-item__title">
									<span>typography</span>
								</div>
								<div class="v-list-item__subtitle">
									<span>styles</span>
								</div>
							</div>
							<!---->
							<div class="v-list-item__action">
								<i aria-hidden="true" class="v-icon notranslate mdi mdi-arrow-right theme--light"></i>
							</div>
						</a>
					</div>
				</v-col>
				<v-col cols="12" sm="6" md="3">
					<div class="v-card v-card--outlined v-sheet theme--light">
						<a
							href="/en/styles/typography/"
							class="v-list-item--doc v-list-item v-list-item--link theme--light primary--text"
							tabindex="0"
						>
							<div
								class="v-avatar v-list-item__avatar deep-purple accent-4"
								style="height: 40px; min-width: 40px; width: 40px;"
							>
								<i aria-hidden="true" class="v-icon notranslate mdi mdi-palette theme--dark"></i>
							</div>
							<div class="v-list-item__content">
								<div class="v-list-item__title">
									<span>typography</span>
								</div>
								<div class="v-list-item__subtitle">
									<span>styles</span>
								</div>
							</div>
							<!---->
							<div class="v-list-item__action">
								<i aria-hidden="true" class="v-icon notranslate mdi mdi-arrow-right theme--light"></i>
							</div>
						</a>
					</div>
				</v-col>
			</v-row>
		</v-container>
	</v-card>
</template>

<script>
import Vue from "vue";
import { get, byMethod } from "./../../../../lib/api";

import DialogForm from "./DialogForm.vue";
import UserData from "./../../../../api/userdata.js";
export default {
	components: {
		DialogForm
	},
	props: {
		initialize: {},
		url: {
			required: true
		},
		btnAddon: {
			default: false
		},
		labeled: {
			default: "Label"
		}
	},

	data() {
		return {
			isProcessing: false,
			showDialogForm: false,
			loading: false,
			page: 1,
			selection: 1,
			skill: 20,
			comboSearch: "",
			comboLoading: false,
			isActive: false,
			items: [],
			hiddenProp: {},
			imageUrl: {
				background: baseUrl + "/img/mountain.jpg",
				avatar: baseUrl + "/img/avatar.svg"
			},
			pagination: {
				current_page: 1,
				total_pages: 0,
				per_page: 0,
				visible: 7
			}
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
				this.getDataFromApi();
			}, 800);
		}
	},

	methods: {
		updateCart(e) {
			// this.cart.push(e);
			// this.total = this.shoppingCartTotal;
			this.getDataFromApi();
		},
		toggle(divStatus) {
			if (this.isActive === divStatus) {
				this.isActive = false;
			} else {
				this.isActive = divStatus;
			}
		},
		editItem(item) {
			this.hiddenProp = item;
			this.showDialogForm = true;
		},
		getDataFromApi() {
			let comboSearch = this.comboSearch
				? this.comboSearch.trim().toLowerCase()
				: "";

			get(this.url, { name: comboSearch })
				.then(resp => {
					Vue.set(this.$data, "items", resp.data.data);
					Vue.set(
						this.$data,
						"pagination",
						resp.data.meta.pagination
					);
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
		this.getDataFromApi();
	},
	created() {
		Fire.$on("AfterEvents", () => {
			this.getDataFromApi().then(data => {
				this.items = data.items;
				// this.totalDesserts = data.total;
			});
		});

		Fire.$on("searching", () => {
			this.getDataFromApi().then(data => {
				// this.desserts = data.items;
				// this.totalDesserts = data.total;
			});
		});
	}
};
</script>
