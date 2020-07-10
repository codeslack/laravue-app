<template>
    <v-container id="admin-wallet" fluid>
        <v-row justify="center">
            <v-col cols="12">
                <v-widget title="Wallet Info">
                    <template slot="widget-content">
                        <v-data-table
                            :headers="headers"
                            :items="desserts"
                            :options.sync="options"
                            :server-items-length="totalDesserts"
                            :footer-props="{
                                showFirstLastPage: true,
                                'items-per-page-options': [5, 15, 20, 50]
                            }"
                            :items-per-page="20"
                            :loading="loading"
                            loading-text="Loading... Please wait"
                            class="elevation-1 vwidget-table-admin-wallet"
                            item-key="identifier"
                        >
                            <template v-slot:top>
                                <v-toolbar flat color="white">
                                    <v-text-field
                                        flat
                                        solo
                                        prepend-icon="mdi-magnify"
                                        placeholder="Type something"
                                        v-model="search"
                                        hide-details
                                        class="dhidden-sm-and-down"
                                        @keyup="searchit"
                                    ></v-text-field>
                                    <v-btn icon>
                                        <v-icon>mdi-filter-variant</v-icon>
                                    </v-btn>

                                    <v-dialog v-model="dialog" max-width="320">
                                        <v-card>
                                            <v-card-text>
                                                <v-container>
                                                    <img
                                                        width="100%"
                                                        height="100%"
                                                        :src="zoomImg"
                                                        alt
                                                    />
                                                </v-container>
                                            </v-card-text>

                                            <v-card-actions>
                                                <v-spacer></v-spacer>

                                                <v-btn
                                                    color="green darken-1"
                                                    text
                                                    @click="dialog = false"
                                                >
                                                    Ok
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-toolbar>
                                <v-divider></v-divider>
                            </template>

                            <template v-slot:item.amount="{ item }">
                                <span>{{ item.amount | toINR }}</span>
                            </template>

                            <template v-slot:item.avatar="{ item }">
                                <v-btn
                                    outlined
                                    fab
                                    small
                                    @click="onZoomImg(item.avatar)"
                                >
                                    <v-avatar size="32">
                                        <img :src="item.avatar" alt />
                                    </v-avatar>
                                </v-btn>
                            </template>

                            <template v-slot:item.status="{ item }">
                                <v-chip
                                    small
                                    class="ma-2"
                                    text-color="white"
                                    v-html="item.status"
                                    :color="item.status_color"
                                ></v-chip>
                            </template>

                            <template v-slot:item.action="{ item }">
                                <v-btn
                                    outlined
                                    fab
                                    x-small
                                    @click="onZoomImg(item.file_name)"
                                >
                                    <v-avatar size="32">
                                        <img :src="item.file_name" alt />
                                    </v-avatar>
                                </v-btn>

                                <v-btn
                                    color="primary"
                                    fab
                                    dark
                                    x-small
                                    @click="onVerify(item)"
                                >
                                    <v-icon small>mdi-pencil-outline</v-icon>
                                </v-btn>
                            </template>
                        </v-data-table>
                    </template>
                </v-widget>
            </v-col>
        </v-row>
        <div>
            <v-dialog v-model="dialogForm" max-width="320">
                <v-widget
                    class="v-widget-timeline"
                    title="Wallet Update"
                    content-bg="white"
                    :enableFooter="true"
                >
                    <template slot="widget-header-action">
                        <v-tooltip bottom>
                            <template v-slot:activator="{ on }">
                                <v-icon
                                    v-on="on"
                                    @click.stop="dialogForm = false"
                                    >mdi-close</v-icon
                                >
                            </template>
                            <span>Close</span>
                        </v-tooltip>
                    </template>
                    <div slot="widget-content">
                        <v-autocomplete
                            v-model="editItems.payType"
                            :items="states"
                            item-text="name"
                            item-value="id"
                            label="Select Payment Type"
                        ></v-autocomplete>

                        <v-radio-group
                            v-model="editItems.radioOption"
                            label="Select status"
                            column
                        >
                            <v-radio
                                label="Reject"
                                value="r"
                                color="red"
                            ></v-radio>
                            <v-radio
                                label="Success"
                                value="s"
                                color="success"
                            ></v-radio>
                        </v-radio-group>
                    </div>
                    <template slot="widget-footer-action">
                        <v-spacer></v-spacer>

                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    class="ma-2 white--text"
                                    color="red"
                                    v-on="on"
                                    @click.stop="dialogForm = false"
                                >
                                    Close
                                    <v-icon dark right>mdi-cancel</v-icon>
                                </v-btn>
                            </template>
                            <span>Close</span>
                        </v-tooltip>

                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    class="ma-2"
                                    color="primary"
                                    dark
                                    v-on="on"
                                    :loading="isProcessing"
                                    @click="onSave"
                                >
                                    Save
                                    <v-icon dark right
                                        >mdi-checkbox-marked-circle</v-icon
                                    >
                                </v-btn>
                            </template>
                            <span>Save</span>
                        </v-tooltip>
                    </template>
                </v-widget>
            </v-dialog>
        </div>
    </v-container>
</template>

