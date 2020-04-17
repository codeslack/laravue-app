<template>
    <v-app id="login" class="app login-app">
        <div class="login-page login">
            <div class="login-wrapper">
                <div class="login-box">
                    <div class="logo-main">
                        <v-layout align-center>
                            <v-flex text-center>
                                <h1 class="display-2 cyan--text">
                                    Whoops, 404
                                </h1>
                                <h5 class="my-2">You got Lost!</h5>
                                <v-btn
                                    @click="handleBack"
                                    outlined
                                    color="#00bcd4"
                                    >GO BACK!</v-btn
                                >
                            </v-flex>
                        </v-layout>
                    </div>

                    <div class="page-copyright">
                        <p>
                            Powered by
                            <a href="https://zsoftlink.com" target="_blank"
                                >Zsoftlink PVT LTD</a
                            >
                        </p>
                        <p>CodeSlack © {{ new Date().getFullYear() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </v-app>
</template>
<script>
export default {
    methods: {
        handleBack(fallback) {
            this.$router.back();
        }
    }
};
</script>
<style lang="scss" scoped>
.theme--light.v-application.login-app {
    background: transparent !important;
}
</style>
