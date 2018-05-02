<template>
	<div class="course page" v-if="course">
		<h1>{{ course.name }}</h1>

		<div class="ui divider"></div>

		<div class="ui three course informations statistics">
			<div class="statistic">
				<div class="value">
					{{ course.field }}
				</div>
				<div class="label">
					kierunek
				</div>
			</div>
			<div class="statistic">
				<div class="value">
					{{ course.semester_no }}
				</div>
				<div class="label">
					semestr
				</div>
			</div>
			<div class="statistic">
				<div class="value">
					{{ course.form }}
				</div>
				<div class="label">
					forma zajęć
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
				this.$http.get("courses/" + this.$route.params.id).then(function(response) {
					this.course = response.body.data
				})
			},
		},
	}
</script>

<style lang="scss" scoped>
	.course.page {
		h2 {
			margin-top: 2em;
		}

		.course.informations {
			margin-top: 3em !important;
		}

		.divider {
			margin-top: 3em;
		}
	}
</style>
