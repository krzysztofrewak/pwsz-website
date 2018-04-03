<template>
	<div v-if="fetched" class="courses table">
		<h1>Lista kursów</h1>

		<p class="description">Poniżej znajduje się tabela z prowadzonymi przeze mnie kursami. Każdy kurs jest dostępny z poziomu własnej podstrony ze szczegółowymi informacjami, zasadami zaliczenia, wykazem tematów i istotnymi plikami. Wyszarzone kursy to te, które nie są prowadzone w obecnym semestrze.</p>
		
		<table class="ui very basic very compact table">
			<thead>
				<tr>
					<th>kod</th>
					<th>nazwa</th>
					<th>kier./spec.</th>
					<th>semestr</th>
					<th>forma</th>
					<th>materiały</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="course in courses" v-bind:class="{ inactive: !course.active }">
					<td>
						<router-link :to="{ name: 'course.page', params: { id: course.id } }">
						{{ course.index }}
						</router-link>
					</td>
					<td>
						<router-link :to="{ name: 'course.page', params: { id: course.id } }">
						{{ course.name }}
						</router-link>
					</td>
					<td>{{ course.field }}</td>
					<td>{{ course.semester_no }}</td>
					<td>{{ course.form }}</td>
					<td>
						<router-link :to="{ name: 'course.page', params: { id: course.id } }" class="ui tiny icon labeled button">
							przejdź
							<i class="chevron right icon"></i>
						</router-link>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="ui" v-else>
		<div class="ui active inverted dimmer">
			<div class="ui text loader">Ładowanie...</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				courses: [],
				fetched: false,
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("courses").then(function(response) {
					this.courses = response.body.data
					this.toggleFetchedStatus()
				})
			},
			toggleFetchedStatus() {
				this.fetched = !this.fetched
			}
		},
	}
</script>

<style lang="scss" scoped>
	.description {
		margin: 3em;
	}
</style>