<template>
	<div>
		<!-- Using hide-overlay below allows for clicking while progress showing -->
		<v-dialog
			v-model="dialog"
			hide-overlay
			persistent
			:width="options.width"
			v-bind:style="{ zIndex: options.zIndex }"
		>
			<v-card :color="options.color" dark>
				<v-card-text class="pt-3">
					{{ message }}
					<v-progress-linear indeterminate color="white" class="mr-2"></v-progress-linear>
				</v-card-text>
			</v-card>
		</v-dialog>
		<v-snackbar
			v-model="snackbarVisible"
			:left="snackbar.location === 'left'"
			:right="snackbar.location === 'right'"
			:top="snackbar.location === 'top'"
			:bottom="snackbar.location === 'bottom'"
			:color="snackbar.color"
			:multi-line="snackbar.mode === 'multi-line'"
			:timeout="snackbar.timeout"
			:vertical="snackbar.mode === 'vertical'"
		>
			{{ snackbar.message }}
			<v-btn dark text :color="snackbar.close.color" @click="hideSnackbar">{{ snackbar.close.text }}</v-btn>
		</v-snackbar>
	</div>
</template>

<script>
export default {
	data: () => ({
		dialog: false,
		message: null,
		options: {
			color: "primary",
			width: 290,
			zIndex: 200
		},
		snackbarVisible: false,
		snackbar: {
			enabled: false,
			color: "success",
			mode: "multi-line",
			timeout: 2000,
			message: "Success!",
			callback: null,
			location: "top",
			close: {
				text: "Close",
				color: ""
			}
		}
	}),
	methods: {
		/**
		 * Show loader without any callbacks or timeout (must be manually hidden)
		 * @param {string} message
		 * @param {object} options
		 */
		show(message, options) {
			this.dialog = true;
			this.message = message;
			this.options = Object.assign(this.options, options);
		},
		/**
		 * Hide loader (and show snackbar if enabled)
		 */
		hide() {
			this.dialog = false;
			if (this.snackbar.enabled) {
				this.showSnackbar();
			}
		},
		/**
		 * Start/Show Loader (and maybe Snackbar)
		 *
		 * @param {string} message
		 * @param {object} options
		 * @param {Promise.<function>} [callback]
		 * @param {boolean|object} [snackbar]
		 */
		start(message, options, callback, snackbar) {
			this.show(message, options);

			if (typeof snackbar === "object") {
				this.snackbar.enabled = true;
				this.snackbar = Object.assign(this.snackbar, snackbar);
			} else if (typeof snackbar !== "undefined") {
				this.snackbar.enabled = true;
			}

			if (typeof callback === "function") {
				callback()
					.then(this.hide)
					.catch(error => {
						this.snackbar.color = "error";
						this.snackbar.message = error;
						this.hide();
					});
			}
		},
		/**
		 * Stop/Hide loader and show snackbar with optional callback
		 *
		 * @param {string} message
		 * @param {object} snackbarOptions
		 * @param {function} callback
		 */
		stop(message, snackbarOptions, callback) {
			this.hide();

			this.snackbar.enabled = true;
			this.snackbar = Object.assign(this.snackbar, snackbarOptions);

			if (typeof callback === "function") {
				this.snackbar.callback = callback;
				// Use our own timeout to call callback
				setTimeout(this.hideSnackbar, this.snackbar.timeout);
				// Set to zero to allow our timeout above to handle hiding
				this.snackbar.timeout = 0;
			}
		},
		/**
		 * Hide Snackbar (and call callback if previously set)
		 */
		hideSnackbar() {
			this.snackbarVisible = false;
			if (this.snackbar.callback) {
				this.snackbar.callback();
			}
		},
		/**
		 * Show Snackbar
		 * @param {string} message
		 * @param {object} snackbarOptions
		 */
		showSnackbar(message, snackbarOptions) {
			if (message) {
				this.snackbar.message = message;
			}
			this.snackbar.enabled = true;

			if (typeof snackbar === "object") {
				this.snackbar = Object.assign(this.snackbar, snackbarOptions);
			}

			this.snackbarVisible = true;
		}
	}
};
</script>
