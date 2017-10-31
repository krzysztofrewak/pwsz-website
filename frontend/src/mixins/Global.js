import EventBus from "../eventbus.js"

export default {
	data() {
		return {
			apiUrl: "/api/",
			baseUrl: process.env.NODE_ENV === "development" ? "http://pwsz.dev/" : ""
		}
	},
	computed: {
		authenticated: function() {
			return this.$parent.isAuthenticated;
		}
	},
	methods: {
		redirect(sectionName, itemId) {
			this.$router.push({ name: sectionName, params: { id: itemId } })
		},
	},
}
