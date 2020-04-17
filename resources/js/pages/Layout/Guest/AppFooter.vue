<template>
    <section>
        <v-layout row>
            <v-flex xs12>
                <v-parallax
                    height="auto"
                    dark
                    src="https://cdn.vuetifyjs.com/images/parallax/material.jpg"
                >
                    <v-row align="center" justify="center">
                        <div class="col-sm-6 col-md-3">
                            <div class="featured-box text-center">
                                <div class="featured-box-icon">
                                    <v-icon large color="cyan darken-3"
                                        >fa-lock</v-icon
                                    >
                                </div>
                                <h4 color="cyan darken-3">
                                    100% Secure Payments
                                </h4>
                                <p color="cyan darken-3">
                                    Moving your card details to a much more
                                    secured place.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="featured-box text-center">
                                <div class="featured-box-icon">
                                    <v-icon large color="cyan darken-3"
                                        >fa-thumbs-up</v-icon
                                    >
                                </div>
                                <h4>Trust pay</h4>
                                <p>
                                    100% Payment Protection. Easy Return Policy.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="featured-box text-center">
                                <div class="featured-box-icon">
                                    <v-icon large color="cyan darken-3"
                                        >fa-bullhorn</v-icon
                                    >
                                </div>
                                <h4>Refer &amp; Earn</h4>
                                <p>
                                    Invite a friend to sign up and earn up to
                                    $100.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="featured-box text-center">
                                <div class="featured-box-icon">
                                    <v-icon large color="cyan darken-3"
                                        >fa-life-ring</v-icon
                                    >
                                </div>
                                <h4>24X7 Support</h4>
                                <p>
                                    We're here to help. Have a query and need
                                    help ?
                                </p>
                            </div>
                        </div>
                    </v-row>
                </v-parallax>
            </v-flex>
            <v-footer color="#5277ac" padless>
                <v-row justify="center" no-gutters>
                    <v-card
                        class="col-md-4"
                        color="#5277ac"
                        dark
                        tile
                        elevation="1"
                    >
                        <v-card-title>
                            <v-icon large left>mdi-link</v-icon>
                            <span class="title font-weight-light"
                                >QUICK LINKS</span
                            >
                        </v-card-title>
                        <v-card-actions>
                            <v-list-item class="grow">
                                <v-list-item-content>
                                    <v-list-item
                                        v-for="(item, i) in ftrList"
                                        :key="i"
                                    >
                                        <v-icon v-text="item.icon"></v-icon>

                                        <v-list-item-subtitle
                                            class="ml-2"
                                            v-text="item.title"
                                        ></v-list-item-subtitle>
                                    </v-list-item>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card-actions>
                    </v-card>
                    <v-card
                        class="col-md-4"
                        color="#5277ac"
                        dark
                        tile
                        elevation="1"
                    >
                        <v-card-title>
                            <v-icon large left>mdi-link</v-icon>
                            <span class="title font-weight-light"
                                >FOLLOW US</span
                            >
                        </v-card-title>
                        <v-card-actions>
                            <v-list-item class="grow">
                                <v-list-item-content>
                                    <v-list-item
                                        v-for="(item, i) in icons"
                                        :key="i"
                                    >
                                        <v-icon v-text="item.icon"></v-icon>

                                        <v-list-item-subtitle
                                            class="ml-2"
                                            v-text="item.title"
                                        ></v-list-item-subtitle>
                                    </v-list-item>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card-actions>
                    </v-card>
                    <v-card
                        class="col-md-4"
                        color="#5277ac"
                        dark
                        tile
                        elevation="1"
                    >
                        <v-card-title>
                            <v-icon large left>mdi-link</v-icon>
                            <span class="title font-weight-light">REPORTS</span>
                        </v-card-title>
                        <v-card-actions>
                            <v-list-item class="grow">
                                <v-list-item-content>
                                    <v-list-item
                                        v-for="(item, i) in ftrList"
                                        :key="i"
                                    >
                                        <v-icon v-text="item.icon"></v-icon>

                                        <v-list-item-subtitle
                                            class="ml-2"
                                            v-text="item.title"
                                        ></v-list-item-subtitle>
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
                        <strong>ZsoftLink PVT LTD</strong>
                    </div>
                </v-flex>
            </v-layout>
            <v-layout row wrap justify-end>
                <v-flex shrink>
                    <span class="white--text mr-4">Version 2.0.1</span>
                </v-flex>
            </v-layout>
        </v-footer>
    </section>
</template>
<script>
export default {
    data: () => ({
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
    })
};
</script>

<style>
/* .v-application .blue-grey.darken-2 {
	background-color: #44699e !important;
	border-color: #44699e !important;
}
.v-application .elevation-1 {
	box-shadow: 0px 2px 1px -1px rgba(0, 0, 0, 0.03),
		0px 1px 1px 0px rgba(0, 0, 0, 0), 0px 1px 3px 0px rgba(0, 0, 0, 0.07) !important;
} */
</style>
