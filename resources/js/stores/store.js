import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: {},
        userInfo: {},
        userPhoto: null,
        status: "",
        showDrawer: true,
        authenticated: false,
        token: localStorage.getItem("token") || "",
        pagination: {
            current_page: 1,
            total_pages: 0,
            rowsPerPage: 10,
            visible: 7
        },
        drivings: [],
        cs: {
            overlay: false
        }
    },
    mutations: {
        errorResponses(state, err) {
            console.log(err);
            if (err.response) {
                let hasError = err.response.data;
                let errorInfos = err.response.data.error;
                if (hasError.code === 409) {
                    toastr["warning"](hasError.error.error, "Warning");
                } else if (
                    err.response.status === 401 ||
                    err.response.status === 422
                ) {
                    for (let i in errorInfos) {
                        if (errorInfos.hasOwnProperty(i)) {
                            toastr["error"](errorInfos[i], "Error");
                        }
                    }
                } else {
                    toastr["info"](errorInfos, "Info");
                }
            }
        },
        auth_request(state) {
            state.status = "loading";
        },
        auth_success(state, token, user) {
            state.status = "success";
            state.token = token;
            state.user = user;
        },
        auth_user(state, payload) {
            state.status = "success";
            state.userInfo = payload.data;
            state.authenticated = payload.authenticated;
        },
        user_photo(state, payload) {
            let pic = payload.data.photo;

            let photo =
                pic.length > 200 ? pic : baseUrl + "/img/profile/" + pic;

            state.userPhoto = photo;
        },
        auth_error(state) {
            console.log("here-store");
            state.status = "error";
        },
        logout(state) {
            state.status = "";
            state.token = "";
        },
        updateDrivings(state, payload) {
            state.drivings = payload.data;
            state.pagination = payload.meta.pagination;
        },
        showDrawer(state, val) {
            state.showDrawer = val;
        }
    },
    actions: {
        login({ commit }, user) {
            return new Promise((resolve, reject) => {
                commit("auth_request");
                axios({
                    url: baseUrl + "/auth/login",
                    data: user,
                    method: "POST"
                })
                    .then(resp => {
                        const token = resp.data.token;
                        const payload = resp.data;
                        localStorage.setItem("token", token);

                        axios.defaults.headers.common["Authorization"] = token;
                        commit("auth_success", token, payload);
                        commit("auth_user", payload);
                        commit("user_photo", payload);

                        resolve(payload);
                    })
                    .catch(err => {
                        commit("auth_error");

                        localStorage.removeItem("token");
                        reject(err);

                        if (
                            err.response.status === 401 ||
                            err.response.status === 422
                        ) {
                            toastr["error"](err.response.data, "Error");
                        } else {
                            toastr["error"](err.message, "Error");
                        }
                    });
            });
        },
        register({ commit }, user) {
            return new Promise((resolve, reject) => {
                commit("auth_request");
                axios({
                    url: baseUrl + "/auth/register",
                    data: user,
                    method: "POST"
                })
                    .then(resp => {
                        const token = resp.data.token;
                        const user = resp.data.user;
                        // localStorage.setItem("token", token);
                        localStorage.removeItem("token");

                        axios.defaults.headers.common["Authorization"] = token;
                        commit("auth_success", token, user);
                        resolve(resp);
                        toastr["success"]("Successfully register.", "Success");
                    })
                    .catch(err => {
                        commit("auth_error", err);
                        localStorage.removeItem("token");
                        reject(err);
                        let errorInfos = err.response.data.errors;
                        if (
                            err.response.status === 401 ||
                            err.response.status === 422
                        ) {
                            for (let i in errorInfos) {
                                if (errorInfos.hasOwnProperty(i)) {
                                    toastr["error"](errorInfos[i], "Error");
                                }
                            }
                        } else {
                            toastr["error"](err.message, "Error");
                        }
                    });
            });
        },

        async fetchAccessToken({ commit }) {
            let response = await axios.get("/auth/check");

            const payload = response.data;

            if (payload.data) {
                commit("auth_user", payload);
                commit("user_photo", payload);

                return response.data;
            }

            localStorage.removeItem("token");

            return payload;
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                commit("logout");
                try {
                    //axios({ url: baseUrl + "/api/auth/logout", method: "GET" });

                    localStorage.removeItem("token");
                    delete axios.defaults.headers.common["Authorization"];
                    resolve();

                    // toastr["success"](response.data.message, "Success");
                } catch (error) {
                    toastr["error"](error.message, "Error");
                }
            });
        },
        getDrivings(context, options) {
            this.state.cs.overlay = true;
            let page_number =
                options.page || this.state.pagination.current_page;
            axios
                .get(
                    options.url +
                    "?page=" +
                    page_number +
                    "&name=" +
                    options.search
                )
                .then(response => {
                    this.state.cs.overlay = false;
                    context.commit("updateDrivings", response.data);
                });
        },
        async fetchPaymentInfo({ commit }, options) {
            this.state.cs.overlay = true;

            let response = await axios({
                url: baseUrl + "/transactions/check",
                data: options,
                method: "POST"
            }).finally(() => {
                this.state.cs.overlay = false;
            });

            return response.data;
        }
    },
    getters: {
        authUser: state => state.userInfo,
        userAvatar: state => state.userPhoto,
        authStatus: state => state.status,
        isLoggedIn: state => !!state.token,
        authenticated: state => !!state.authenticated,
        walletBalance: state => state.userInfo.balance,
        drivings: state => state.drivings
    }
});
