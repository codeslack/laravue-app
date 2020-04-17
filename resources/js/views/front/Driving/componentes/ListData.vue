<template>
    <v-card class="mx-auto" fluid>
        <v-toolbar flat color="white">
            <v-text-field
                flat
                solo
                prepend-icon="mdi-magnify"
                placeholder="Type something"
                hide-details
                v-model="options.search"
                @keyup="searchit"
            ></v-text-field>

            <v-spacer></v-spacer>

            <template v-if="btnAddon">
                <v-chip
                    outlined
                    color="teal"
                    @click.stop="
                        showDialogForm = true;
                        hiddenProp = null;
                    "
                >
                    New
                    <v-icon right color="teal">mdi-plus-circle-outline</v-icon>
                </v-chip>
                <dialog-form
                    v-model="showDialogForm"
                    :labeled="labeled"
                    :url="url"
                    :hiddenProp="hiddenProp"
                    @update-cart="updateCart"
                />

                <payment-form
                    v-model="showPaymentForm"
                    labeled="Make Payment"
                    url="/transactions"
                    :hiddenProp="dataPaymentForm"
                    @update-cart="updateCart"
                />
            </template>
        </v-toolbar>

        <v-container fluid>
            <v-row dense>
                <v-col
                    v-for="item in drivings"
                    :key="item.order_id"
                    cols="12"
                    sm="3"
                    md="3"
                >
                    <v-card>
                        <v-list-item>
                            <v-list-item-avatar color="grey darken-3">
                                <v-img
                                    class="elevation-6"
                                    :src="imageUrl.avatar"
                                ></v-img>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-card-title class="pa-0">
                                    {{ item.service_code | upperCase }}
                                </v-card-title>
                                <v-list-item-subtitle
                                    v-text="item.name"
                                ></v-list-item-subtitle>
                                <v-list-item-subtitle
                                    v-text="item.order_id"
                                ></v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>

                        <v-speed-dial
                            :key="item.identifier"
                            top
                            right
                            direction="bottom"
                            :open-on-hover="true"
                            transition="slide-y-reverse-transition"
                            absolute
                            v-if="enableBtnAction"
                        >
                            <template v-slot:activator>
                                <v-btn
                                    :key="item.identifier"
                                    color="blue darken-2"
                                    dark
                                    fab
                                    x-small
                                >
                                    <v-icon v-if="item.identifier"
                                        >mdi-buffer</v-icon
                                    >
                                    <v-icon v-else>mdi-account-circle</v-icon>
                                </v-btn>
                            </template>

                            <v-tooltip left>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        fab
                                        dark
                                        x-small
                                        color="indigo"
                                        @click="editItem(item)"
                                        v-on="on"
                                    >
                                        <v-icon>mdi-pencil</v-icon>
                                    </v-btn>
                                </template>
                                <span>Edit</span>
                            </v-tooltip>
                            <v-tooltip left>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        fab
                                        dark
                                        x-small
                                        color="green"
                                        @click="onPayment(item)"
                                        v-on="on"
                                    >
                                        <v-icon>mdi-currency-inr</v-icon>
                                    </v-btn>
                                </template>
                                <span>Payment</span>
                            </v-tooltip>
                            <v-btn fab dark x-small color="red">
                                <v-icon>mdi-delete</v-icon>
                            </v-btn>
                        </v-speed-dial>

                        <v-speed-dial
                            v-model="item.identifier"
                            top
                            right
                            absolute
                            x-small
                            v-else
                        >
                            <template v-slot:activator>
                                <v-icon color="green" text-color="white"
                                    >mdi-orbit</v-icon
                                >
                            </template>
                        </v-speed-dial>

                        <v-img
                            :src="imageUrl.background"
                            class="white--text align-end"
                            gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                            height="100px"
                        ></v-img>
                        <v-progress-linear
                            v-model="skill"
                            color="blue-grey"
                            height="20"
                            reactive
                        >
                            <template v-slot="{ value }"
                                >{{ Math.ceil(value) }}%</template
                            >
                        </v-progress-linear>
                        <v-divider class="mx-4"></v-divider>
                        <v-list>
                            <v-list-item v-if="item.app_no">
                                <v-list-item-content>
                                    <v-list-item-subtitle
                                        v-text="item.app_no"
                                    ></v-list-item-subtitle>
                                </v-list-item-content>
                                <v-list-item-action>
                                    <v-icon>mdi-alpha-a-circle-outline</v-icon>
                                </v-list-item-action>
                            </v-list-item>

                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-subtitle
                                        v-text="item.date_of_birth"
                                    ></v-list-item-subtitle>
                                </v-list-item-content>
                                <v-list-item-action>
                                    <v-icon>mdi-calendar-month-outline</v-icon>
                                </v-list-item-action>
                            </v-list-item>

                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-subtitle
                                        v-text="item.mobile_no"
                                    ></v-list-item-subtitle>
                                </v-list-item-content>
                                <v-list-item-action>
                                    <v-icon>mdi-cellphone-iphone</v-icon>
                                </v-list-item-action>
                            </v-list-item>

                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-subtitle
                                        v-text="item.email"
                                    ></v-list-item-subtitle>
                                </v-list-item-content>
                                <v-list-item-action>
                                    <v-icon>mdi-email</v-icon>
                                </v-list-item-action>
                            </v-list-item>
                        </v-list>

                        <v-card-actions>
                            <v-spacer></v-spacer>

                            <v-chip-group
                                v-model="selection"
                                active-class="deep-purple accent-4 white--text"
                                column
                            >
                                <v-chip>16-03-2020</v-chip>

                                <v-chip>19:30PM</v-chip>
                            </v-chip-group>
                            <v-btn
                                icon
                                :key="item.identifier"
                                @click="toggle(item.identifier)"
                            >
                                <v-icon :key="item.identifier">
                                    {{
                                        isActive === item.identifier
                                            ? "mdi-chevron-up"
                                            : "mdi-chevron-down"
                                    }}
                                </v-icon>
                            </v-btn>
                        </v-card-actions>
                        <v-expand-transition>
                            <div
                                :key="item.identifier"
                                v-show="isActive === item.identifier"
                            >
                                <v-divider></v-divider>
                                <v-card>
                                    <v-form
                                        class="pa-2 pt-6"
                                        :key="item.identifier"
                                    >
                                        <v-textarea
                                            v-model="replyForm.message"
                                            rows="2"
                                            outlined
                                            label="Reply message"
                                            hide-details
                                        ></v-textarea>
                                        <v-file-input
                                            class="my-3"
                                            label="Attachment"
                                            v-model="replyForm.attachments"
                                            multiple
                                        ></v-file-input>

                                        <v-divider></v-divider>
                                        <v-card-actions>
                                            <v-btn
                                                color="orange"
                                                text
                                                @click.stop="
                                                    $set(
                                                        dialogIndex,
                                                        item.order_id,
                                                        true
                                                    )
                                                "
                                                >Activity</v-btn
                                            >
                                            <v-spacer></v-spacer>
                                            <v-btn
                                                :loading="isLoading"
                                                outlined
                                                color="green"
                                                @click="
                                                    onClickReply(item.order_id)
                                                "
                                                >Reply</v-btn
                                            >
                                        </v-card-actions>
                                    </v-form>
                                </v-card>
                                <v-dialog
                                    v-model="dialogIndex[item.order_id]"
                                    :key="item.order_id"
                                    max-width="400px"
                                >
                                    <v-widget
                                        class="v-widget-timeline"
                                        title="Activities"
                                        content-bg="white"
                                        :enableFooter="true"
                                    >
                                        <template slot="widget-header-action">
                                            <v-tooltip bottom>
                                                <template
                                                    v-slot:activator="{ on }"
                                                >
                                                    <v-icon
                                                        v-on="on"
                                                        @click.stop="
                                                            $set(
                                                                dialogIndex,
                                                                item.order_id,
                                                                false
                                                            )
                                                        "
                                                        >mdi-close</v-icon
                                                    >
                                                </template>
                                                <span>Close</span>
                                            </v-tooltip>
                                        </template>
                                        <div slot="widget-content">
                                            <v-timeline dense>
                                                <v-timeline-item
                                                    v-for="(event,
                                                    index) in item.events"
                                                    :key="index"
                                                    :color="
                                                        event.user_belong
                                                            ? 'green'
                                                            : 'deep-orange'
                                                    "
                                                    :icon="
                                                        event.user_belong
                                                            ? 'mdi-wechat'
                                                            : 'mdi-account'
                                                    "
                                                    right
                                                    small
                                                >
                                                    <v-chip
                                                        class="ma-3 white--text"
                                                        :color="
                                                            event.user_belong
                                                                ? '#c259e6'
                                                                : '#adb5bd'
                                                        "
                                                        label
                                                    >
                                                        {{
                                                            event.created_at
                                                                | myDate
                                                        }}
                                                    </v-chip>
                                                    <v-card class="elevation-2">
                                                        <v-card-subtitle
                                                            class="pa-0 pt-1 pr-2 float-right caption"
                                                        >
                                                            <!-- <span v-text=" time_ago( event.created_at ) "
                                                            ></span> -->

                                                            <cs-time-ago
                                                                :datetime="
                                                                    event.created_at
                                                                "
                                                            >
                                                                <template
                                                                    slot="prepend"
                                                                >
                                                                    <v-icon
                                                                        class="caption"
                                                                        >mdi-clock-outline</v-icon
                                                                    >
                                                                </template>
                                                            </cs-time-ago>
                                                        </v-card-subtitle>

                                                        <v-card-title
                                                            :class="
                                                                event.user_belong
                                                                    ? 'green--text pa-1 caption'
                                                                    : 'orange--text pa-1 caption'
                                                            "
                                                        >
                                                            {{
                                                                event.user_belong
                                                                    ? "Support Team"
                                                                    : "Your"
                                                            }}
                                                            Reply
                                                        </v-card-title>

                                                        <v-divider></v-divider>
                                                        <v-card-text
                                                            class="text--primary"
                                                            v-text="
                                                                event.message
                                                            "
                                                        ></v-card-text>

                                                        <v-divider></v-divider>
                                                        <v-card-actions
                                                            class="caption grey--text"
                                                        >
                                                            IP :
                                                            {{ event.visitor }}
                                                        </v-card-actions>
                                                    </v-card>
                                                </v-timeline-item>
                                            </v-timeline>
                                        </div>
                                        <template slot="widget-footer-action">
                                            <v-spacer></v-spacer>

                                            <v-tooltip top>
                                                <template
                                                    v-slot:activator="{ on }"
                                                >
                                                    <v-btn
                                                        class="ma-2 white--text"
                                                        color="red"
                                                        v-on="on"
                                                        @click.stop="
                                                            $set(
                                                                dialogIndex,
                                                                item.order_id,
                                                                false
                                                            )
                                                        "
                                                    >
                                                        Close
                                                        <v-icon dark right
                                                            >mdi-cancel</v-icon
                                                        >
                                                    </v-btn>
                                                </template>
                                                <span>Close</span>
                                            </v-tooltip>
                                        </template>
                                    </v-widget>
                                </v-dialog>
                            </div>
                        </v-expand-transition>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>

        <div class="text-center">
            <v-container>
                <v-row justify="center">
                    <v-col cols="8">
                        <v-container class="max-width">
                            <v-pagination
                                v-model="pagination.current_page"
                                :length="pagination.total_pages"
                                :total-visible="7"
                                circle
                                class="my-4"
                                @input="onPageChange"
                            ></v-pagination>
                        </v-container>
                    </v-col>
                </v-row>
            </v-container>
        </div>
        <v-overlay :value="cs.overlay">
            <v-progress-circular
                color="pink"
                indeterminate
                size="64"
            ></v-progress-circular>
        </v-overlay>
    </v-card>
