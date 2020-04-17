<template>
	<v-app light>
		<v-toolbar color="#458ef7" dark>
			<v-toolbar-title v-text="title"></v-toolbar-title>
			<v-spacer></v-spacer>
			<v-btn v-for="link in links" :key="link" text rounded class="d-none d-sm-flex my-2">{{ link }}</v-btn>
		</v-toolbar>
		<v-content>
			<section>
				<v-parallax src="assets/hero.jpeg" height="600">
					<v-layout column align-center justify-center class="white--text">
						<img src="assets/vuetify.png" alt="Vuetify.js" height="200" />
						<h1 class="white--text mb-2 display-1 text-center">Parallax Template</h1>
						<div class="subheading mb-4 text-center">Powered by Vuetify</div>
						<v-btn class="mt-12" color="blue lighten-2" dark large href="/pre-made-themes">Get Started</v-btn>
					</v-layout>
				</v-parallax>
			</section>

			<section>
				<v-layout column wrap class="my-12" align-center>
					<v-flex xs12 sm4 class="my-4">
						<div class="text-center">
							<h2 class="headline">The best way to start developing</h2>
							<span class="subheading">Cras facilisis mi vitae nunc</span>
						</div>
					</v-flex>
					<v-flex xs12>
						<v-container grid-list-xl>
							<v-layout row wrap align-center>
								<v-flex xs12 md4>
									<v-card flat class="transparent">
										<v-card-text class="text-center">
											<v-icon x-large class="blue--text text--lighten-2">mdi-palette</v-icon>
										</v-card-text>
										<v-card-title primary-title class="layout justify-center">
											<div class="headline text-center">Material Design</div>
										</v-card-title>
										<v-card-text>
											Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
											Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
											Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
										</v-card-text>
									</v-card>
								</v-flex>
								<v-flex xs12 md4>
									<v-card flat class="transparent">
										<v-card-text class="text-center">
											<v-icon x-large class="blue--text text--lighten-2">mdi-flash</v-icon>
										</v-card-text>
										<v-card-title primary-title class="layout justify-center">
											<div class="headline">Fast development</div>
										</v-card-title>
										<v-card-text>
											Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
											Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
											Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
										</v-card-text>
									</v-card>
								</v-flex>
								<v-flex xs12 md4>
									<v-card flat class="transparent">
										<v-card-text class="text-center">
											<v-icon x-large class="blue--text text--lighten-2">mdi-wrench</v-icon>
										</v-card-text>
										<v-card-title primary-title class="layout justify-center">
											<div class="headline text-center">Completely Open Sourced</div>
										</v-card-title>
										<v-card-text>
											Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
											Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
											Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
										</v-card-text>
									</v-card>
								</v-flex>
							</v-layout>
						</v-container>
					</v-flex>
				</v-layout>
			</section>

			<section>
				<v-parallax src="assets/section.jpg" height="380">
					<v-layout column align-center justify-center>
						<div class="headline white--text mb-4 text-center">Web development has never been easier</div>
						<em>Kick-start your application today</em>
						<v-btn class="mt-12" color="blue lighten-2" dark large href="/pre-made-themes">Get Started</v-btn>
					</v-layout>
				</v-parallax>
			</section>

			<section>
				<v-container grid-list-xl>
					<v-layout row wrap justify-center class="my-12">
						<v-flex xs12 sm4>
							<v-card flat class="transparent">
								<v-card-title primary-title class="layout justify-center">
									<div class="headline">Company info</div>
								</v-card-title>
								<v-card-text>
									Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
									Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
									Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
								</v-card-text>
							</v-card>
						</v-flex>
						<v-flex xs12 sm4 offset-sm1>
							<v-card flat class="transparent">
								<v-card-title primary-title class="layout justify-center">
									<div class="headline">Contact us</div>
								</v-card-title>
								<v-card-text>Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.</v-card-text>
								<v-list class="transparent">
									<v-list-item>
										<v-list-item-action>
											<v-icon class="blue--text text--lighten-2">mdi-phone</v-icon>
										</v-list-item-action>
										<v-list-item-content>
											<v-list-item-title>777-867-5309</v-list-item-title>
										</v-list-item-content>
									</v-list-item>
									<v-list-item>
										<v-list-item-action>
											<v-icon class="blue--text text--lighten-2">mdi-map-marker</v-icon>
										</v-list-item-action>
										<v-list-item-content>
											<v-list-item-title>Chicago, US</v-list-item-title>
										</v-list-item-content>
									</v-list-item>
									<v-list-item>
										<v-list-item-action>
											<v-icon class="blue--text text--lighten-2">mdi-email</v-icon>
										</v-list-item-action>
										<v-list-item-content>
											<v-list-item-title>john@vuetifyjs.com</v-list-item-title>
										</v-list-item-content>
									</v-list-item>
								</v-list>
							</v-card>
						</v-flex>
					</v-layout>
				</v-container>
			</section>

			<v-layout row>
				<v-flex xs12>
					<v-parallax height="auto" dark src="https://cdn.vuetifyjs.com/images/parallax/material.jpg">
						<v-row align="center" justify="center">
							<div class="col-sm-6 col-md-3">
								<div class="featured-box text-center">
									<div class="featured-box-icon">
										<v-icon large color="cyan darken-3">fa-lock</v-icon>
									</div>
									<h4 color="cyan darken-3">100% Secure Payments</h4>
									<p color="cyan darken-3">Moving your card details to a much more secured place.</p>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="featured-box text-center">
									<div class="featured-box-icon">
										<v-icon large color="cyan darken-3">fa-thumbs-up</v-icon>
									</div>
									<h4>Trust pay</h4>
									<p>100% Payment Protection. Easy Return Policy.</p>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="featured-box text-center">
									<div class="featured-box-icon">
										<v-icon large color="cyan darken-3">fa-bullhorn</v-icon>
									</div>
									<h4>Refer &amp; Earn</h4>
									<p>Invite a friend to sign up and earn up to $100.</p>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="featured-box text-center">
									<div class="featured-box-icon">
										<v-icon large color="cyan darken-3">fa-life-ring</v-icon>
									</div>
									<h4>24X7 Support</h4>
									<p>We're here to help. Have a query and need help ?</p>
								</div>
							</div>
						</v-row>
					</v-parallax>
				</v-flex>
				<v-footer color="#5277ac" padless>
					<v-row justify="center" no-gutters>
						<v-card class="col-md-4" color="#5277ac" dark tile elevation="1">
							<v-card-title>
								<v-icon large left>mdi-link</v-icon>
								<span class="title font-weight-light">QUICK LINKS</span>
							</v-card-title>
							<v-card-actions>
								<v-list-item class="grow">
									<v-list-item-content>
										<v-list-item v-for="(item, i) in ftrList" :key="i">
											<v-icon v-text="item.icon"></v-icon>

											<v-list-item-subtitle class="ml-2" v-text="item.title"></v-list-item-subtitle>
										</v-list-item>
									</v-list-item-content>
								</v-list-item>
							</v-card-actions>
						</v-card>
						<v-card class="col-md-4" color="#5277ac" dark tile elevation="1">
							<v-card-title>
								<v-icon large left>mdi-link</v-icon>
								<span class="title font-weight-light">FOLLOW US</span>
							</v-card-title>
							<v-card-actions>
								<v-list-item class="grow">
									<v-list-item-content>
										<v-list-item v-for="(item, i) in icons" :key="i">
											<v-icon v-text="item.icon"></v-icon>

											<v-list-item-subtitle class="ml-2" v-text="item.title"></v-list-item-subtitle>
										</v-list-item>
									</v-list-item-content>
								</v-list-item>
							</v-card-actions>
						</v-card>
						<v-card class="col-md-4" color="#5277ac" dark tile elevation="1">
							<v-card-title>
								<v-icon large left>mdi-link</v-icon>
								<span class="title font-weight-light">REPORTS</span>
							</v-card-title>
							<v-card-actions>
								<v-list-item class="grow">
									<v-list-item-content>
										<v-list-item v-for="(item, i) in ftrList" :key="i">
											<v-icon v-text="item.icon"></v-icon>

											<v-list-item-subtitle class="ml-2" v-text="item.title"></v-list-item-subtitle>
										</v-list-item>
									</v-list-item-content>
								</v-list-item>
							</v-card-actions>
						</v-card>
					</v-row>
				</v-footer>
			</v-layout>
			<v-footer color="#4b6c9b">
				<v-layout row wrap align-center>
					<v-flex xs12>
						<div class="white--text ml-4">
							@ {{ new Date().getFullYear() }} —
							<strong>U2WORLD PVT LTD</strong>
						</div>
					</v-flex>
				</v-layout>
				<v-layout row wrap justify-end>
					<v-flex shrink>
						<span class="white--text mr-4">Version 2.0.1</span>
					</v-flex>
				</v-layout>
			</v-footer>
		</v-content>
	</v-app>
</template>
<script>
export default {
	data() {
		return {
			title: "Code Slack",
			links: ["Home", "About", "Team", "Contact", "Login"],
			icons: [
				{
					title: "Facebook",
					link: "#",
					icon: "fab fa-facebook"
				},
				{
					title: "Twitter",
					link: "#",
					icon: "fab fa-twitter"
				},
				{
					title: "Google Plus",
					link: "#",
					icon: "fab fa-google-plus"
				},
				{
					title: "Linkedin",
					link: "#",
					icon: "fab fa-linkedin"
				},
				{
					title: "Instagram",
					link: "#",
					icon: "fab fa-instagram"
				}
			],
			ftrList: [
				{
					title: "Existing Members? Login",
					link: "#",
					icon: "mdi-clock"
				},
				{
					title: "Blogs",
					link: "#",
					icon: "mdi-flag"
				},
				{
					title: "Webinars",
					link: "#",
					icon: "mdi-clock"
				},
				{
					title: "Videos",
					link: "#",
					icon: "mdi-account"
				},
				{
					title: "eBooks",
					link: "#",
					icon: "mdi-flag"
				}
			]
		};
	}
};
</script>