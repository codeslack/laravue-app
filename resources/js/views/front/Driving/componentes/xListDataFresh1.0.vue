<template>
    <v-data-table
        :headers="headers"
        :items="desserts"
        :hide-default-footer="true"
        class="elevation-1 my-awesome-table"
        height="250px"
    >
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-text-field
                    flat
                    solo
                    prepend-icon="mdi-magnify"
                    placeholder="Type something"
                    hide-details
                    class="dhidden-sm-and-down"
                ></v-text-field>
                <div class="flex-grow-1"></div>
                <template v-if="btnAddon">
                    <v-chip
                        outlined
                        color="teal"
                        @click.stop="showDialogForm = true"
                    >
                        New
                        <v-icon right color="teal"
                            >mdi-plus-circle-outline</v-icon
                        >
                    </v-chip>
                    <dialog-form
                        v-model="showDialogForm"
                        :labeled="labeled"
                        :url="url"
                        :hiddenProp="hiddenProp"
                    />
                </template>
            </v-toolbar>
            <v-divider></v-divider>
        </template>

        <template v-slot:item.action="{ item }">
            <v-icon small @click="deleteItem(item)">delete</v-icon>
        </template>
    </v-data-table>
</template>

<script>
import UserData from "./../../../../api/userdata.js";
import DialogForm from "./DialogForm.vue";
export default {
    components: {
        DialogForm
    },
    props: {
        initialize: {},
        url: {
            required: true
        },
        btnAddon: {
            default: false
        },
        labeled: {
            default: "Label"
        },
        hiddenProp: Object
    },
    data() {
        return {
            showDialogForm: false,
            desserts: UserData,
            headers: [
                {
                    text: "Actions",
                    value: "action",
                    sortable: false,
                    align: "center",
                    width: "100px"
                },
                {
                    text: "Bill No",
                    value: "bill_no",
                    sortable: false,
                    width: "150px"
                },
                {
                    text: "Bill Date",
                    value: "bill_date",
                    sortable: false,
                    width: "120px"
                },
                {
                    text: "Cost Price",
                    value: "cost_price",
                    sortable: false,
                    width: "100px"
                },
                {
                    text: "Quantity",
                    value: "quantity",
                    sortable: false,
                    width: "80px"
                },
                {
                    text: "Serial",
                    value: "serial",
                    sortable: false,
                    width: "200px"
                },
                {
                    text: "Party",
                    value: "party",
                    sortable: false,
                    width: "200px"
                }
            ]
        };
    },
    methods: {
        deleteItem(item) {
            const index = this.desserts.indexOf(item);
            this.desserts.splice(index, 1) &&
                toastr["info"]("Remove item", "Info");
        }
    }
};
</script>
