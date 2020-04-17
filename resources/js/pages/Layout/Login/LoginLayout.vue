<template>
    <v-app id="login" class="app login-app">
        <div class="login-page login">
            <div class="login-wrapper">
                <div class="login-box">
                    <div class="logo-main">
                        <a href="/">
                            <img src="/assets/login.png" alt="CodeSlack Logo" />
                        </a>
                        <div class="md-title white--text">
                            {{ $route.name }}
                        </div>
                        <div class="body-2 white--text">
                            Provide user credentials for {{ $route.name }}!
                        </div>
                    </div>
                    <router-view />
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
<style lang="scss" scoped>
.theme--light.v-application.login-app {
    background: transparent !important;
    color: rgba(0, 0, 0, 0.87);
}
.login-page {
    .forgot-link {
        text-decoration: none !important;
    }
}
</style>
