<template>
    <v-navigation-drawer
        :mini-variant.sync="mini"
        app
        src="/static/bg/13.jpg"
        dark
        class="app--drawer pt-0 pb-7"
        v-model="showDrawer"
        :width="drawWidth"
    >
        <router-link to="/dashboard">
            <v-toolbar color="primary darken-1" dark>
                <img :src="computeLogo" height="36" alt="Code-Slack" />
                <v-toolbar-title class="ml-0 pl-3">
                    <span class="hidden-sm-and-down">Code Slack</span>
                </v-toolbar-title>
            </v-toolbar>
        </router-link>

        <v-divider></v-divider>
        <!-- <vue-perfect-scrollbar class="drawer-menu--scroll" :settings="scrollSettings"> -->
        <v-list dense nav rounded>
            <template v-for="item in menus">
                <!--group with subitems-->
                <v-list-group
                    v-if="item.items"
                    :key="item.title"
                    :group="item.group"
                    :prepend-icon="item.icon"
                    no-action
                    link
                >
                    <v-list-item slot="activator">
                        <v-list-item-content>
                            <v-list-item-title>{{
                                item.title
                            }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <template v-for="subItem in item.items">
                        <!--sub group-->
                        <v-list-group
                            v-if="subItem.items"
                            :key="subItem.title"
                            :group="subItem.group"
                            sub-group="sub-group"
                            link
                        >
                            <v-list-item slot="activator">
                                <v-list-item-content>
                                    <v-list-item-title>{{
                                        subItem.title
                                    }}</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item
                                v-for="grand in subItem.items"
                                :key="grand.title"
                                :to="genChildTarget(item, grand)"
                                :href="grand.href"
                                ripple="ripple"
                                link
                            >
                                <v-list-item-icon>
                                    <v-icon>{{ grand.icon }}</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>{{
                                        grand.title
                                    }}</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-group>
                        <!--child item-->
                        <v-list-item
                            v-else
                            :key="subItem.title"
                            :to="genChildTarget(item, subItem)"
                            :href="subItem.href"
                            :disabled="subItem.disabled"
                            :target="subItem.target"
                            ripple="ripple"
                            link
                        >
                            <v-list-item-icon v-if="subItem.icon">
                                <v-icon>{{ subItem.icon }}</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>
                                    <span>{{ subItem.title }}</span>
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-action v-if="subItem.action">
                                <v-icon
                                    :class="[
                                        subItem.actionClass || 'success--text'
                                    ]"
                                    >{{ subItem.action }}</v-icon
                                >
                            </v-list-item-action>
                        </v-list-item>
                    </template>
                </v-list-group>
                <v-subheader v-else-if="item.header" :key="item.name">{{
                    item.header
                }}</v-subheader>
                <v-divider
                    v-else-if="item.divider"
                    :key="item.name"
                ></v-divider>
                <!--top-level link-->
                <v-list-item
                    v-else
                    :to="!item.href ? item.name : null"
                    :href="item.href"
                    ripple="ripple"
                    :disabled="item.disabled"
                    :target="item.target"
                    rel="noopener"
                    :key="item.title"
                    link
                >
                    <v-list-item-action v-if="item.icon">
                        <v-icon v-if="item.color" :color="item.color">{{
                            item.icon
                        }}</v-icon>
                        <v-icon v-else>{{ item.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                    <v-list-item-action v-if="item.subAction">
                        <v-icon class="success--text">{{
                            item.subAction
                        }}</v-icon>
                    </v-list-item-action>
                </v-list-item>
            </template>
        </v-list>
        <!-- </vue-perfect-scrollbar> -->
    </v-navigation-drawer>
</template>

<script>
import menu from "./../../../api/adminmenu";
// import VuePerfectScrollbar from "vue-perfect-scrollbar"
export default {
    name: "AppDrawer",
    // components: {
    // 	VuePerfectScrollbar
    // },
    props: {
        expanded: {
            type: Boolean,
            default: true
        },
        drawWidth: {
            type: [Number, String],
            default: "260"
        }
    },
    data() {
        return {
            mini: false,
            menus: menu,
            scrollSettings: {
                maxScrollbarLength: 160
            }
        };
    },
    computed: {
        computeGroupActive() {
            return true;
        },
        computeLogo() {
            return "/assets/m.png";
        },

        sideToolbarColor() {
            return this.$vuetify.options.extra.sideNav;
        },
        showDrawer: {
            get() {
                return this.$store.state.showDrawer;
            },
            set(val) {
                this.$store.commit("showDrawer", val);
            }
        }
    },
    created() {},

    methods: {
        genChildTarget(item, subItem) {
            if (subItem.href) return;
            if (subItem.component) {
                return {
                    name: subItem.component
                };
            }
            return { name: `${item.group}/${subItem.name}` };
        }
    }
};
</script>

<style scoped>
.app--drawer {
    overflow: hidden;
}
.app--drawer .drawer-menu--scroll {
    height: calc(100vh - 100px);
    overflow: auto;
}
</style>