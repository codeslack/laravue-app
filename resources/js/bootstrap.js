window._ = require("lodash");

window.toastr = require("toastr");
toastr.options = {
    progressBar: true,
    positionClass: "toast-top-right",
    showMethod: "slideDown",
    hideMethod: "slideUp"
};

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.axios.interceptors.request.use(
    function(config) {
        const token = localStorage.getItem("token") || "";

        if (token) {
            config.headers.common["Authorization"] = `Bearer ${token}`;
        }

        return config;
    },
    function(error) {
        return Promise.reject(error);
    }
);
