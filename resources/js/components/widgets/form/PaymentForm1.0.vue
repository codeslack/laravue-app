<template>
	<v-dialog v-model="show" persistent max-width="500px">
		<v-card>
			<v-card-title>
				<span class="title">{{ labeled }}</span>
			</v-card-title>
			<v-card-text>
				<v-container>
					<v-row>
						{{ editedItem }}
						<v-col cols="12" sm="6" md="4">
							<v-text-field
								v-model="editedItem.name"
								label="Name"
								required
								:error-messages="name_Errors"
								@change="$v.editedItem.name.$touch()"
							></v-text-field>
						</v-col>
						<v-col cols="12" sm="6" md="4">
							<v-text-field
								v-model="editedItem.father_name"
								label="Father Name"
								required
								:error-messages="fatherName_Errors"
								@change="$v.editedItem.father_name.$touch()"
							></v-text-field>
						</v-col>

						<v-col cols="12" sm="6" md="6">
							<v-text-field
								counter
								v-model="editedItem.mobile_no"
								label="Mobile No"
								required
								:error-messages="mobileNo_Errors"
								@change="$v.editedItem.mobile_no.$touch()"
							></v-text-field>
						</v-col>
						<v-col cols="12" sm="6" md="6">
							<v-text-field v-model="editedItem.address" label="Address"></v-text-field>
						</v-col>
						<v-col cols="12" sm="6" md="6">
							<v-text-field
								v-model="editedItem.email"
								label="E-Mail"
								:error-messages="email_Errors"
								@change="$v.editedItem.email.$touch()"
							></v-text-field>
						</v-col>
						<v-col cols="12" sm="6" md="6" v-if="!editedIndex">
							<v-file-input label="Attachment" v-model="editedItem.attachments" multiple></v-file-input>
						</v-col>
						<v-col cols="12" sm="6" md="6" v-if="!editedIndex">
							<v-file-input
								:persistent-hint="true"
								hint="optional"
								:rules="rules"
								accept="image/*"
								prepend-icon="mdi-camera"
								label="Profile Photo"
								v-model="editedItem.avatar"
							></v-file-input>
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
							@click.stop="show = false"
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
import moment from "moment";
import Vue from "vue";
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
			required: true
		},
		hiddenProp: Object
	},
	data() {
		return {
			isProcessing: false,
			toMeun: false,
			editedIndex: 0,
			store: this.url,
			method: "POST",
			editedItem: {
				name: "",
				father_name: "",
				date_of_birth: "",
				mobile_no: "",
				email: null,
				address: "",
				avatar: null,
				attachments: []
			},
			defaultItem: {
				name: "",
				father_name: "",
				date_of_birth: "",
				mobile_no: "",
				email: null,
				address: "",
				avatar: null,
				attachments: []
			},

			showErrors: [
				value =>
					!value ||
					value.size < 5000000 ||
					"Attachment size should be less than 5 MB!"
			],
			rules: [
				value =>
					!value ||
					value.size < 2000000 ||
					"Avatar size should be less than 2 MB!"
			]
		};
	},
	validations: {
		editedItem: {
			name: {
				required
			},
			father_name: {
				required
			},
			date_of_birth: {
				required
			},
			mobile_no: {
				required,
				numeric,
				minLength: minLength(10),
				maxLength: maxLength(10)
			},
			email: {
				email
			}
		}
	},

	computed: {
		show: {
			get() {
				if (this.hiddenProp) {
					this.editedIndex = Object.keys(this.hiddenProp).length;
					this.editedItem = this.hiddenProp;
				}
				return this.value;
			},
			set(value) {
				this.$emit("input", value);
				Fire.$emit("closed");
			}
		},
		toDatePicker: {
			get() {
				if (this.editedItem.date_of_birth == "") {
					return null;
				}
				return moment(
					this.editedItem.date_of_birth,
					"DD-MM-YYYY"
				).format("YYYY-MM-DD");
			},
			set(value) {
				this.editedItem.date_of_birth = moment(
					value,
					"YYYY-MM-DD"
				).format("DD-MM-YYYY");
			}
		},
		name_Errors() {
			const errors = [];
			if (!this.$v.editedItem.name.$dirty) return errors;
			!this.$v.editedItem.name.required &&
				errors.push("Name is required");
			return errors;
		},

		fatherName_Errors() {
			const errors = [];
			if (!this.$v.editedItem.father_name.$dirty) return errors;
			!this.$v.editedItem.father_name.required &&
				errors.push("Father name is required");
			return errors;
		},

		dateOfBirth_Errors() {
			const errors = [];
			if (!this.$v.editedItem.date_of_birth.$dirty) return errors;
			!this.$v.editedItem.date_of_birth.required &&
				errors.push("Date of birth is required");
			return errors;
		},
		mobileNo_Errors() {
			const errors = [];
			if (!this.$v.editedItem.mobile_no.$dirty) return errors;
			!this.$v.editedItem.mobile_no.minLength &&
				errors.push("Mobile no minimum 10 number");
			!this.$v.editedItem.mobile_no.maxLength &&
				errors.push("Mobile no maximum 10 number");
			!this.$v.editedItem.mobile_no.numeric &&
				errors.push("Mobile no accept only number");
			!this.$v.editedItem.mobile_no.required &&
				errors.push("Mobile no is required.");
			return errors;
		},
		email_Errors() {
			const errors = [];
			if (!this.$v.editedItem.email.$dirty) return errors;
			!this.$v.editedItem.email.email &&
				errors.push("Must be valid e-mail");
			return errors;
		}
	},
	methods: {
		onServiceChanged(e) {
			const customer = e;
			console.log("postDataClosed", e);
			// if (customer) {
			Vue.set(this.$data.editedItem, "service_code", customer.name);
			Vue.set(
				this.$data.editedItem,
				"service_code_id",
				customer.identifier
			);
			// }
		},
		close() {
			this.$v.$reset();
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = 0;
				this.$emit("update-cart", "close");
			}, 300);

			this.isProcessing = false;
		},

		xonSave() {
			console.log("edit", this.editedIndex);

			console.log("hidden", this.hiddenProp);
			if (this.editedIndex != 0) {
				this.method = "PUT";
				this.store = `/driving/${this.editedItem.identifier}`;
				console.log("after - hidden", this.method);
			} else {
				this.method = "POST";
				console.log("after - hidden -xxx", this.method);
			}
		},

		onSave() {
			this.isProcessing = true;
			this.$v.$touch();
			if (!this.$v.$error) {
				if (this.editedIndex != 0) {
					this.editedItem[
						this.hiddenProp.field
					] = this.hiddenProp.value;

					this.method = "PUT";
					this.store = `/driving/${this.editedItem.identifier}`;
				} else {
					this.method = "POST";
					this.store = "/driving";
				}

				byMethod(this.method, this.store, this.editedItem)
					.then(resp => {
						if (resp.data) {
							toastr["success"](
								"Successfully register.",
								"Success"
							);
							this.$emit("update-cart", "update");
							Fire.$emit("closed");
							this.show = false;
						}
					})
					.catch(err => {
						errorResponse(err);
					})
					.finally(() => {
						this.isProcessing = false;
					});
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
