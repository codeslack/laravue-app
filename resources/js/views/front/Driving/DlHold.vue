<template>
	<div class="list-table">
		<v-container grid-list-xl fluid>
			<v-layout row wrap>
				<v-flex lg6>
					<h1>Time # 1</h1>
					<p>{{currentTime}}</p>

					<v-btn @click="addItem">addItem</v-btn>
					<v-btn @click="TimeOne">1st Time</v-btn>

					<ul id="example-1">
						<li v-for="(item, index) in items" :key="index">{{ item.prons }}</li>
					</ul>
				</v-flex>
				<v-flex lg6>
					<h1>Time # 2</h1>

					<v-btn @click="addNow">addNow</v-btn>
					<v-btn @click="TimeTwo">2nd Time</v-btn>
					<ul id="example-2">
						<li v-for="(item, index) in spans" :key="index">{{ item.trons }}</li>
					</ul>
				</v-flex>
			</v-layout>
		</v-container>
	</div>
</template>

<script>
export default {
	data: () => ({
		lastAccessAt: new Date(),
		expiresAt: null,
		jsonTime: null,
		timeNow: null,
		items: [{ prons: "" }],
		spans: [{ trons: "" }],
		currentTime: null
	}),
	methods: {
		addNow() {
			var d2 = new Date();
			this.currentTime = d2.getTime();
		},
		addItem() {
			var d2 = new Date(this.lastAccessAt);
			d2.setMinutes(this.lastAccessAt.getMinutes() + 2);

			this.expiresAt = d2.getTime();

			console.log("lastAcc", this.lastAccessAt.getTime());
			console.log("expiresAt", this.expiresAt);
		},
		TimeOne() {
			console.log("TimeOne -> expiresAt", this.expiresAt);
			let d2 = new Date();

			if (this.expiresAt > d2.getTime()) {
				this.items.push({ prons: "new prons" });
				this.items.push({ prons: this.lastAccessAt.getTime() });
				this.items.push({ prons: this.expiresAt });
				this.items.push({ prons: d2.getTime() });
				console.log("true");
			} else {
				this.spans.push({ trons: "new trons" });
				this.spans.push({ trons: this.lastAccessAt.getTime() });
				this.spans.push({ trons: this.expiresAt });
				this.spans.push({ trons: d2.getTime() });
				console.log("false");
			}

			var radio = {
				lastAccessAt: this.lastAccessAt.getTime(),
				expiresAt: d2.getTime()
			};

			localStorage.setItem("testing", JSON.stringify(radio));
		},
		TimeTwo() {
			this.spans.push({ trons: "new trons" });
			this.spans.push({ trons: this.lastAccessAt.getTime() });
			this.spans.push({ trons: this.expiresAt });
		}
	}
};
</script>