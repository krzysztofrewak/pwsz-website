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
			})
		},
		checkAuthorization() {
			// console.log(this.$route.matched[0])
			// let route = this.$route.matched[0]

			// if(route.meta.requiresAuth) {
			// 	if(!this.authenticated) {
			// 		this.$router.push({ name: "not-allowed" })
			// 	}
			// }

			// if(route.meta.requiresGuest) {
			// 	if(this.authenticated) {
			// 		this.$router.push({ name: "not-allowed" })
			// 	}
			// }
		}
	},
	watch: {
		"$route"(from, to) {
			this.checkAuthorization()
		}
	}
}