</template>

<script>
import Vue from "vue";
import _ from "lodash";
import { mapState, mapGetters } from "vuex";
import { get, byMethod, errorResponse } from "@/lib/api";
import { objectToFormData } from "object-to-formdata";
import DialogForm from "./DialogForm.vue";
import UserData from "@/api/userdata.js";
import PaymentForm from "@/components/widgets/form/PaymentForm";
import VWidget from "@/components/widgets/VWidget";
export default {
    components: {
        DialogForm,
        PaymentForm,
        VWidget,
    },
    props: {
        initialize: {},
        url: {
            required: true,
        },
        btnAddon: {
            default: false,
        },
        enableBtnAction: {
            type: Boolean,
            default: false,
        },
        labeled: {
            default: "Label",
        },
    },

    data() {
        return {
            isProcessing: false,
            showDialogForm: false,
            showPaymentForm: false,
            dataPaymentForm: {},
            overlay: false,
            loading: false,
            dialogIndex: {},
            options: {
                url: this.url,
                page: 1,
                search: "",
            },
            selection: 1,
            skill: 20,
            search: "",
            comboSearch: "",
            comboLoading: false,
            isActive: false,
            items: [],
            hiddenProp: {},
            imageUrl: {
                background: baseUrl + "/img/mountain.jpg",
                avatar: baseUrl + "/img/avatar.svg",
            },

            agreement: false,
            dialog: false,
            isLoading: false,
            time: new Date(),
            ctime: false,
            replyForm: {
                message: "",
                attachments: [],
            },
            defaultForm: {
                message: "",
                attachments: [],
            },
        };
    },
    computed: {
        parms(nv) {
            return {
                query: this.comboSearch,
            };
        },
        ...mapState(["drivings", "pagination", "cs"]),
    },
    watch: {
        overlay(val) {
            val &&
                setTimeout(() => {
                    this.overlay = false;
                }, 3000);
        },
    },

    methods: {
        onClickReply(id) {
            this.isLoading = true;
            Vue.set(this.$data.replyForm, "order_id", id);
            if (!this.replyForm.message) {
                toastr["error"]("Type something for reply !", "Error");
                this.isLoading = false;
                return;
            }

            let formData = objectToFormData(this.replyForm);

            byMethod("post", "/driving/reply", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
                .then((resp) => {
                    if (resp.data) {
                        toastr["success"](
                            "Successfully reply message.",
                            "Success"
                        );
                        this.updateCart("update");
                    }
                })
                .catch((err) => {
                    errorResponse(err);
                })
                .finally(() => {
                    this.replyForm = Object.assign({}, this.defaultForm);
                    this.isLoading = false;
                });
        },

        onPageChange(newPage) {
            this.options.page = newPage;
            this.$store.dispatch("getDrivings", this.options);
        },
        updateCart(resp) {
            if (resp === "update") {
                this.$store.dispatch("getDrivings", this.options);
            } else {
                this.$store.getters.drivings;
            }
        },
        toggle(divStatus) {
            this.replyForm = Object.assign({}, this.defaultForm);

            if (this.isActive === divStatus) {
                this.isActive = false;
            } else {
                this.isActive = divStatus;
            }
        },
        editItem(item) {
            this.hiddenProp = item;
            this.showDialogForm = true;
        },
        onPayment(item) {
            this.dataPaymentForm = Object.assign({
                identifier: item.identifier,
                order_id: item.order_id,
                service_code: item.service_code,
                amount: item.amount,
                name: item.name,
            });
            this.showPaymentForm = true;
        },
        searchit: _.debounce(() => {
            Fire.$emit("searching");
        }, 1000),
    },
    mounted() {
        this.$store.dispatch("getDrivings", this.options);
    },
    created() {
        Fire.$on("AfterEvents", () => {
            this.getDataFromApi().then((data) => {
                this.items = data.items;
            });
        });

        Fire.$on("searching", () => {
            this.$store.dispatch("getDrivings", this.options);
        });
    },
};
</script>

<style lang="sass">
.v-widget-timeline
    .v-timeline
        &.v-timeline--dense
            &:not(.v-timeline--reverse)::before
                left: calc(20px - 1px)
                right: initial
        .v-timeline-item
            .v-timeline-item__body
                max-width: calc(100% - 40px)
            .v-timeline-item__divider
                min-width: 45px
</style>
