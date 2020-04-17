<template>
	<v-container id="user-profile" fluid>
		<v-row justify="center">
			<v-col cols="12" md="8">
				<v-widget title="Profile Info">
					<template slot="widget-content">
						<v-form>
							<v-container class="py-0">
								<v-row>
									<v-col cols="12" md="4">
										<v-text-field
											v-model="user.name"
											label="Name"
											prepend-icon="mdi-account"
											required
											:error-messages="name_Errors"
											@change="$v.user.name.$touch()"
										/>
									</v-col>

									<v-col cols="12" md="4">
										<v-text-field
											v-model="user.mobile"
											label="Mobile"
											prepend-icon="mdi-cellphone-iphone"
											counter
											required
											:error-messages="mobileNo_Errors"
											@change="$v.user.mobile.$touch()"
										/>
									</v-col>

									<v-col cols="12" md="4">
										<v-text-field
											v-model="user.email"
											label="Email Address"
											prepend-icon="mdi-email"
											required
											:error-messages="email_Errors"
											@change="$v.user.email.$touch()"
										/>
									</v-col>

									<v-col cols="12">
										<v-text-field
											v-model="user.address"
											label="Adress"
											prepend-icon="mdi-road-variant"
											required
											:error-messages="address_Errors"
											@change="$v.user.address.$touch()"
										/>
									</v-col>

									<v-col cols="12">
										<v-textarea
											v-model="user.bio"
											label="About Me"
											prepend-icon="mdi-dots-horizontal-circle"
											rows="1"
											hint="(optional)"
											persistent-hint
										/>
									</v-col>

									<v-col cols="12">
										<v-text-field
											v-model="password"
											label="Password"
											prepend-icon="mdi-account-lock"
											hint="(leave empty if not changing)"
											persistent-hint
											:error-messages="password_Errors"
											@change="$v.password.$touch()"
										/>
									</v-col>

									<v-col cols="12" class="text-right">
										<v-btn class="ma-2" color="primary darken-1" dark :loading="isProcessing" @click="onSave">
											Update Profile
											<v-icon dark right>mdi-checkbox-marked-circle</v-icon>
										</v-btn>
									</v-col>
								</v-row>
							</v-container>
						</v-form>
					</template>
				</v-widget>
			</v-col>

			<v-col cols="12" md="4">
				<v-widget :enableHeader="false">
					<template slot="widget-content">
						<div class="text-center">
							<v-avatar color="grey darken-3" size="120">
								<v-img class="elevation-6" :src="getProfilePhoto()"></v-img>
							</v-avatar>
							<v-tooltip top>
								<template v-slot:activator="{ on }">
									<v-btn
										class="vwidget-btn-camera"
										color="grey darken-3"
										fab
										x-small
										dark
										v-on="on"
										@click="$refs.fileInput.click()"
									>
										<v-icon>mdi-camera-retake-outline</v-icon>
									</v-btn>
								</template>
								<span>Change photo</span>
							</v-tooltip>
							<input
								style="display: none"
								ref="fileInput"
								type="file"
								accept="image/*"
								@change="fileSelected"
								enctype="multipart/form-data"
							/>
						</div>
						<v-card-text class="text-center">
							<v-sheet class="my-5 py-5" color="purple lighten-3">
								<h2 dark class="headline mb-2 white--text">{{ user.name }}</h2>

								<p dark class="font-weight-light white--text">{{ user.bio }}</p>
							</v-sheet>

							<v-btn
								color="primary darken-1"
								dark
								rounded
								class="mr-0"
							>Since - {{ user.created_at | myDate }}</v-btn>
						</v-card-text>
					</template>
				</v-widget>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
