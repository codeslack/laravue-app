<template>
	<v-card class="mx-auto" fluid>
		<v-toolbar flat color="white">
			<v-text-field flat solo prepend-icon="mdi-magnify" placeholder="Type something" hide-details></v-text-field>

			<v-spacer></v-spacer>

			<template>
				<v-chip outlined color="teal">
					New
					<v-icon right color="teal">mdi-plus-circle-outline</v-icon>
				</v-chip>
			</template>
		</v-toolbar>

		<v-container fluid>
			<v-row dense>
				<v-col v-for="card in cards" :key="card.title" :cols="card.flex">
					<v-card>
						<v-list-item>
							<v-list-item-avatar color="grey darken-3">
								<v-img
									class="elevation-6"
									src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
								></v-img>
							</v-list-item-avatar>
							<v-list-item-content>
								<v-card-title class="pa-0" v-text="card.title"></v-card-title>
								<v-list-item-subtitle v-text="card.name"></v-list-item-subtitle>
								<v-list-item-subtitle v-text="card.order_id"></v-list-item-subtitle>
							</v-list-item-content>
						</v-list-item>
						<v-img
							:src="card.src"
							class="white--text align-end"
							gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
							height="100px"
						></v-img>
						<v-progress-linear v-model="skill" color="blue-grey" height="20" reactive>
							<template v-slot="{ value }">{{ Math.ceil(value) }}%</template>
						</v-progress-linear>
						<v-divider class="mx-4"></v-divider>
						<v-list>
							<!-- <v-list-item>
								<v-list-item-content>
									<v-list-item-subtitle v-text="card.order_id"></v-list-item-subtitle>
								</v-list-item-content>
								<v-list-item-action>
									<v-icon>mdi-dice-d10-outline</v-icon>
								</v-list-item-action>
							</v-list-item>-->

							<v-list-item>
								<v-list-item-content>
									<v-list-item-subtitle v-text="card.app_no"></v-list-item-subtitle>
								</v-list-item-content>
								<v-list-item-action>
									<v-icon>mdi-alpha-a-circle-outline</v-icon>
								</v-list-item-action>
							</v-list-item>

							<v-list-item>
								<v-list-item-content>
									<v-list-item-subtitle v-text="card.dob"></v-list-item-subtitle>
								</v-list-item-content>
								<v-list-item-action>
									<v-icon>mdi-calendar-month-outline</v-icon>
								</v-list-item-action>
							</v-list-item>

							<v-list-item>
								<v-list-item-content>
									<v-list-item-subtitle v-text="card.mobile"></v-list-item-subtitle>
								</v-list-item-content>
								<v-list-item-action>
									<v-icon>mdi-cellphone-iphone</v-icon>
								</v-list-item-action>
							</v-list-item>

							<v-list-item>
								<v-list-item-content>
									<v-list-item-subtitle v-text="card.email"></v-list-item-subtitle>
								</v-list-item-content>
								<v-list-item-action>
									<v-icon>mdi-email</v-icon>
								</v-list-item-action>
							</v-list-item>
						</v-list>
						<v-card-text>
							<v-chip-group v-model="selection" active-class="deep-purple accent-4 white--text" column>
								<v-chip>16-03-2020</v-chip>

								<v-chip>9:30PM</v-chip>
							</v-chip-group>
						</v-card-text>

						<v-card-actions>
							<v-spacer></v-spacer>

							<v-btn icon>
								<v-icon>mdi-heart</v-icon>
							</v-btn>

							<v-btn icon>
								<v-icon>mdi-bookmark</v-icon>
							</v-btn>

							<v-btn icon>
								<v-icon>mdi-share-variant</v-icon>
							</v-btn>
							<v-btn icon @click="show = !show">
								<v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
							</v-btn>
						</v-card-actions>
						<v-expand-transition>
							<div v-show="show">
								<v-divider></v-divider>

								<v-card-text>I'm a thing. But, like most politicians, he promised more than he could deliver. You won't have time for sleeping, soldier, not with all the bed making you'll be doing. Then we'll go with that data file! Hey, you add a one and two zeros to that or we walk! You're going to do his laundry? I've got to find a way to escape.</v-card-text>
							</div>
						</v-expand-transition>
					</v-card>
				</v-col>
			</v-row>
		</v-container>

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
export default {
	data: () => ({
		show: false,
		loading: false,
		selection: 1,
		skill: 20,
		cards: [
			{
				order_id: 15841275964273,
				title: "MCWG",
				name: "Jamarul Sk",
				app_no: "1061137420",
				src: "https://cdn.vuetifyjs.com/images/cards/mountain.jpg",
				dob: "04-03-1993",
				mobile: 7407050991,
				email: "driving@zsoftlink.com",
				flex: 3
			},
			{
				order_id: 15841275242439,
				title: "LMV",
				name: "Rakesh Sarker",
				app_no: "972189520",
				src: "https://cdn.vuetifyjs.com/images/cards/mountain.jpg",
				dob: "20-08-1990",
				mobile: 8670352737,
				email: "driving@zsoftlink.com",
				flex: 3
			},
			{
				order_id: 15841275242439,
				title: "LMV-NT-3",
				name: "Prokash Mondal",
				app_no: "972239820",
				src: "https://cdn.vuetifyjs.com/images/cards/mountain.jpg",
				dob: "07-06-1996",
				mobile: 9382028198,
				email: "driving@zsoftlink.com",
				flex: 3
			},
			{
				order_id: 15841272362657,
				title: "RENEWAL",
				name: "Md Tokazzaman",
				app_no: "1088817220",
				src: "https://cdn.vuetifyjs.com/images/cards/mountain.jpg",
				dob: "01-01-1989",
				mobile: 8348241940,
				email: "driving@zsoftlink.com",
				flex: 3
			}
		]
	}),
	methods: {
		reserve() {
			this.loading = true;

			setTimeout(() => (this.loading = false), 2000);
		}
	}
};
</script>