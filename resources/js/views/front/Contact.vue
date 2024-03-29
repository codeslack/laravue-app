<template>
	<div class="list-table">
		<v-container grid-list-xl fluid>
			<v-layout row wrap>
				<v-flex sm12>
					<h3>Basic Table</h3>
				</v-flex>
				<v-flex lg12>
					<v-data-table :headers="basic.headers" :items="basic.items" hide-default class="elevation-1">
						<template slot="items" slot-scope="props">
							<td>{{ props.item.name }}</td>
							<td class="text-xs-right">{{ props.item.calories }}</td>
							<td class="text-xs-right">{{ props.item.fat }}</td>
							<td class="text-xs-right">{{ props.item.carbs }}</td>
							<td class="text-xs-right">{{ props.item.protein }}</td>
							<td class="text-xs-right">{{ props.item.iron }}</td>
						</template>
					</v-data-table>
				</v-flex>

				<v-flex sm12>
					<h3>Complex Table</h3>
				</v-flex>
				<v-flex lg12>
					<v-data-table
						:headers="complex.headers"
						:items="complex.items"
						:search="search"
						class="elevation-1"
						item-key="name"
						show-select
						v-model="complex.selected"
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
									class="hidden-sm-and-down"
								></v-text-field>
								<v-btn icon>
									<v-icon>mdi-filter-variant</v-icon>
								</v-btn>
							</v-toolbar>
							<v-divider></v-divider>
						</template>
						<template v-slot:item.avatar="{ item }">
							<v-avatar size="32">
								<img :src="item.avatar" alt />
							</v-avatar>
						</template>
						<template v-slot:item.action="{ item }">
							<v-btn class="mr-2" color="primary" fab dark small>
								<v-icon small>mdi-pencil-outline</v-icon>
							</v-btn>

							<v-btn color="pink" fab dark small>
								<v-icon small>mdi-trash-can-outline</v-icon>
							</v-btn>
						</template>
						<template v-slot:no-data>
							<v-btn color="primary" @click="initialize">Reset</v-btn>
						</template>
					</v-data-table>
				</v-flex>

				<v-flex sm12>
					<h3>Complex Table with Modal</h3>
				</v-flex>

				<v-flex lg12>
					<v-data-table :headers="headers" :items="desserts" sort-by="calories" class="elevation-1">
						<template v-slot:top>
							<v-toolbar flat color="white">
								<v-toolbar-title>My CRUD</v-toolbar-title>
								<v-divider class="mx-4" inset vertical></v-divider>
								<div class="flex-grow-1"></div>
								<v-dialog v-model="dialog" max-width="500px">
									<template v-slot:activator="{ on }">
										<v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
									</template>
									<v-card>
										<v-card-title>
											<span class="headline">{{ formTitle }}</span>
										</v-card-title>

										<v-card-text>
											<v-container>
												<v-row>
													<v-col cols="12" sm="6" md="4">
														<v-text-field v-model="editedItem.name" label="Dessert name"></v-text-field>
													</v-col>
													<v-col cols="12" sm="6" md="4">
														<v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
													</v-col>
													<v-col cols="12" sm="6" md="4">
														<v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
													</v-col>
													<v-col cols="12" sm="6" md="4">
														<v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
													</v-col>
													<v-col cols="12" sm="6" md="4">
														<v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
													</v-col>
												</v-row>
											</v-container>
										</v-card-text>

										<v-card-actions>
											<div class="flex-grow-1"></div>
											<v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
											<v-btn color="blue darken-1" text @click="save">Save</v-btn>
										</v-card-actions>
									</v-card>
								</v-dialog>
							</v-toolbar>
						</template>
						<template v-slot:item.action="{ item }">
							<v-icon small class="mr-2" @click="editItem(item)">mdi-pencil-outline</v-icon>
							<v-icon small @click="deleteItem(item)">mdi-trash-can-outline</v-icon>
						</template>
						<template v-slot:no-data>
							<v-btn color="primary" @click="initialize">Reset</v-btn>
						</template>
					</v-data-table>
				</v-flex>
			</v-layout>
		</v-container>
	</div>
