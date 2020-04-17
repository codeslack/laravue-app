<template>
	<v-dialog v-model="show" persistent max-width="500px">
		<v-system-bar color="green" dark>
			<span dark class="subtitle-1 font-weight-bold my-2">{{ labeled }}</span>
			<v-spacer></v-spacer>
			<v-tooltip bottom>
				<template v-slot:activator="{ on }">
					<v-icon
						v-on="on"
						:dark="!isProcessing"
						:disabled="isProcessing"
						@click.stop="show = false"
					>mdi-close</v-icon>
				</template>
				<span>Close</span>
			</v-tooltip>
		</v-system-bar>

		<v-card>
			<v-card-text>
				<v-row>
					<v-col cols="12" sm="6" md="6">
						<template>
							<v-menu
								:close-on-content-click="false"
								transition="scale-transition"
								min-width="290px"
								offset-y
								v-model="toMeun"
							>
								<template v-slot:activator="{ on }">
									<v-text-field
										v-model="editedItem.trans_date"
										label="Transaction Date"
										hint="DD-MM-YYYY"
										prepend-icon="mdi-calendar"
										persistent-hint
										v-on="on"
										required
										:error-messages="transDate_Errors"
										@change="
                                                $v.editedItem.trans_date.$touch()
                                            "
									/>
								</template>
								<v-date-picker no-title scrollable v-model="toDatePicker" @input="toMeun = false"></v-date-picker>
							</v-menu>
						</template>
					</v-col>
					<v-col cols="12" sm="6" md="6">
						<v-text-field
							v-model="editedItem.amount"
							label="Amount"
							prepend-icon="mdi-currency-inr"
							required
							:error-messages="amount_Errors"
							@change="$v.editedItem.amount.$touch()"
						></v-text-field>
					</v-col>

					<v-col cols="12" sm="12" md="12">
						<v-textarea
							v-model="editedItem.remarks"
							rows="1"
							label="Remarks"
							prepend-icon="mdi-comment-text"
							hide-details
						></v-textarea>
					</v-col>
					<v-col cols="12" sm="12" md="12">
						<v-file-input
							prepend-icon="mdi-receipt"
							label="Screen Shot (Payment)"
							v-model="editedItem.avatar"
							hide-details
							show-size
							required
							:error-messages="avatar_Errors"
							@change="$v.editedItem.avatar.$touch(); fileSelected($event)"
						></v-file-input>
					</v-col>
				</v-row>
			</v-card-text>

			<v-divider></v-divider>
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
							@click.stop="show = false"
						>
							Cancel
							<v-icon dark right>mdi-cancel</v-icon>
						</v-btn>
					</template>
					<span>Close</span>
				</v-tooltip>
				<v-tooltip top>
					<template v-slot:activator="{ on }">
						<v-btn class="ma-2" color="green" dark v-on="on" :loading="isProcessing" @click="onSave">
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
import Vue from "vue";
import moment from "moment";
import { get, byMethod, errorResponse } from "@/lib/api";
import {
	required,
	email,
	numeric,
	minLength,
	maxLength
} from "vuelidate/lib/validators";
export default {
	props: {
		value: {
			default: Boolean
		},
		labeled: {
			default: "new Label"
		},
		url: {
			required: false
		},
		hiddenProp: Object
	},
	data() {
		return {
			isProcessing: false,
			toMeun: false,
			store: this.url,
			method: "POST",
			editedItem: {
				trans_date: "",
				amount: "",
				remarks: "",
				avatar: null
			},
			defaultItem: {
				trans_date: "",
				amount: "",
				remarks: "",
				avatar: null
			}
		};
	},

	validations: {
		editedItem: {
			trans_date: {
				required
			},
			amount: {
				required,
				numeric
			},
			avatar: {
				required
			}
		}
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
		toDatePicker: {
			get() {
				if (this.editedItem.trans_date == "") {
					return null;
				}
				return moment(this.editedItem.trans_date, "DD-MM-YYYY").format(
					"YYYY-MM-DD"
				);
			},
			set(value) {
				this.editedItem.trans_date = moment(value, "YYYY-MM-DD").format(
					"DD-MM-YYYY"
				);
			}
		},
		transDate_Errors() {
			const errors = [];
			if (!this.$v.editedItem.trans_date.$dirty) return errors;
			!this.$v.editedItem.trans_date.required &&
				errors.push("Transaction Date is required");
			return errors;
		},
		amount_Errors() {
			const errors = [];
			if (!this.$v.editedItem.amount.$dirty) return errors;
			!this.$v.editedItem.amount.numeric &&
				errors.push("Amount accept only number");
			!this.$v.editedItem.amount.required &&
				errors.push("Amount is required.");
			return errors;
		},
		avatar_Errors() {
			const errors = [];
			if (!this.$v.editedItem.avatar.$dirty) return errors;
			!this.$v.editedItem.avatar.required &&
				errors.push("Screen shot is required");
			return errors;
		}
	},
	methods: {
		fileSelected(file) {
			const allowedTypes = [
				"image/jpeg",
				"image/jpg",
				"image/png",
				"application/pdf"
			];

			const limit = 500000;

			if (file) {
				if (!allowedTypes.includes(file.type)) {
					toastr["warning"](
						"Only image and pdf will be accepted !!",
						"Oops..."
					);
					this.editedItem.avatar = null;
					return false;
				}
				if (file["size"] > limit) {
					toastr["warning"](
						"Too large, max size allowed is 500KB",
						"Oops..."
					);
					this.editedItem.avatar = null;
					return false;
				}
			}
		},
		close() {
			this.$v.$reset();
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
			}, 300);
			this.isProcessing = false;
		},
		onSave() {
			this.isProcessing = true;
			this.$v.$touch();

			if (!this.$v.$error) {
				let postData = new FormData();

				postData.append("trans_date", this.editedItem.trans_date);
				postData.append("amount", this.editedItem.amount);
				postData.append("remarks", this.editedItem.remarks);

				postData.append(
					"attachment",
					this.editedItem.avatar,
					this.editedItem.avatar.data
				);

				const config = {
					headers: {
						"Content-Type": "multipart/form-data"
					}
				};

				this.$root.$dialogLoader.start(
					"Please wait saving...",
					{},
					() => {
						return new Promise((resolve, reject) => {
							axios
								.post(this.store, postData)
								.then(resp => {
									this.$emit("update-events");
									Fire.$emit("closed");
									this.show = false;

									resolve();
								})
								.catch(err => {
									reject(err);
								});
						});
					},
					true
				);
				this.isProcessing = false;
			} else {
				this.isProcessing = false;
			}
		}
	},
	created() {
		Fire.$on("closed", () => {
			this.close();
		});
	}
};
</script>
