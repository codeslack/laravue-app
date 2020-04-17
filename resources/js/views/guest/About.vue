<template>
    <v-content>
        <v-container grid-list-xl>
            <v-layout row wrap justify-center class="my-12">
                <v-flex xs12>
                    <v-card flat class="transparent">
                        <v-card-title
                            primary-title
                            class="layout justify-center"
                        >
                            <div class="headline">What is Zsoftlink?</div>
                        </v-card-title>
                        <v-card-text>
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Nihil animi omnis aspernatur quo itaque
                            distinctio laboriosam laudantium ratione, ipsa
                            delectus debitis impedit necessitatibus maxime totam
                            unde accusamus dignissimos sunt voluptates. Instant
                            Online recharge and Bill Payments Iisque persius
                            interesset his et, in quot quidam persequeris vim,
                            ad mea essent possim iriure. Mutat tacimates id sit.
                            Ridens mediocritatem ius an, eu nec magna imperdiet.
                            Mediocrem qualisque in has. Enim utroque perfecto id
                            mei, ad eam tritani labores facilisis, ullum
                            sensibus no cum. Eius eleifend in quo. At mei alia
                            iriure propriae. Partiendo voluptatibus ex cum, sed
                            erat fuisset ne, cum ex meis volumus mentitum.
                            Alienum pertinacia maiestatis ne eum, verear
                            persequeris et vim. Mea cu dicit voluptua
                            efficiantur, nullam labitur veritus sit cu. Eum
                            denique omittantur te, in justo epicurei his, eu mei
                            aeque populo. Cu pro facer sententiae, ne brute
                            graece scripta duo. No placerat quaerendum nec, pri
                            alia ceteros adipiscing ut. Quo in nobis nostrum
                            intellegebat. Ius hinc decore erroribus eu, in case
                            prima exerci pri. Id eum prima adipisci. Ius cu
                            minim theophrastus, legendos pertinacia an nam.
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
        <v-layout column wrap class="my-12" align-center>
            <v-flex xs12>
                <v-container grid-list-xl>
                    <v-layout row wrap align-center>
                        <v-flex xs12 md4>
                            <v-card flat class="transparent">
                                <v-card-text class="text-center">
                                    <v-icon
                                        x-large
                                        class="blue--text text--lighten-2"
                                        >mdi-thumb-up-outline</v-icon
                                    >
                                </v-card-text>
                                <v-card-title
                                    primary-title
                                    class="layout justify-center"
                                >
                                    <div class="headline text-center">
                                        Why choose Us
                                    </div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis
                                    pharetra. Nulla volutpat tincidunt ornare.
                                    Pellentesque habitant morbi tristique
                                    senectus et netus et malesuada fames ac
                                    turpis egestas. Nullam in aliquet odio.
                                    Aliquam eu est vitae tellus bibendum
                                    tincidunt. Suspendisse potenti.
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 md4>
                            <v-card flat class="transparent">
                                <v-card-text class="text-center">
                                    <v-icon
                                        x-large
                                        class="blue--text text--lighten-2"
                                        >mdi-flash</v-icon
                                    >
                                </v-card-text>
                                <v-card-title
                                    primary-title
                                    class="layout justify-center"
                                >
                                    <div class="headline">Our Mission</div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis
                                    pharetra. Nulla volutpat tincidunt ornare.
                                    Pellentesque habitant morbi tristique
                                    senectus et netus et malesuada fames ac
                                    turpis egestas. Nullam in aliquet odio.
                                    Aliquam eu est vitae tellus bibendum
                                    tincidunt. Suspendisse potenti.
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 md4>
                            <v-card flat class="transparent">
                                <v-card-text class="text-center">
                                    <v-icon
                                        x-large
                                        class="blue--text text--lighten-2"
                                        >mdi-eye</v-icon
                                    >
                                </v-card-text>
                                <v-card-title
                                    primary-title
                                    class="layout justify-center"
                                >
                                    <div class="headline text-center">
                                        Our Vision
                                    </div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis
                                    pharetra. Nulla volutpat tincidunt ornare.
                                    Pellentesque habitant morbi tristique
                                    senectus et netus et malesuada fames ac
                                    turpis egestas. Nullam in aliquet odio.
                                    Aliquam eu est vitae tellus bibendum
                                    tincidunt. Suspendisse potenti.
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-flex>
        </v-layout>
        <section>
            <v-parallax src="assets/section.jpg" height="380">
                <v-layout column align-center justify-center>
                    <div class="headline white--text mb-4 text-center">
                        Web development has never been easier
                    </div>
                    <em>Kick-start your application today</em>
                    <v-btn
                        class="mt-12"
                        color="blue lighten-2"
                        dark
                        large
                        href="/pre-made-themes"
                        >Get Started</v-btn
                    >
                </v-layout>
            </v-parallax>
        </section>

        <section>
            <v-layout column wrap class="my-12" align-center>
                <v-flex xs12 sm4 class="my-4">
                    <div class="text-center">
                        <h2 class="headline">Leadership</h2>
                        <span class="subheading"
                            >Cras facilisis mi vitae nunc</span
                        >
                    </div>
                </v-flex>
                <v-flex xs12>
                    <v-container grid-list-xl>
                        <v-layout row wrap align-center>
                            <v-flex xs12 md3>
                                <v-hover v-slot:default="{ hover }">
                                    <v-card
                                        :elevation="hover ? 12 : 2"
                                        class="mx-auto"
                                        max-width="320"
                                        flat
                                    >
                                        <v-img
                                            class="white--text"
                                            height="200px"
                                            src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                                        >
                                            <v-card-title
                                                class="align-end fill-height"
                                                >Top 10 Australian
                                                beaches</v-card-title
                                            >
                                        </v-img>

                                        <v-card-text>
                                            <span>Number 10</span>
                                            <br />
                                            <span class="text--primary">
                                                <span>Whitehaven Beach</span>
                                                <br />
                                                <span
                                                    >Whitsunday Island,
                                                    Whitsunday Islands</span
                                                >
                                            </span>
                                        </v-card-text>

                                        <v-card-actions>
                                            <v-btn text color="orange"
                                                >Share</v-btn
                                            >
                                            <v-btn text color="orange"
                                                >Explore</v-btn
                                            >
                                        </v-card-actions>
                                    </v-card>
                                </v-hover>
                            </v-flex>
                            <v-flex xs12 md3>
                                <v-hover v-slot:default="{ hover }">
                                    <v-card
                                        :elevation="hover ? 12 : 2"
                                        class="mx-auto"
                                        max-width="320"
                                        flat
                                    >
                                        <v-img
                                            class="white--text"
                                            height="200px"
                                            src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                                        >
                                            <v-card-title
                                                class="align-end fill-height"
                                                >Top 10 Australian
                                                beaches</v-card-title
                                            >
                                        </v-img>

                                        <v-card-text>
                                            <span>Number 10</span>
                                            <br />
                                            <span class="text--primary">
                                                <span>Whitehaven Beach</span>
                                                <br />
                                                <span
                                                    >Whitsunday Island,
                                                    Whitsunday Islands</span
                                                >
                                            </span>
                                        </v-card-text>

                                        <v-card-actions>
                                            <v-btn text color="orange"
                                                >Share</v-btn
                                            >
                                            <v-btn text color="orange"
                                                >Explore</v-btn
                                            >
                                        </v-card-actions>
                                    </v-card>
                                </v-hover>
                            </v-flex>
                            <v-flex xs12 md3>
                                <v-hover v-slot:default="{ hover }">
                                    <v-card
                                        :elevation="hover ? 12 : 2"
                                        class="mx-auto"
                                        max-width="320"
                                        flat
                                    >
                                        <v-img
                                            class="white--text"
                                            height="200px"
                                            src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                                        >
                                            <v-card-title
                                                class="align-end fill-height"
                                                >Top 10 Australian
                                                beaches</v-card-title
                                            >
                                        </v-img>

                                        <v-card-text>
                                            <span>Number 10</span>
                                            <br />
                                            <span class="text--primary">
                                                <span>Whitehaven Beach</span>
                                                <br />
                                                <span
                                                    >Whitsunday Island,
                                                    Whitsunday Islands</span
                                                >
                                            </span>
                                        </v-card-text>

                                        <v-card-actions>
                                            <v-btn text color="orange"
                                                >Share</v-btn
                                            >
                                            <v-btn text color="orange"
                                                >Explore</v-btn
                                            >
                                        </v-card-actions>
                                    </v-card>
                                </v-hover>
                            </v-flex>
                            <v-flex xs12 md3>
                                <v-hover v-slot:default="{ hover }">
                                    <v-card
                                        :elevation="hover ? 12 : 2"
                                        class="mx-auto"
                                        max-width="320"
                                        flat
                                    >
                                        <v-img
                                            class="white--text"
                                            height="200px"
                                            src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                                        >
                                            <v-card-title
                                                class="align-end fill-height"
                                                >Top 10 Australian
                                                beaches</v-card-title
                                            >
                                        </v-img>

                                        <v-card-text>
                                            <span>Number 10</span>
                                            <br />
                                            <span class="text--primary">
                                                <span>Whitehaven Beach</span>
                                                <br />
                                                <span
                                                    >Whitsunday Island,
                                                    Whitsunday Islands</span
                                                >
                                            </span>
                                        </v-card-text>

                                        <v-card-actions>
                                            <v-btn text color="orange"
                                                >Share</v-btn
                                            >
                                            <v-btn text color="orange"
                                                >Explore</v-btn
                                            >
                                        </v-card-actions>
                                    </v-card>
                                </v-hover>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-flex>
            </v-layout>
        </section>
    </v-content>
</template>
<script>
export default {
    data: () => ({
        items: [
            {
                color: "#1F7087",
                src: "https://cdn.vuetifyjs.com/images/cards/foster.jpg",
                title: "Supermodel",
                artist: "Foster the People"
            },
            {
                color: "#952175",
                src: "https://cdn.vuetifyjs.com/images/cards/halcyon.png",
                title: "Halcyon Days",
                artist: "Ellie Goulding"
            }
        ]
    })
};
</script>
