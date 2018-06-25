<template>
	<div class="news reel">
		<h1 class="ui header">
			<div class="content">
				Aktualności
				<div class="sub header">
					Najnowsze informacje dotyczące studiów
				</div>
			</div>
		</h1>

		<div class="ui content divider"></div>

		<div class="entries">
			<div v-if="!fetching">
				<div v-if="news.length"  class="ui feed">
					<div class="ui event" v-for="(entry, index) in news">
						<router-link :to="{ name: 'news.entry', params: { id: entry.id } }" class="label">
							<i class="primary newspaper icon"></i>
						</router-link>
						<div class="ui segments" v-bind:class="{ piled: index === 0 }">
						<div class="ui entry title secondary segment">
								<span class="ui medium header">{{ entry.title }}</span>
								<span class="entry timestamp" data-inverted="" :data-tooltip="entry.timestamp" data-position="top center">
									dodano <time v-bind:datetime="entry.timestamp" v-bind:title="entry.timestamp">{{ entry.publication }}</time>
								</span>
							</div>
							<div class="ui segment" v-html="entry.content">
							</div>
						</div>
					</div>
					<div class="ui event">
						<span class="label">
							<i class="primary star icon"></i>
						</span>
						<div class="content"></div>
					</div>
				</div>
				<div v-else>
					Nie dodano żadnych newsów.
				</div>
			</div>
			<content-loader v-else></content-loader>
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
	.news.reel {
		.entry.timestamp {
			padding-left: 10px;
		}

		.event {
			padding: 0;
		}

		.label {
			padding-top: 1.5em;
		}

		.segments {
			margin-bottom: 2em !important;
		}

		.piled {
			margin: 1em 0;
		}
	}

	// timeline Semantic UI theme
	.ui.feed > .event .label {
		border-left: 3px solid #DDDDDD;
	}

	.ui.feed > .event > .label {
		margin-left: 1.6em;
	}

	.ui.feed > .event > .label > img,
	.ui.feed > .event > .label > .icon {
		background-color: #009FDA;
		border-radius: 500rem;
		color: #FFFFFF;
		width: 3rem;
		height: 3rem;
		line-height: 1.5;
		left: -1.6rem;
		opacity: 1;
		position: relative;
	}
</style>
