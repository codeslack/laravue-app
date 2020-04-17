require("./bootstrap");

window.baseUrl = window.location.origin;
import Vue from "vue";
import App from "./App.vue";
import Vuelidate from "vuelidate";
import VueRouter from "vue-router";
import vuetify from "./plugins/vuetify";
import store from "./stores/store";
import moment from "moment";
import CsTimeAgo from "vue-cs-timeago";

import axios from "axios";

Vue.prototype.$http = axios;
Vue.prototype.$moment = moment;

const token = localStorage.getItem("token");

if (token) {
    Vue.prototype.$http.defaults.headers.common[
        "Authorization"
    ] = `Bearer ${token}`;
}

Vue.filter("capitalize", function(value) {
    if (!value) return "";
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});

Vue.filter("upperCase", function(value) {
    if (!value) return "";
    value = value.toString();
    return value.toUpperCase();
});

Vue.filter("toINRCrDr", function(value) {
    return `₹ ${Math.abs(value)
        .toFixed(2)
        .toLocaleString()} ${value <= 0 ? "Cr" : "Dr"}`;
});

Vue.filter("toINR", function(value) {
    return `₹ ${Math.abs(value)
        .toFixed(2)
        .toLocaleString()}`;
});

Vue.filter("readMore", function(text, length, suffix) {
    return text.substring(0, length) + suffix;
});

Vue.filter("myDate", function(created) {
    return moment(created).format("D MMM. YYYY");
});
// router setup
import router from "./routes/routes";

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(CsTimeAgo);

Vue.config.productionTip = false;
Vue.config.devtools = false;
window.Fire = new Vue();
new Vue({
    vuetify,
    router,
    store,
    render: h => h(App)
}).$mount("#app");
