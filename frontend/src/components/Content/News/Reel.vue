<template>
	<div>
		<h1>Aktualności i informacje</h1>
		<div class="entries">
			<div v-if="!fetching">
				<div v-if="news.length">
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
							<router-link :to="{ name: 'news.entry', params: { id: entry.id } }" class="ui primary tiny circular icon right floated button" title="Przejdź do wiadomości" data-inverted="" data-tooltip="przejdź do wiadomości" data-position="right center">
								<i class="share alternate icon"></i>
							</router-link>
						</div>
					</div>
				</div>
				<div v-else>
					Nie dodano żadnych newsów.
				</div>
			</div>
			<div class="ui" v-else>
				<div class="ui active inverted dimmer">
					<div class="ui loader"></div>
				</div>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				fetching: true,
				news: [],
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("news").then(response => {
					this.news = response.data.data
					this.fetching = false
				})
			},
		},
	}
</script>

<style lang="scss" scoped>
	.entries {
		margin-top: 3em;
	}

	.entry.timestamp {
		padding-left: 10px;
	}
</style>
