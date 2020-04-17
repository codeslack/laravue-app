<template>
	<v-card cols="12" class="mx-auto">
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
		<v-card class="mx-auto" max-width="400">
			<v-img
				class="white--text align-end"
				height="200px"
				src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
			>
				<v-card-title>Top 10 Australian beaches</v-card-title>
			</v-img>

			<v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

			<v-card-text class="text--primary">
				<div>Whitehaven Beach</div>

				<div>Whitsunday Island, Whitsunday Islands</div>
			</v-card-text>

			<v-card-actions>
				<v-btn color="orange" text>Share</v-btn>

				<v-btn color="orange" text>Explore</v-btn>
			</v-card-actions>
		</v-card>

		<v-card :loading="loading" class="mx-auto my-12" max-width="374">
			<v-img height="250" src="https://cdn.vuetifyjs.com/images/cards/cooking.png"></v-img>

			<v-card-title>Cafe Badilico</v-card-title>

			<v-card-text>
				<v-row align="center" class="mx-0">
					<v-rating :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating>

					<div class="grey--text ml-4">4.5 (413)</div>
				</v-row>

				<div class="my-4 subtitle-1">$ • Italian, Cafe</div>

				<div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus patio seating.</div>
			</v-card-text>

			<v-divider class="mx-4"></v-divider>

			<v-card-title>Tonight's availability</v-card-title>

			<v-card-text>
				<v-chip-group v-model="selection" active-class="deep-purple accent-4 white--text" column>
					<v-chip>5:30PM</v-chip>

					<v-chip>7:30PM</v-chip>

					<v-chip>8:00PM</v-chip>

					<v-chip>9:00PM</v-chip>
				</v-chip-group>
			</v-card-text>

			<v-card-actions>
				<v-btn color="deep-purple lighten-2" text @click="reserve">Reserve</v-btn>
			</v-card-actions>
		</v-card>
		<v-card class="mx-auto" max-width="344">
			<v-img src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg" height="200px"></v-img>

			<v-card-title>Top western road trips</v-card-title>

			<v-card-subtitle>1,000 miles of wonder</v-card-subtitle>

			<v-card-actions>
				<v-btn text>Share</v-btn>

				<v-btn color="purple" text>Explore</v-btn>

				<v-spacer></v-spacer>

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

		<v-card max-width="344" class="mx-auto">
			<v-list-item>
				<v-list-item-avatar color="grey"></v-list-item-avatar>
				<v-list-item-content>
					<v-list-item-title class="headline">Our Changing Planet</v-list-item-title>
					<v-list-item-subtitle>by Kurt Wagner</v-list-item-subtitle>
				</v-list-item-content>
			</v-list-item>

			<v-img src="https://cdn.vuetifyjs.com/images/cards/mountain.jpg" height="194"></v-img>

			<v-card-text>Visit ten places on our planet that are undergoing the biggest changes today.</v-card-text>

			<v-card-actions>
				<v-btn text color="deep-purple accent-4">Read</v-btn>
				<v-btn text color="deep-purple accent-4">Bookmark</v-btn>
				<v-spacer></v-spacer>
				<v-btn icon>
					<v-icon>mdi-heart</v-icon>
				</v-btn>
				<v-btn icon>
					<v-icon>mdi-share-variant</v-icon>
				</v-btn>
			</v-card-actions>
		</v-card>

		<v-card class="mx-auto" color="#26c6da" dark max-width="400">
			<v-card-title>
				<v-icon large left>mdi-twitter</v-icon>
				<span class="title font-weight-light">Twitter</span>
			</v-card-title>

			<v-card-text
				class="headline font-weight-bold"
			>"Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well."</v-card-text>

			<v-card-actions>
				<v-list-item class="grow">
					<v-list-item-avatar color="grey darken-3">
						<v-img
							class="elevation-6"
							src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
						></v-img>
					</v-list-item-avatar>

					<v-list-item-content>
						<v-list-item-title>Evan You</v-list-item-title>
					</v-list-item-content>

					<v-row align="center" justify="end">
						<v-icon class="mr-1">mdi-heart</v-icon>
						<span class="subheading mr-2">256</span>
						<span class="mr-1">·</span>
						<v-icon class="mr-1">mdi-share-variant</v-icon>
						<span class="subheading">45</span>
					</v-row>
				</v-list-item>
			</v-card-actions>
		</v-card>
	</v-card>
</template>

<script>
export default {
	data: () => ({
		show: false,
		loading: false,
		selection: 1
	}),

	methods: {
		reserve() {
			this.loading = true;

			setTimeout(() => (this.loading = false), 2000);
		}
	}
};
</script>