</template>
<script>
import { Items as Users } from "./../../api/user";
export default {
	data: () => ({
		dialog: false,
		search: "",
		complex: {
			selected: [],
			headers: [
				{
					text: "Avatar",
					value: "avatar"
				},
				{
					text: "Name",
					value: "name"
				},
				{
					text: "Email",
					value: "email"
				},
				{
					text: "Phone",
					value: "phone"
				},
				{ text: "Actions", value: "action", sortable: false }
			],
			items: Users
		},
		basic: {
			headers: [
				{
					text: "Dessert (100g serving)",
					align: "left",
					sortable: false,
					value: "name"
				},
				{ text: "Calories", value: "calories" },
				{ text: "Fat (g)", value: "fat" },
				{ text: "Carbs (g)", value: "carbs" },
				{ text: "Protein (g)", value: "protein" },
				{ text: "Iron (%)", value: "iron" }
			],
			items: [
				{
					value: false,
					name: "Frozen Yogurt",
					calories: 159,
					fat: 6.0,
					carbs: 24,
					protein: 4.0,
					iron: "1%"
				},
				{
					value: false,
					name: "Ice cream sandwich",
					calories: 237,
					fat: 9.0,
					carbs: 37,
					protein: 4.3,
					iron: "1%"
				},
				{
					value: false,
					name: "Eclair",
					calories: 262,
					fat: 16.0,
					carbs: 23,
					protein: 6.0,
					iron: "7%"
				},
				{
					value: false,
					name: "Cupcake",
					calories: 305,
					fat: 3.7,
					carbs: 67,
					protein: 4.3,
					iron: "8%"
				},
				{
					value: false,
					name: "Gingerbread",
					calories: 356,
					fat: 16.0,
					carbs: 49,
					protein: 3.9,
					iron: "16%"
				},
				{
					value: false,
					name: "Jelly bean",
					calories: 375,
					fat: 0.0,
					carbs: 94,
					protein: 0.0,
					iron: "0%"
				},
				{
					value: false,
					name: "Lollipop",
					calories: 392,
					fat: 0.2,
					carbs: 98,
					protein: 0,
					iron: "2%"
				},
				{
					value: false,
					name: "Honeycomb",
					calories: 408,
					fat: 3.2,
					carbs: 87,
					protein: 6.5,
					iron: "45%"
				},
				{
					value: false,
					name: "Donut",
					calories: 452,
					fat: 25.0,
					carbs: 51,
					protein: 4.9,
					iron: "22%"
				},
				{
					value: false,
					name: "KitKat",
					calories: 518,
					fat: 26.0,
					carbs: 65,
					protein: 7,
					iron: "6%"
				}
			]
		},
		headers: [
			{
				text: "Dessert (100g serving)",
				align: "left",
				sortable: false,
				value: "name"
			},
			{ text: "Calories", value: "calories" },
			{ text: "Fat (g)", value: "fat" },
			{ text: "Carbs (g)", value: "carbs" },
			{ text: "Protein (g)", value: "protein" },
			{ text: "Actions", value: "action", sortable: false }
		],
		desserts: [],
		editedIndex: -1,
		editedItem: {
			name: "",
			calories: 0,
			fat: 0,
			carbs: 0,
			protein: 0
		},
		defaultItem: {
			name: "",
			calories: 0,
			fat: 0,
			carbs: 0,
			protein: 0
		}
	}),

	computed: {
		formTitle() {
			return this.editedIndex === -1 ? "New Item" : "Edit Item";
		}
	},

	watch: {
		dialog(val) {
			val || this.close();
		}
	},

	created() {
		this.initialize();
	},

	methods: {
		initialize() {
			this.desserts = [
				{
					name: "Frozen Yogurt",
					calories: 159,
					fat: 6.0,
					carbs: 24,
					protein: 4.0
				},
				{
					name: "Ice cream sandwich",
					calories: 237,
					fat: 9.0,
					carbs: 37,
					protein: 4.3
				},
				{
					name: "Eclair",
					calories: 262,
					fat: 16.0,
					carbs: 23,
					protein: 6.0
				},
				{
					name: "Cupcake",
					calories: 305,
					fat: 3.7,
					carbs: 67,
					protein: 4.3
				},
				{
					name: "Gingerbread",
					calories: 356,
					fat: 16.0,
					carbs: 49,
					protein: 3.9
				},
				{
					name: "Jelly bean",
					calories: 375,
					fat: 0.0,
					carbs: 94,
					protein: 0.0
				},
				{
					name: "Lollipop",
					calories: 392,
					fat: 0.2,
					carbs: 98,
					protein: 0
				},
				{
					name: "Honeycomb",
					calories: 408,
					fat: 3.2,
					carbs: 87,
					protein: 6.5
				},
				{
					name: "Donut",
					calories: 452,
					fat: 25.0,
					carbs: 51,
					protein: 4.9
				},
				{
					name: "KitKat",
					calories: 518,
					fat: 26.0,
					carbs: 65,
					protein: 7
				}
			];
		},

		editItem(item) {
			console.log(item);
			this.editedIndex = this.desserts.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.dialog = true;
		},

		deleteItem(item) {
			const index = this.desserts.indexOf(item);
			confirm("Are you sure you want to delete this item?") &&
				this.desserts.splice(index, 1);
			console.log(item);
		},

		close() {
			this.dialog = false;
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = -1;
			}, 300);
		},

		save() {
			if (this.editedIndex > -1) {
				Object.assign(this.desserts[this.editedIndex], this.editedItem);
			} else {
				this.desserts.push(this.editedItem);
			}
			this.close();
		}
	}
};
</script>