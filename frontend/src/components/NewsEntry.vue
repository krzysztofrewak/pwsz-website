<template>
	<div v-if="entry">
		<div class="ui piled segments">
			<div class="ui entry title secondary segment">
				<span class="ui medium header">{{ entry.title }}</span>
				<span class="entry timestamp">dodano {{ entry.timestamp }}</span>
			</div>
			<div class="ui segment" v-html="entry.content">
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				entry: null,
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				var self = this

				self.$http.get(this.apiUrl + "news/" + self.$route.params.id).then(function(response) {
					if(response.body.success) {
						self.entry = response.body.data
					} else {
						self.$router.replace({ name: "not-found" })
					}
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
