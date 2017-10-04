<template>
	<div class="course page" v-if="course">
		<h1>{{ course.name }}</h1>

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

		<div v-if="course.rules">
			<h2>Zasady zaliczenia</h2>
			<blockquote v-html="course.rules"></blockquote>
		</div>

		<div v-if="course.topics.length">
			<h2>Wykaz tematów</h2>
			<table class="ui very basic celled table">
				<thead>
					<tr>
						<th>#</th>
						<th>temat zajęć</th>
						<th>język progr.</th>
						<th>pliki</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="topic in course.topics">
						<td class="collapsing">{{ topic.no }}</td>
						<td>{{ topic.title }}</td>
						<td>{{ topic.language }}</td>
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
				var self = this

				self.$http.get(this.apiUrl + "courses/" + self.$route.params.id).then(function(response) {
					self.course = response.body.data
				})
			},
		},
	}
</script>

<style lang="scss">
	.course.page {
		h2 {
			margin-top: 2em;
		}

		.course.informations {
			margin-top: 3em !important;
		}
	}
</style>
