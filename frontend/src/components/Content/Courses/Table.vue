<template>
	<div class="courses table">
		<h1 class="ui header">
			<div class="content">
				Lista kursów
				<div class="sub header">
					Szczegółowe informacje dotyczące kursów
				</div>
			</div>
		</h1>

		<div class="ui divider"></div>

		<p class="description">Poniżej znajduje się tabela z prowadzonymi przeze mnie kursami. Każdy kurs jest dostępny z poziomu własnej podstrony ze szczegółowymi informacjami, zasadami zaliczenia, wykazem tematów i istotnymi plikami. Wyszarzone kursy to te, które nie są prowadzone w obecnym semestrze.</p>

		<div class="ui divider"></div>
		
		<table class="ui very basic very compact unstackable table" v-if="!fetching">
			<thead>
				<tr>
					<th class="only wide screen">kod</th>
					<th>pełna nazwa kursu</th>
					<th class="only wide screen">specjalność</th>
					<th class="only wide screen">semestr</th>
					<th>forma</th>
					<th>tryb</th>
					<th class="only wide screen"></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="course in courses" v-bind:class="{ inactive: !course.active }">
					<td class="only wide screen">
						<router-link :to="{ name: 'course.page', params: { id: course.id } }">
						{{ course.index }}
						</router-link>
					</td>
					<td>
						<router-link :to="{ name: 'course.page', params: { id: course.id } }">
						{{ course.name }}
						</router-link>
					</td>
					<td class="only wide screen">{{ course.field }}</td>
					<td class="only wide screen">{{ course.semester_no }}</td>
					<td>{{ course.form }}</td>
					<td>{{ course.mode }}</td>
					<td class="only wide screen">
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
	.divider {
		margin: 3em 0;
	}
</style>