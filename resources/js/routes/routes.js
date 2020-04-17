import VueRouter from "vue-router";
import store from "./../stores/store";

// Layouts
import LoginLayout from "./../pages/Layout/Login/LoginLayout.vue";
import GuestLayout from "./../pages/Layout/Guest/GuestLayout.vue";
import FrontLayout from "./../pages/Layout/Front/FrontLayout.vue";
import AdminLayout from "./../pages/Layout/Admin/AdminLayout.vue";

/*
 |--------------------------------------------------------------------------|
 | Guest Views                                                              |
 |--------------------------------------------------------------------------|
 */

import Home from "./../views/guest/Home.vue";
import Blog from "./../views/guest/Blog.vue";
import About from "./../views/guest/About.vue";
import Contact from "./../views/guest/Contact.vue";
import Login from "./../views/guest/Login.vue";
import Forgot from "./../views/guest/Forgot.vue";
import Register from "./../views/guest/Register.vue";

/*
 |--------------------------------------------------------------------------|
 | Admin Views                                                              |
 |--------------------------------------------------------------------------|
 */

import Dashboard from "./../views/admin/Dashboard.vue";
import AdminProfile from "./../views/admin/Profile.vue";
import AdminSettings from "./../views/admin/Settings.vue";
import AdminContacts from "./../views/admin/Contact.vue";
import AdminAffBirth from "./../views/admin/Affidavits/AffBirth.vue";
import AdminAffDl from "./../views/admin/Affidavits/AffDl.vue";
import AdminAffDob from "./../views/admin/Affidavits/AffDob.vue";
import AdminAffSamePerson from "./../views/admin/Affidavits/AffSamePerson.vue";

/*
 |--------------------------------------------------------------------------|
 | Front / User Views                                                       |
 |--------------------------------------------------------------------------|
 */

import FrontDashboard from "./../views/front/Dashboard.vue";
import FrontProfile from "./../views/front/Profile.vue";
import FrontWallet from "./../views/front/Wallet.vue";
import FrontSettings from "./../views/front/Settings.vue";
import FrontPan from "./../views/front/Contact.vue";
import FrontAffBirth from "./../views/front/Affidavits/AffBirth.vue";
import FrontAffDl from "./../views/front/Affidavits/AffDl.vue";
import FrontAffDob from "./../views/front/Affidavits/AffDob.vue";
import FrontAffSamePerson from "./../views/front/Affidavits/AffSamePerson.vue";

import FrontEntryDriving from "./../views/front/Driving/DlMain.vue";
import FrontProcessDriving from "@/views/front/Driving/DlProcess.vue";
import FrontSuccessDriving from "./../views/front/Driving/DlSuccess.vue";
import FrontHoldDriving from "./../views/front/Driving/DlHold.vue";
import FrontRejectDriving from "./../views/front/Driving/DlReject.vue";

// not found
import NotFoundPage from "./../views/errors/404.vue";

