<template>
	<div class="courses table">
		<h1>Lista kursów</h1>

		<p class="description">Poniżej znajduje się tabela z prowadzonymi przeze mnie kursami. Każdy kurs jest dostępny z poziomu własnej podstrony ze szczegółowymi informacjami, zasadami zaliczenia, wykazem tematów i istotnymi plikami. Wyszarzone kursy to te, które nie są prowadzone w obecnym semestrze.</p>
		
		<table class="ui very basic very compact table" v-if="fetched">
			<thead>
				<tr>
					<th>kod</th>
					<th>nazwa</th>
					<th>kier./spec.</th>
					<th>semestr</th>
					<th>forma</th>
					<th>tryb</th>
					<th></th>
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
					<td>stacjonarny</td>
					<td>
						<router-link :to="{ name: 'course.page', params: { id: course.id } }" class="ui primary circular tiny icon button" data-inverted="" data-tooltip="zobacz materiały" data-position="right center">
							<i class="chevron right icon"></i>
						</router-link>
					</td>
				</tr>
			</tbody>
		</table>
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