import Vue from "vue"
import EventBus from "../eventbus.js"

Vue.prototype.$bus = EventBus

export default {
	computed: {
		authenticated: function() {
			return this.$parent.isAuthenticated;
		},
		notifications: function() {
			return this.$parent.systemNotifications;
		}
	},
	methods: {
		notifyError(message) {
			return this.notify("negative", message)
		},
		notifySuccess(message) {
			return this.notify("positive", message)
		},
		notify(type, message) {
			this.$bus.$emit("show-notification", {
				type: type,
				message: message,
				lifespan: 5,
			})
		},
	},
}
