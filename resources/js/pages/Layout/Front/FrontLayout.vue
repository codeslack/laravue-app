<template>
    <v-app id="inspire" class="app dashboard">
        <app-drawer class="app--drawer" />
        <app-toolbar class="app--toolbar" />

        <v-content>
            <app-breadcrumb></app-breadcrumb>
            <v-container class="page-wrapper" fluid>
                <router-view></router-view>
            </v-container>
            <app-footer />
        </v-content>
        <app-fab />
    </v-app>
</template>

<script>
import {
    AppDrawer,
    AppToolbar,
    AppBreadcrumb,
    AppFab,
    AppFooter
} from "./index";

export default {
    components: {
        AppFab,
        AppFooter,
        AppDrawer,
        AppToolbar,
        AppBreadcrumb
    },
    props: {
        source: String
    },

    data() {
        return {};
    },
    methods: {}
};
</script>
<style scoped>
.page-wrapper {
    min-height: calc(100vh - 64px - 50px - 81px);
}
</style>
