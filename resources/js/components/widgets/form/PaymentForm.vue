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
		<v-form ref="form" v-model="valid">
			<v-card>
				<v-card-title></v-card-title>
				<v-card-text>
					<v-card color="#385F73" dark>
						<v-list class="transparent">
							<v-list-item>
								<v-list-item-title>Order Id #</v-list-item-title>
								<v-list-item-subtitle class="text-right">{{ editedItem.order_id }}</v-list-item-subtitle>
							</v-list-item>
							<v-list-item>
								<v-list-item-title>Payment agnest</v-list-item-title>
								<v-list-item-subtitle class="text-right">{{ editedItem.name }}</v-list-item-subtitle>
							</v-list-item>
							<v-list-item>
								<v-list-item-title>Class of Service</v-list-item-title>
								<v-list-item-subtitle class="text-right">{{ editedItem.service_code | upperCase }}</v-list-item-subtitle>
							</v-list-item>
							<v-list-item>
								<v-list-item-title>Amount</v-list-item-title>
								<v-list-item-subtitle class="text-right">{{ editedItem.amount | toINR }}</v-list-item-subtitle>
							</v-list-item>
							<v-list-item>
								<v-checkbox
									v-model="checkbox"
									:rules="[
                                        v =>
                                            !!v || 'You must agree to continue!'
                                    ]"
									label="Do you agree?"
									required
									v-on:click.prevent="checkPayment"
								></v-checkbox>
							</v-list-item>
						</v-list>
					</v-card>
				</v-card-text>

				<v-divider></v-divider>
				<v-card-actions>
					<div class="flex-grow-1"></div>
					<!-- <v-tooltip top>
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
					</v-tooltip>-->
					<v-tooltip top>
						<template v-slot:activator="{ on }">
							<v-btn
								class="ma-2"
								color="green"
								:disabled="!valid"
								dark
								v-on="on"
								:loading="isProcessing"
								@click="onSave"
							>
								Pay
								<v-icon dark right>mdi-checkbox-marked-circle</v-icon>
							</v-btn>
						</template>
						<span>Payment processing</span>
					</v-tooltip>
				</v-card-actions>
			</v-card>
		</v-form>
	</v-dialog>
</template>

<script>
import Vue from "vue";
import { get, byMethod, errorResponse } from "@/lib/api";
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
			editedIndex: 0,
			store: this.url,
			method: "POST",
			checkbox: false,
			valid: true,
			editedItem: {
				name: ""
			},
			defaultItem: {
				name: ""
			}
		};
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
		}
	},
	methods: {
		checkPayment() {
			this.valid = false;
			this.checkbox = false;
			this.$store
				.dispatch("fetchPaymentInfo", this.editedItem)
				.then(resp => {
					this.checkbox = true;
				})
				.catch(err => {
					this.checkbox = false;
					errorResponse(err);
				});

			console.log("tm", this.checkbox);
		},
		close() {
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = 0;
				this.valid = false;
				this.$emit("update-cart", "close");
			}, 300);

			this.isProcessing = false;
		},

		xxonSave() {
			this.isProcessing = true;
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

			setTimeout(() => {
				this.isProcessing = false;
			}, 300);
		},

		onSave() {
			this.isProcessing = true;

			byMethod(this.method, this.store, this.editedItem)
				.then(resp => {
					if (resp.data) {
						toastr["success"]("Successfully register.", "Success");
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
		}
	},
	created() {
		Fire.$on("closed", () => {
			this.close();
		});
	}
};
</script>
