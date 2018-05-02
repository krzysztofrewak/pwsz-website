<template>
	<div>
		<h1>Aktualności i informacje</h1>

		<div class="ui segments" v-for="(entry, index) in news" v-bind:class="{ piled: index === 0 }">
			<div class="ui entry title secondary segment">
				<span class="ui medium header">{{ entry.title }}</span>
				<span class="entry timestamp" data-inverted="" :data-tooltip="entry.timestamp" data-position="top center">
					dodano <time v-bind:datetime="entry.timestamp" v-bind:title="entry.timestamp">{{ entry.publication }}</time>
				</span>
			</div>
			<div class="ui segment" v-html="entry.content">
			</div>
			<div class="ui clearing secondary segment">
				<router-link :to="{ name: 'news.entry', params: { id: entry.id } }" class="ui tiny circular icon right floated button" title="Przejdź do wiadomości" data-inverted="" data-tooltip="przejdź do wiadomości" data-position="top right">
					<i class="share alternate icon"></i>
				</router-link>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				news: [],
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("news").then(function(response) {
					this.news = response.body.data
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
