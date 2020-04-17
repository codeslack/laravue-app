<template>
    <section>
        <section>
            <v-parallax src="assets/hero.jpeg" height="600">
                <v-layout
                    column
                    align-center
                    justify-center
                    class="white--text"
                >
                    <img
                        src="assets/vuetify.png"
                        alt="Vuetify.js"
                        height="200"
                    />
                    <h1 class="white--text mb-2 display-1 text-center">
                        Zsoftlink
                    </h1>
                    <div class="subheading mb-4 text-center">
                        Powered by zsoftlink PVT LTD
                    </div>
                    <v-btn
                        class="mt-12"
                        color="blue lighten-2"
                        dark
                        large
                        to="/auth/login"
                        >Get Started</v-btn
                    >
                </v-layout>
            </v-parallax>
        </section>

        <section>
            <v-layout column wrap class="my-12" align-center>
                <v-flex xs12 sm4 class="my-4">
                    <div class="text-center">
                        <h2 class="headline">
                            The best way to start developing
                        </h2>
                        <span class="subheading"
                            >Cras facilisis mi vitae nunc</span
                        >
                    </div>
                </v-flex>
                <v-flex xs12>
                    <v-container grid-list-xl>
                        <v-layout row wrap align-center>
                            <v-flex xs12 md4>
                                <v-card flat class="transparent">
                                    <v-card-text class="text-center">
                                        <v-icon
                                            x-large
                                            class="blue--text text--lighten-2"
                                            >mdi-palette</v-icon
                                        >
                                    </v-card-text>
                                    <v-card-title
                                        primary-title
                                        class="layout justify-center"
                                    >
                                        <div class="headline text-center">
                                            Material Design
                                        </div>
                                    </v-card-title>
                                    <v-card-text>
                                        Cras facilisis mi vitae nunc lobortis
                                        pharetra. Nulla volutpat tincidunt
                                        ornare. Pellentesque habitant morbi
                                        tristique senectus et netus et malesuada
                                        fames ac turpis egestas. Nullam in
                                        aliquet odio. Aliquam eu est vitae
                                        tellus bibendum tincidunt. Suspendisse
                                        potenti.
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
                                        <div class="headline">
                                            Fast development
                                        </div>
                                    </v-card-title>
                                    <v-card-text>
                                        Cras facilisis mi vitae nunc lobortis
                                        pharetra. Nulla volutpat tincidunt
                                        ornare. Pellentesque habitant morbi
                                        tristique senectus et netus et malesuada
                                        fames ac turpis egestas. Nullam in
                                        aliquet odio. Aliquam eu est vitae
                                        tellus bibendum tincidunt. Suspendisse
                                        potenti.
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs12 md4>
                                <v-card flat class="transparent" height="320">
                                    <v-card-text class="text-center">
                                        <v-icon
                                            x-large
                                            class="blue--text text--lighten-2"
                                            >fa-bullhorn</v-icon
                                        >
                                    </v-card-text>
                                    <v-card-title
                                        primary-title
                                        class="layout justify-center"
                                    >
                                        <div class="headline text-center">
                                            Latest Update
                                        </div>
                                    </v-card-title>
                                    <v-card-text>
                                        <marquee
                                            direction="up"
                                            scrollamount="3"
                                        >
                                            Lorem ipsum, dolor sit amet
                                            consectetur adipisicing elit. Et
                                            dolore ipsa quod nulla suscipit nisi
                                            minus? Modi totam ratione molestias
                                            rerum omnis nisi quas, corrupti
                                            voluptatum, quidem mollitia sequi
                                            aspernatur. Lorem ipsum dolor sit
                                            amet consectetur, adipisicing elit.
                                            Quae molestiae maiores atque?
                                            Dolores nemo vel velit maiores,
                                            itaque commodi nobis molestiae
                                            voluptates blanditiis cumque
                                            veritatis. Quibusdam distinctio
                                            fugiat iusto ipsam!
                                            <ul>
                                                <li>
                                                    Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing
                                                    elit. Fugit quae impedit
                                                    provident recusandae qui,
                                                    voluptatibus deserunt ipsam
                                                    iste ad minima odit facere
                                                    ab. Ullam, distinctio
                                                    eligendi. Veritatis corrupti
                                                    alias architecto?
                                                </li>
                                                <li>
                                                    Lorem ipsum dolor sit amet,
                                                    consectetur adipisicing
                                                    elit. Iste quae ad,
                                                    assumenda vel aliquam
                                                    laboriosam quis. Nemo
                                                    placeat incidunt deleniti
                                                    deserunt, error laudantium
                                                    aperiam expedita dolorum
                                                    dolore facilis ipsa
                                                    voluptate! Lorem ipsum,
                                                    dolor sit amet consectetur
                                                    adipisicing elit. Tempore
                                                    aliquid expedita, eligendi
                                                    doloribus a autem velit
                                                    cumque molestiae eaque non
                                                    tenetur soluta iure minima
                                                    eos ea. Voluptatibus id quod
                                                    nobis.
                                                </li>
                                            </ul>
                                            Lorem ipsum dolor sit amet
                                            consectetur adipisicing elit.
                                            Recusandae accusantium dolores,
                                            consequatur quibusdam, nostrum harum
                                            nam, delectus libero aspernatur
                                            fugit laborum ratione. Excepturi
                                            ducimus dolore quae impedit
                                            voluptates numquam optio! Lorem
                                            ipsum dolor sit amet consectetur,
                                            adipisicing elit. Placeat blanditiis
                                            eos necessitatibus, error reiciendis
                                            illo nihil dolore eveniet eaque
                                            exercitationem at cupiditate beatae
                                            neque! Beatae, similique. Dolorem
                                            molestias nulla quos?
                                        </marquee>
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
                    <div class="headline white--text mb-4 text-center">
                        Web development has never been easier
                    </div>
                    <em>Kick-start your application today</em>
                    <v-btn
                        class="mt-12"
                        color="blue lighten-2"
                        dark
                        large
                        to="/auth/login"
                        >Get Started</v-btn
                    >
                </v-layout>
            </v-parallax>
        </section>

        <section>
            <v-container grid-list-xl>
                <v-layout row wrap justify-center class="my-12">
                    <v-flex xs12 sm4>
                        <v-card flat class="transparent">
                            <v-card-title
                                primary-title
                                class="layout justify-center"
                            >
                                <div class="headline">Company info</div>
                            </v-card-title>
                            <v-card-text
                                >Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Nihil animi omnis aspernatur
                                quo itaque distinctio laboriosam laudantium
                                ratione, ipsa delectus debitis impedit
                                necessitatibus maxime totam unde accusamus
                                dignissimos sunt voluptates.</v-card-text
                            >
                        </v-card>
                    </v-flex>
                    <v-flex xs12 sm4 offset-sm1>
                        <v-card flat class="transparent">
                            <v-card-title
                                primary-title
                                class="layout justify-center"
                            >
                                <div class="headline">Contact us</div>
                            </v-card-title>
                            <v-card-text
                                >Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Iste quibusdam nisi saepe
                                laboriosam neque, amet inventore architecto vel
                                modi cupiditate blanditiis distinctio facilis ab
                                excepturi. Accusantium maiores eius debitis
                                modi.</v-card-text
                            >
                            <v-list class="transparent">
                                <v-list-item>
                                    <v-list-item-action>
                                        <v-icon
                                            class="blue--text text--lighten-2"
                                            >mdi-phone</v-icon
                                        >
                                    </v-list-item-action>
                                    <v-list-item-content>
                                        <v-list-item-title
                                            >(+91) - 75 8250 755
                                            744</v-list-item-title
                                        >
                                    </v-list-item-content>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-action>
                                        <v-icon
                                            class="blue--text text--lighten-2"
                                            >mdi-map-marker</v-icon
                                        >
                                    </v-list-item-action>
                                    <v-list-item-content>
                                        <v-list-item-title
                                            >West Bengal,
                                            India</v-list-item-title
                                        >
                                    </v-list-item-content>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-action>
                                        <v-icon
                                            class="blue--text text--lighten-2"
                                            >mdi-email</v-icon
                                        >
                                    </v-list-item-action>
                                    <v-list-item-content>
                                        <v-list-item-title
                                            >info@zsoftlink.com.in</v-list-item-title
                                        >
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </section>
        <v-divider></v-divider>

        <section>
            <v-flex xs12 class="my-4 mb-0">
                <marquee
                    behavior="alternate"
                    direction="left"
                    loop="INFINITE"
                    onmouseout="this.start();"
                    onmouseover="this.stop();"
                    scrollamount="9"
                >
                    <a
                        href="#"
                        v-for="(item, index) in popularOffers"
                        :key="index"
                    >
                        <img
                            :src="item.image"
                            style="width: 335px; height: 186px; "
                        />
                    </a>
                </marquee>
            </v-flex>
        </section>
    </section>
</template>
<script>
export default {
    data() {
        return {
            popularOffers: [
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
            ]
        };
    }
};
</script>
