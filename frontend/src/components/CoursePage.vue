<template>
	<div v-if="course">
		<h1>Kurs {{ course.name }}</h1>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				course: null,
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				var self = this

				self.$http.get(this.apiUrl + "courses/" + self.$route.params.id).then(function(response) {
					self.course = response.body.data
				})
			},
		},
	}
</script>

<style lang="scss">
	.entry.timestamp {
		padding-left: 10px;
	}
</style>
