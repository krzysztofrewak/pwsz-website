<template>
	<div class="courses table">
		<h1 class="ui header">
			<i class="tile bordered inverted list alternate icon"></i>
			<div class="content">
				Lista kursów
				<div class="sub header">
					Szczegółowe informacje dotyczące kursów
				</div>
			</div>
		</h1>

		<p class="description">Poniżej znajduje się tabela z prowadzonymi przeze mnie kursami. Każdy kurs jest dostępny z poziomu własnej podstrony ze szczegółowymi informacjami, zasadami zaliczenia, wykazem tematów i istotnymi plikami. Wyszarzone kursy to te, które nie są prowadzone w obecnym semestrze.</p>
		
		<table class="ui very basic very compact table" v-if="!fetching">
			<thead>
				<tr>
					<th>kod</th>
					<th>pełna nazwa kursu</th>
					<th>specjalność</th>
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
					<td>{{ course.mode }}</td>
					<td>
						<router-link :to="{ name: 'course.page', params: { id: course.id } }" class="ui primary circular tiny icon button" data-inverted="" data-tooltip="zobacz materiały" data-position="right center">
							<i class="chevron right icon"></i>
						</router-link>
					</td>
				</tr>
			</tbody>
		</table>
		<content-loader v-else></content-loader>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				courses: [],
				fetching: true,
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("courses").then(response => {
					this.courses = response.data.data
					this.fetching = false
				})
			}
		},
	}
</script>

<style lang="scss" scoped>
	.description {
		padding: 3em 1em;
	}
</style>