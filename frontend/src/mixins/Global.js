export default {
	data() {
		return {
			apiUrl: "/api/",
			baseUrl: process.env.NODE_ENV === "development" ? "http://pwsz.dev/" : "",
		}
	},
	methods: {
		redirect(sectionName, itemId) {
			this.$router.push({ name: sectionName, params: { id: itemId } })
		},
	}
}
