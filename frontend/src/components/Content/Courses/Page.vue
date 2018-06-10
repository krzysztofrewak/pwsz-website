<template>
	<div class="course page" v-if="course">
		<h1 class="ui header">
			<i class="bordered inverted folder icon"></i>
			<div class="content">
				{{ course.name }}
				<div class="sub header">
					Strona informacyjna kursu {{ course.index }}
				</div>
			</div>
		</h1>

		<div class="ui divider"></div>

		<h2>Podstawowe informacje</h2>
		<div class="ui four course informations statistics">
			<div class="statistic" v-for="information in course.informations">
				<div class="label">
					{{ information.label }}
				</div>
				<div class="value">
					{{ information.value }}
				</div>
				<div class="label">
					{{ information.description }}
				</div>
			</div>
		</div>

		<div v-if="course.description">
			<div class="ui divider"></div>

			<h2>Opis kursu</h2>
			<blockquote v-html="course.description"></blockquote>
		</div>

		<div v-if="course.topics.length">
			<div class="ui divider"></div>

			<h2>
				Wykaz tematów
				<span data-inverted="" :data-tooltip="'ostatnia zmiana: ' + course.last_updated" data-position="right center">
					<i class="question circle outline icon"></i>
				</span>
			</h2>
			<table class="ui very basic celled table">
				<thead>
					<tr>
						<th>#</th>
						<th>temat zajęć</th>
						<th>pliki</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="topic in course.topics">
						<td class="collapsing">{{ topic.no }}</td>
						<td>{{ topic.title }}</td>
						<td>
							<a target="_blank" v-for="file in topic.files" v-bind:href="file.url">
								<i class="big file outline icon" v-bind:class="file.icon"></i>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<content-loader v-else></content-loader>
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
				this.$http.get("courses/" + this.$route.params.id).then(response => {
					this.course = response.data.data
				}).catch(error => {
					this.$router.push({ name: "not-retrieved" });
				})
			},
		},
	}
</script>

<style lang="scss" scoped>
	.course.page {
		h2 {
			margin-top: 1em;
		}

		.course.informations {
			margin-top: 3em !important;

			.statistic {
				width: 25%;
			}

			@media screen and (max-width: 720px) {
				.statistic {
					display: block !important;
					width: 100%;
				}
			}
		}

		.divider {
			margin-top: 3em;
		}
	}
</style>
