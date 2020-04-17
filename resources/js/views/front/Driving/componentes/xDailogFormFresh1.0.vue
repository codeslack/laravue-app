<template>
    <v-dialog v-model="show" persistent max-width="320px">
        <v-card>
            <v-card-title>
                <span class="title">New {{ labeled }}</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field label="Name"></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            class="ma-2"
                            color="red"
                            v-on="on"
                            :dark="!isProcessing"
                            :disabled="isProcessing"
                            @click.stop="show = false"
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
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        value: {
            default: Boolean
        },
        labeled: {
            default: "new Label"
        },
        url: {
            required: true
        },
        hiddenProp: Object
    },
    data() {
        return {
            isProcessing: false
        };
    },
    methods: {
        close() {
            setTimeout(() => {
                // this.isProcessing = true;
            }, 300);

            this.isProcessing = false;
        },

        onSave() {
            this.close();
        }
    },
    computed: {
        show: {
            get() {
                return this.value;
            },
            set(value) {
                this.$emit("input", value);
                Fire.$emit("closed");
            }
        }
    }
};
</script>