<script>
import _ from "lodash";
import VWidget from "@/components/widgets/VWidget";
import WalletForm from "@/components/widgets/form/WalletForm";
export default {
    components: {
        VWidget,
        WalletForm
    },
    data() {
        return {
            editItems: {
                identifier: null,
                order_id: null,
                amount: null,
                radioOption: null,
                payType: null
            },
            dialog: false,
            dialogForm: false,
            zoomImg: null,
            isProcessing: false,
            selectedFile: null,
            password: null,
            photo: "profile.svg",
            showDialogForm: false,
            btnAddon: true,
            hideItems: {},
            desserts: [],
            search: "",
            totalDesserts: 0,
            pagination: { rowsPerPage: 15 },
            loading: false,
            btnLoading: false,
            options: {},
            states: [
                { id: 1, name: "Cash" },
                { id: 2, name: "Cheque" },
                { id: 3, name: "NEFT / RTGS" },
                { id: 4, name: "Demand Draf" },
                { id: 5, name: "Pay Order" },
                { id: 6, name: "Credit Card" },
                { id: 7, name: "Debit Card" },
                { id: 8, name: "Swipe" },
                { id: 9, name: "Google Pay" },
                { id: 10, name: "Phone Pay" },
                { id: 14, name: "Others" }
            ],
            headers: [
                {
                    text: "Customer",
                    value: "avatar",
                    sortable: false,
                    width: "45px"
                },

                {
                    text: "Trans Date",
                    value: "trans_date",
                    sortable: false,
                    width: "120px"
                },
                {
                    text: "Order Id",
                    value: "order_id",
                    sortable: false,
                    width: "150px"
                },
                {
                    text: "Amount",
                    value: "amount",
                    sortable: false,
                    width: "100px",
                    align: "right"
                },
                {
                    text: "Status",
                    value: "status",
                    sortable: false,
                    width: "70px",
                    align: "center"
                },
                {
                    text: "Actions",
                    value: "action",
                    sortable: false,
                    width: "90px",
                    align: "center"
                }
            ]
        };
    },
    computed: {
        walletBalance() {
            return this.$store.getters.walletBalance;
        },
        parms(nv) {
            return {
                ...this.options,
                query: this.search
            };
        }
    },
    watch: {
        options: {
            handler() {
                this.getDataFromApi().then(data => {
                    this.desserts = data.items;
                    this.totalDesserts = data.total;
                });
            },
            deep: true
        }
    },

    methods: {
        onZoomImg(imgPath) {
            this.zoomImg = imgPath;
            this.dialog = true;
        },
        getProfilePhoto() {
            return baseUrl + "/img/profile/" + this.photo;
        },
        updateEvents() {
            this.getDataFromApi().then(data => {
                this.desserts = data.items;
                this.totalDesserts = data.total;
            });
        },
        onVerify(item) {
            this.editItems = {
                identifier: item.identifier,
                order_id: item.order_id,
                amount: item.amount
            };
            this.dialogForm = true;
        },
        onSave() {
            this.isProcessing = true;

            if (!this.editItems.radioOption) {
                toastr["error"]("Please select status !", "Error");
                this.isProcessing = false;
                return;
            }
            if (!this.editItems.payType) {
                toastr["error"]("Please select payment type !", "Error");
                this.isProcessing = false;
                return;
            }

            axios
                .post("/admin/vouchers", this.editItems)
                .then(resp => {
                    this.updateEvents();
                    toastr[resp.data.data.type](
                        resp.data.data.message,
                        resp.data.data.title
                    );
                })
                .catch(err => {
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
                })
                .finally(() => {
                    this.onClose();
                    this.isProcessing = false;
                });
        },
        onClose() {
            this.editItems = {
                identifier: null,
                order_id: null,
                amount: null,
                radioOption: null,
                payType: null
            };

            this.dialogForm = false;
        },
        getDataFromApi() {
            this.loading = true;
            return new Promise((resolve, reject) => {
                const { sortBy, sortDesc, page, itemsPerPage } = this.options;
                let search = this.search.trim().toLowerCase();

                axios
                    .get(
                        "/admin/wallet/verify?page=" +
                            page +
                            "&itemsPerPage=" +
                            itemsPerPage +
                            "&q=" +
                            search
                    )
                    .then(resp => {
                        if (Object.keys(resp.data.data).length < 1) {
                            this.loading = false;
                            return;
                        }
                        let listOfObjects = Object.keys(resp.data.data).map(
                            key => {
                                return resp.data.data[key];
                            }
                        );
                        let items = listOfObjects;

                        if (search) {
                            items = items.filter(item => {
                                return Object.values(item)
                                    .join(",")
                                    .toLowerCase()
                                    .includes(search);
                            });
                        }

                        if (sortBy.length === 1 && sortDesc.length === 1) {
                            items = items.sort((a, b) => {
                                const sortA = a[sortBy[0]];
                                const sortB = b[sortBy[0]];

                                if (sortDesc[0]) {
                                    if (sortA < sortB) return 1;
                                    if (sortA > sortB) return -1;
                                    return 0;
                                } else {
                                    if (sortA < sortB) return -1;
                                    if (sortA > sortB) return 1;
                                    return 0;
                                }
                            });
                        }

                        const total = resp.data.meta.pagination.total;

                        setTimeout(() => {
                            this.loading = false;
                            resolve({
                                items,
                                total
                            });
                        }, 1000);
                    })
                    .catch(error => {
                        if (error.resp) {
                            console.log(error.resp);
                        }
                    });
            });
        },
        searchit: _.debounce(() => {
            Fire.$emit("searching");
        }, 1000)
    },
    created() {
        Fire.$on("AfterEvents", () => {
            this.getDataFromApi().then(data => {
                this.desserts = data.items;
                this.totalDesserts = data.total;
            });
        });

        Fire.$on("searching", () => {
            this.getDataFromApi().then(data => {
                this.desserts = data.items;
                this.totalDesserts = data.total;
            });
        });
    }
};
</script>
