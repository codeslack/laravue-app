<template>
	<v-app>
		<!-- <v-container fluid> -->
		<v-layout column style="background:#FFFFFF">
			<v-flex xs12 style="background:#223F6D">
				<div class="pt-1">
					<v-layout row>
						<v-flex xs1></v-flex>
						<v-flex xs10>
							<marquee scrollamount="10" class="white--text font-weight-light">
								<b>Dear Guest,</b> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet earum vero ratione odio? Ratione, cum magnam vel earum, sed culpa repellat ea voluptatum, tempora deleniti quod autem. A, magnam consequuntur! &nbsp; Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minima officiis provident eligendi distinctio, reiciendis cupiditate amet esse fugit perferendis blanditiis quam dolor ad delectus accusantium harum minus nulla ratione voluptate.
							</marquee>
						</v-flex>
						<v-flex xs1></v-flex>
					</v-layout>
				</div>
			</v-flex>
			<v-flex xs12>
				<v-layout row class="ma-3">
					<v-flex xs2 class="d-none d-sm-flex"></v-flex>
					<v-app-bar-nav-icon></v-app-bar-nav-icon>
					<v-toolbar-title>Code Slack</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-btn v-for="link in links" :key="link" text class="d-none d-sm-flex my-2">{{ link }}</v-btn>
					<v-flex xs2></v-flex>
				</v-layout>
			</v-flex>
			<v-flex xs12 style="background:#5277AC">
				<v-layout row class="ma-3">
					<v-flex xs2></v-flex>
					<v-flex class="ma-2">
						<v-btn v-for="link in links" :key="link" color="white" text rounded class="my-2">{{ link }}</v-btn>
					</v-flex>
					<v-flex xs2></v-flex>
				</v-layout>
			</v-flex>
			<v-flex xs12>
				<v-layout row class="mt-3">
					<v-flex xs2></v-flex>
					<v-flex xs10 class="text-xs-right">
						<v-breadcrumbs divider="/" style="justify-content:left;">
							<v-breadcrumbs-item v-for="item in brdCrmbsItms" :key="item.text" :disabled="item.disabled">
								<b v-if="!item.disabled" style="color:#5277AC;">{{ item.text }}</b>
								<b v-else>{{ item.text }}</b>
							</v-breadcrumbs-item>
						</v-breadcrumbs>
					</v-flex>
				</v-layout>
			</v-flex>
			<v-flex xs12>
				<v-layout row class="mt-3">
					<v-flex xs2></v-flex>
					<v-flex xs6 class="mr-5">
						<v-card flat v-for="(post, index) in posts" :key="index" class="grey--text text--darken-2">
							<span style="font-size:32px;" class="mt-3">{{ post.title }}</span>
							<div class="mt-3">
								<span style="color:grey">POSTED BY</span>
								<strong>{{ post.author }}</strong>
								<span style="color:grey">ON</span>
								<strong>{{ cnvrtDate(post.date) }}</strong>
							</div>
							<v-img class="white--text" height="400px" :src="post.image">
								<v-card-title class="align-end fill-height">I'm a title</v-card-title>
							</v-img>
							<v-card-text style="font-size:16px;">{{ concatStr(post.description) }}</v-card-text>
							<v-card-actions class="mb-3">
								<v-btn :href="post.link" text style="color:#5277AC;">READ MORE</v-btn>
							</v-card-actions>
						</v-card>
					</v-flex>
					<v-flex xs2 class="ml-5">
						<h4 style="color:#223E6E;">Popular Posts</h4>
						<v-card
							class="mx-auto mt-3"
							max-width="344"
							v-for="(post, index) in popularPost"
							:key="index"
						>
							<v-img :src="post.image" height="200px"></v-img>

							<v-card-title>
								<div>{{ post.title }}</div>
								<span class="grey--text subtitle-1">{{ post.subTitle }}</span>
							</v-card-title>

							<v-card-actions>
								<v-btn text>Share</v-btn>

								<v-btn text color="purple">Explore</v-btn>

								<div class="flex-grow-1"></div>

								<v-btn icon @click="show = !show">
									<v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
								</v-btn>
							</v-card-actions>

							<v-expand-transition>
								<div v-show="show">
									<v-card-text>{{ post.desc }}</v-card-text>
								</div>
							</v-expand-transition>
						</v-card>
						<h4 class="grey--text text--darken-1 mt-5">Tasks</h4>
						<v-btn class="ma-2" outlined color="indigo" v-for="tag in tags" :key="tag">{{ tag }}</v-btn>
					</v-flex>
					<v-flex xs2></v-flex>
					<v-btn color="accent" large @click.stop="showScheduleForm=true">hello</v-btn>
					<app-login v-model="showScheduleForm" />
				</v-layout>
				<v-divider style="color:#C4C4C4;height:2px;"></v-divider>
			</v-flex>
		</v-layout>
		<!-- </v-container> -->
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

				<v-btn v-for="link in links" :key="link" color="white" text rounded class="my-2">{{ link }}</v-btn>

				<v-col class="blue-grey darken-2 py-4 text-center white--text" cols="12">
					{{ new Date().getFullYear() }} —
					<strong>U2WORLD PVT LTD</strong>
				</v-col>
			</v-row>
		</v-footer>
	</v-app>