import VWidget from "@/components/widgets/VWidget";
import {
	required,
	email,
	numeric,
	minLength,
	maxLength
} from "vuelidate/lib/validators";
export default {
	components: {
		VWidget
	},
	data() {
		return {
			isProcessing: false,
			selectedFile: null,
			password: null,
			photo: "profile.svg"
		};
	},
	validations: {
		password: {
			minLength: minLength(8)
		},
		user: {
			name: {
				required
			},
			mobile: {
				required,
				numeric,
				minLength: minLength(10),
				maxLength: maxLength(10)
			},
			email: {
				required,
				email
			},
			address: {
				required
			}
		}
	},
	computed: {
		user() {
			return this.$store.getters.authUser;
		},
		userAvatar() {
			return this.$store.getters.userAvatar;
		},
		name_Errors() {
			const errors = [];
			if (!this.$v.user.name.$dirty) return errors;
			!this.$v.user.name.required && errors.push("Name is required");
			return errors;
		},
		mobileNo_Errors() {
			const errors = [];
			if (!this.$v.user.mobile.$dirty) return errors;
			!this.$v.user.mobile.minLength &&
				errors.push("Mobile no minimum 10 number");
			!this.$v.user.mobile.maxLength &&
				errors.push("Mobile no maximum 10 number");
			!this.$v.user.mobile.numeric &&
				errors.push("Mobile no accept only number");
			!this.$v.user.mobile.required &&
				errors.push("Mobile no is required.");
			return errors;
		},
		email_Errors() {
			const errors = [];
			if (!this.$v.user.email.$dirty) return errors;
			!this.$v.user.email.email && errors.push("Must be valid e-mail");
			!this.$v.user.email.required &&
				errors.push("E-Mail id is required.");
			return errors;
		},

		address_Errors() {
			const errors = [];
			if (!this.$v.user.address.$dirty) return errors;
			!this.$v.user.address.required &&
				errors.push("Address is required");
			return errors;
		},

		password_Errors() {
			const errors = [];
			if (!this.$v.password.$dirty) return errors;
			!this.$v.password.minLength &&
				errors.push("Password must be at most 8 characters");

			return errors;
		}
	},
	methods: {
		getProfilePhoto() {
			if (this.userAvatar) {
				return this.photo.length > 200 ? this.photo : this.userAvatar;
			} else {
				return baseUrl + "/img/profile/" + this.photo;
			}
		},
		fileSelected(e) {
			e.preventDefault();
			const allowedTypes = ["image/jpeg", "image/jpg", "image/png"];

			let file = e.target.files[0];

			let reader = new FileReader();

			let limit = 500000;

			if (!allowedTypes.includes(file.type)) {
				toastr["warning"]("Only image are required !!", "Oops...");
				return false;
			}
			if (file["size"] > limit) {
				toastr["warning"](
					"Too large, max size allowed is 500KB",
					"Oops..."
				);
				return false;
			}

			reader.onloadend = file => {
				this.photo = reader.result;
			};
			reader.readAsDataURL(file);

			this.selectedFile = e.target.files[0];

			this.uploadImage();
		},

		async uploadImage() {
			if (
				await this.$root.$confirm(
					"Confirm?",
					"Profile photo change..!",
					{
						color: "purple"
					}
				)
			) {
				var postData = new FormData();
				postData.append(
					"image",
					this.selectedFile,
					this.selectedFile.data
				);

				const config = {
					headers: {
						"Content-Type": "multipart/form-data"
					}
				};

				this.$root.$dialogLoader.start(
					"Please wait changing ...",
					{},
					() => {
						return new Promise((resolve, reject) => {
							axios
								.post("/user/avatar", postData, config)
								.then(resp => {
									console.log("deleteItem -> resp", resp);

									resolve();
								})
								.catch(err => {
									console.log(JSON.stringify(err));
									reject(err);
								});
						});
					},
					true
				);
			} else {
				this.photo = "profile.svg";
				this.getProfilePhoto();
			}
		},

		onSave() {
			this.isProcessing = true;
			this.$v.$touch();

			if (!this.$v.$error) {
				if (this.password == "" || this.password == null) {
					this.password = undefined;
				}

				let postData = {
					name: this.user.name,
					mobile: this.user.mobile,
					email: this.user.email,
					address: this.user.address,
					bio: this.user.bio,
					password: this.password
				};

				this.$root.$dialogLoader.start(
					"Please wait updating...",
					{},
					() => {
						return new Promise((resolve, reject) => {
							axios
								.post("/user/profile", postData)
								.then(resp => {
									console.log("deleteItem -> resp", resp);

									resolve();
								})
								.catch(err => {
									console.log(JSON.stringify(err));
									reject(err);
								});
						});
					},
					true
				);
				console.log("posting-.", postData);
				this.isProcessing = false;
			} else {
				this.isProcessing = false;
			}
		}
	}
};
</script>
<style lang="sass" scoped>
.vwidget-btn-camera
	top: 60px
	left: -30px
</style>
