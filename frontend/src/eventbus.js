import Vue from "vue"

const EventBus = new Vue({
	data() {
		return {
			isAuthenticated: false,
		}
	},
	created() {
		this.$on("authentication_status", function(isAuthenticated) {
			this.isAuthenticated = isAuthenticated
		})
	}
});

export default EventBus
