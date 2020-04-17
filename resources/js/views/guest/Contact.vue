<template>
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
                            >Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Nihil animi omnis aspernatur quo itaque
                            distinctio laboriosam laudantium ratione, ipsa
                            delectus debitis impedit necessitatibus maxime totam
                            unde accusamus dignissimos sunt
                            voluptates.</v-card-text
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
                            >Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Iste quibusdam nisi saepe laboriosam neque,
                            amet inventore architecto vel modi cupiditate
                            blanditiis distinctio facilis ab excepturi.
                            Accusantium maiores eius debitis modi.</v-card-text
                        >
                        <v-list class="transparent">
                            <v-list-item>
                                <v-list-item-action>
                                    <v-icon class="blue--text text--lighten-2"
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
                                    <v-icon class="blue--text text--lighten-2"
                                        >mdi-map-marker</v-icon
                                    >
                                </v-list-item-action>
                                <v-list-item-content>
                                    <v-list-item-title
                                        >West Bengal, India</v-list-item-title
                                    >
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-action>
                                    <v-icon class="blue--text text--lighten-2"
                                        >mdi-email</v-icon
                                    >
                                </v-list-item-action>
                                <v-list-item-content>
                                    <v-list-item-title
                                        >info@zsoftlink.com</v-list-item-title
                                    >
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </section>
</template>
<script>
export default {
    data: () => ({
        show: false
    })
};
</script>