const routes = [
    /*
	|------------------------------------------------------------------------|
	| Auth & Registration Routes			                                 |	|------------------------------------------------------------------------|
	*/
    {
        path: "/auth",
        component: LoginLayout,
        redirect: "/auth/login",
        children: [
            {
                path: "login",
                name: "Login",
                component: Login
            },
            {
                path: "forgot",
                name: "Forgot",
                component: Forgot
            },
            {
                path: "register",
                name: "Register",
                component: Register
            }
        ]
    },

    /*
	|------------------------------------------------------------------------|
	| Guest Routes 							                                 |	|------------------------------------------------------------------------|
	*/
    {
        path: "/",
        component: GuestLayout,
        redirect: "/home",
        children: [
            {
                path: "home",
                name: "Home",
                component: Home
            },
            {
                path: "blog",
                name: "Blog",
                component: Blog
            },
            {
                path: "about",
                name: "About",
                component: About
            },
            {
                path: "contact",
                name: "Contact",
                component: Contact
            }
        ]
    },

    /*
        |------------------------------------------------------------------------|
        | Front/user Routes 		                                            |	------------------------------------------------------------------------|
        */
    {
        path: "/",
        component: FrontLayout,
        redirect: "/dashboard",
        meta: { title: "Dashboard", group: "apps", icon: "" },
        children: [
            {
                path: "dashboard",
                name: "Dashboard",
                component: FrontDashboard,
                meta: {
                    title: "Dashboard",
                    group: "apps",
                    icon: "mdi-view-dashboard",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },
            {
                path: "pan",
                name: "Pan",
                component: FrontPan,
                meta: {
                    title: "Pan",
                    group: "apps",
                    icon: "mdi-view-dashboard",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },
            {
                path: "user/profile",
                name: "Profile",
                component: FrontProfile,
                meta: {
                    title: "Profile User",
                    group: "apps",
                    icon: "mdi-view-dashboard",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },
            {
                path: "user/wallet",
                name: "Wallet",
                component: FrontWallet,
                meta: {
                    title: "Wallet User",
                    group: "apps",
                    icon: "mdi-view-dashboard",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },
            {
                path: "settings",
                name: "Settings",
                component: FrontSettings,
                meta: {
                    title: "Settings",
                    group: "apps",
                    icon: "mdi-view-dashboard",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },

            //Affidavits

            {
                path: "affidavits/birth",
                name: "BirthAffidavit",
                component: FrontAffBirth,
                meta: {
                    title: "Birth Affidavit",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },
            {
                path: "affidavits/dl",
                name: "DlAffidavit",
                component: FrontAffDl,
                meta: {
                    title: "Dl Affidavit",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },
            {
                path: "affidavits/dob",
                name: "DobAffidavit",
                component: FrontAffDob,
                meta: {
                    title: "DOB Affidavit",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },
            {
                path: "affidavits/sameperson",
                name: "SamePersonAffidavit",
                component: FrontAffSamePerson,
                meta: {
                    title: "Same Person Affidavit",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },

            // Drivings
            {
                path: "drivings/entry",
                name: "FrontEntryDriving",
                component: FrontEntryDriving,
                meta: {
                    title: "Entry Driving",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },
            {
                path: "drivings/process",
                name: "FrontProcessDriving",
                component: FrontProcessDriving,
                meta: {
                    title: "Process Driving",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },
            {
                path: "drivings/success",
                name: "FrontSuccessDriving",
                component: FrontSuccessDriving,
                meta: {
                    title: "Success Driving",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },
            {
                path: "drivings/hold",
                name: "FrontHoldDriving",
                component: FrontHoldDriving,
                meta: {
                    title: "Hold Driving",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            },
            {
                path: "drivings/reject",
                name: "FrontRejectDriving",
                component: FrontRejectDriving,
                meta: {
                    title: "Reject Driving",
                    requiresAuth: true,
                    userAuth: true,
                    adminAuth: false
                }
            }
        ]
    },

    /*
        |------------------------------------------------------------------------|
        | Admin Routes 							                                |	------------------------------------------------------------------------|
        */
    {
        path: "/admin",
        component: AdminLayout,
        redirect: "/admin/dashboard",
        meta: { title: "Dashboard", group: "apps", icon: "" },
        children: [
            {
                path: "dashboard",
                name: "AdminDashboard",
                component: Dashboard,
                meta: {
                    title: "Dashboard",
                    group: "apps",
                    icon: "mdi-view-dashboard",
                    requiresAuth: true,
                    adminAuth: true,
                    userAuth: false
                }
            },
            {
                path: "table",
                name: "Table",
                component: AdminContacts,
                meta: {
                    title: "Contact",
                    group: "apps",
                    icon: "mdi-view-dashboard",
                    requiresAuth: true,
                    adminAuth: true,
                    userAuth: false
                }
            },
            // {
            //     path: "profiles",
            //     name: "Profile",
            //     component: AdminProfile,
            //     meta: {
            //         title: "Profile",
            //         group: "apps",
            //         icon: "mdi-view-dashboard",
            //         requiresAuth: true,
            //         adminAuth: true,
            //         userAuth: false
            //     }
            // },
            // {
            //     path: "settings",
            //     name: "Settings",
            //     component: AdminSettings,
            //     meta: {
            //         title: "Settings",
            //         group: "apps",
            //         icon: "mdi-view-dashboard",
            //         requiresAuth: true,
            //         adminAuth: true,
            //         userAuth: false
            //     }
            // },

            //Affidavits

            {
                path: "affidavits/birth",
                name: "BirthAff",
                component: AdminAffBirth,
                meta: {
                    title: "Birth Affidavit",
                    requiresAuth: true,
                    adminAuth: true,
                    userAuth: false
                }
            }
            // {
            //     path: "affidavits/dls",
            //     name: "DlAffidavit",
            //     component: AdminAffDl,
            //     meta: {
            //         title: "Dl Affidavit",
            //         requiresAuth: true,
            //         adminAuth: true,
            //         userAuth: false
            //     }
            // },
            // {
            //     path: "affidavits/dobs",
            //     name: "DobAffidavit",
            //     component: AdminAffDob,
            //     meta: {
            //         title: "DOB Affidavit",
            //         requiresAuth: true,
            //         adminAuth: true,
            //         userAuth: false
            //     }
            // },
            // {
            //     path: "affidavits/samepersons",
            //     name: "SamePersonAffidavit",
            //     component: AdminAffSamePerson,
            //     meta: {
            //         title: "Same Person Affidavit",
            //         requiresAuth: true,
            //         adminAuth: true,
            //         userAuth: false
            //     }
            // }
        ]
    },

    //  DEFAULT ROUTE
    { path: "*", component: NotFoundPage }
];

const router = new VueRouter({
    routes,
    mode: "history",
    linkExactActiveClass: "nav-item active"
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            store
                .dispatch("fetchAccessToken")
                .then(resp => {
                    if (!resp.authenticated) {
                        return next({ path: "/auth/login" });
                    }

                    if (to.meta.adminAuth) {
                        if (resp.data.type === "admin") {
                            return next();
                        } else {
                            return next("/");
                        }
                    } else if (to.meta.userAuth) {
                        if (resp.data.type === "user") {
                            return next();
                        } else {
                            return next("/admin");
                        }
                    }
                })
                .catch(err => console.log(err));

            next();
            return;
        }
        next("/auth/login");
    } else {
        next();
    }
});

export default router;
