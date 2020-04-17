<template>
	<v-navigation-drawer v-model="showDrawer" app src="/static/bg/13.jpg" dark>
		<v-toolbar color="primary darken-1" dark>
			<img :src="computeLogo" height="36" alt="Code-Slack" />
			<v-toolbar-title class="ml-0 pl-3">
				<span class="hidden-sm-and-down">Code Slack</span>
			</v-toolbar-title>
		</v-toolbar>
		<v-divider></v-divider>
		<v-list expand>
			<template v-for="item in menus">
				<!--group with subitems-->
				<v-list-group
					v-if="item.items"
					:key="item.title"
					:group="item.group"
					:prepend-icon="item.icon"
					no-action="no-action"
				>
					<v-list-item slot="activator" ripple="ripple">
						<v-list-item-content>
							<v-list-item-title>{{ item.title }}</v-list-item-title>
						</v-list-item-content>
					</v-list-item>
					<template v-for="subItem in item.items">
						<!--sub group-->
						<v-list-group
							v-if="subItem.items"
							:key="subItem.name"
							:group="subItem.group"
							sub-group="sub-group"
						>
							<v-list-item slot="activator" ripple="ripple">
								<v-list-item-content>
									<v-list-item-title>{{ subItem.title }}</v-list-item-title>
								</v-list-item-content>
							</v-list-item>
							<v-list-item
								v-for="grand in subItem.children"
								:key="grand.name"
								:to="genChildTarget(item, grand)"
								:href="grand.href"
								ripple="ripple"
							>
								<v-list-item-content>
									<v-list-item-title>{{ grand.title }}</v-list-item-title>
								</v-list-item-content>
							</v-list-item>
						</v-list-group>
						<!--child item-->
						<v-list-item
							v-else
							:key="subItem.name"
							:to="genChildTarget(item, subItem)"
							:href="subItem.href"
							:disabled="subItem.disabled"
							:target="subItem.target"
							ripple="ripple"
						>
							<v-list-item-content>
								<v-list-item-title>
									<span>{{ subItem.title }}</span>
								</v-list-item-title>
							</v-list-item-content>
							<v-list-item-action v-if="subItem.action">
								<v-icon :class="[subItem.actionClass || 'success--text']">{{ subItem.action }}</v-icon>
							</v-list-item-action>
						</v-list-item>
					</template>
				</v-list-group>
				<v-subheader v-else-if="item.header" :key="item.name">{{ item.header }}</v-subheader>
				<v-divider v-else-if="item.divider" :key="item.name"></v-divider>
				<!--top-level link-->
				<v-list-item
					v-else
					:to="!item.href ? item.name : null"
					:href="item.href"
					ripple="ripple"
					:disabled="item.disabled"
					:target="item.target"
					rel="noopener"
					:key="item.name"
				>
					<v-list-item-action v-if="item.icon">
						<v-icon v-if="item.color" :color="item.color">{{ item.icon }}</v-icon>
						<v-icon v-else>{{ item.icon }}</v-icon>
					</v-list-item-action>
					<v-list-item-content>
						<v-list-item-title>{{ item.title }}</v-list-item-title>
					</v-list-item-content>
					<v-list-item-action v-if="item.subAction">
						<v-icon class="success--text">{{ item.subAction }}</v-icon>
					</v-list-item-action>
				</v-list-item>
			</template>
		</v-list>
		<template v-slot:append>
			<div class="pa-2">
				<v-btn block>Logout</v-btn>
			</div>
		</template>
	</v-navigation-drawer>
</template>

<script>
import menu from "./../../../api/adminmenu";
// import VuePerfectScrollbar from "vue-perfect-scrollbar"
export default {
	name: "AppDrawer",
	components: {
		// VuePerfectScrollbar
	},
	props: {
		expanded: {
			type: Boolean,
			default: true
		},
		drawWidth: {
			type: [Number, String],
			default: "260"
		},
		showDrawer: Boolean
	},
	data() {
		return {
			drawer: null,
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
			return {
				name: `${item.group}/${subItem.name}`
			};
		}
	},
	mounted() {
		console.info("App this router:", this.$route.matched[0].path);
		console.info("App currentRoute:", this.$router.currentRoute);
	}
};
</script>