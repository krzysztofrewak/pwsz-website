import Vue from "vue"

const EventBus = new Vue({
	data() {
		return {
			isAuthenticated: false,
			notifications: [
				{ type: "negative", message: "Nie zalogowano poprawnie." },
				{ type: "negative", message: "Nie zalogowano poprawnie." },
			]
		}
	},
	created() {
		this.$on("authentication_status", function(isAuthenticated) {
			this.isAuthenticated = isAuthenticated
		})
	}
});

export default EventBus