</template>

<script>
import AppLogin from "./views/guest/Login";
import moment from "moment";
export default {
	components: {
		AppLogin
	},
	data: () => ({
		showScheduleForm: false,
		hoverStyle: "",
		show: false,
		links: ["Home", "About Us", "Team", "Contact Us", "Login"],
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
		brdCrmbsItms: [
			{
				text: "HOME",
				disabled: false
			},
			{
				text: "BLOG",
				disabled: true
			}
		],
		posts: [
			{
				title:
					"Lorem Ipsum is simply dummy text of the printing and typesetting industry",
				image: baseUrl + "/img/Blog_pic.jpg",
				author: "MANISH CHAUHAN",
				date: "2016-02-12T03:16:00Z",
				description:
					"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
				link: "#"
			},
			{
				title:
					"Lorem Ipsum is simply dummy text of the printing and typesetting industry",
				image: baseUrl + "/img/Blog_pic1.jpg",
				author: "MANISH CHAUHAN",
				date: "2016-12-12T10:32:00Z",
				description:
					"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
				link: "#"
			},
			{
				title:
					"Lorem Ipsum is simply dummy text of the printing and typesetting industry",
				image: baseUrl + "/img/Blog_pic2.jpg",
				author: "MANISH CHAUHAN",
				date: "2017-01-27T17:51:00Z",
				description:
					"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
				link: "#"
			},
			{
				title:
					"Lorem Ipsum is simply dummy text of the printing and typesetting industry",
				image: baseUrl + "/img/Blog_pic3.jpg",
				author: "MANISH CHAUHAN",
				date: "2017-01-27T17:51:00Z",
				description:
					"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
				link: "#"
			}
		],
		popularPost: [
			{
				image: baseUrl + "/img/Blog_img.jpg",
				title: "What people consider themselves?",
				subTitle: "Whemselves?",
				desc: '70% investors are "Asset Poor" - What about you?'
			},
			{
				image: baseUrl + "/img/Blog_img1.jpg",
				title: "What people consider themselves?",
				subTitle: "Whemselves?",
				desc: '70% investors are "Asset Poor" - What about you?'
			},
			{
				image: baseUrl + "/img/Blog_img2.jpg",
				title: "What people consider themselves?",
				subTitle: "Whemselves?",
				desc: '70% investors are "Asset Poor" - What about you?'
			},
			{
				image: baseUrl + "/img/Blog_img3.jpg",
				title: "What people consider themselves?",
				subTitle: "Whemselves?",
				desc: '70% investors are "Asset Poor" - What about you?'
			}
		],
		tags: [
			"Investments",
			"Finance",
			"Tradings",
			"Insurance",
			"Webinars",
			"Financial Planning",
			"Mutual Funds",
			"eBooks",
			"Memberships"
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
	}),
	methods: {
		hoverEvnt() {
			this.hoverStyle = "background-color:red;";
		},
		concatStr(str) {
			return str.substring(0, 300) + " ...";
		},
		cnvrtDate(date) {
			return moment(date)
				.utcOffset(-0, false)
				.format("ddd, MMM Do YYYY, hh:mm A");
		}
	}
};
</script>

<style>
.v-application .blue-grey.darken-2 {
	background-color: #44699e !important;
	border-color: #44699e !important;
}
.v-application .elevation-1 {
	box-shadow: 0px 2px 1px -1px rgba(0, 0, 0, 0.03),
		0px 1px 1px 0px rgba(0, 0, 0, 0), 0px 1px 3px 0px rgba(0, 0, 0, 0.07) !important;
}
</style>