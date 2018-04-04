<template>
	<div v-if="entry">
		<div class="ui piled segments">
			<div class="ui entry title secondary segment">
				<span class="ui medium header">{{ entry.title }}</span>
				<span class="entry timestamp">
					dodano <time v-bind:datetime="entry.timestamp" v-bind:title="entry.timestamp">{{ entry.publication }}</time>
				</span>
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
				this.$http.get("news/" + this.$route.params.id).then(response => {
					this.entry = response.body.data
				}).catch(error => {
					this.$router.replace({ name: "not-found" })
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
