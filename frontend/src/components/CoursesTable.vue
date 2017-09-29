<template>
	<div v-if="fetched" class="courses table">
		<h1>Lista prowadzonych przeze mnie kursów</h1>
		<table class="ui very basic very compact table">
			<thead>
				<tr>
					<th>kod</th>
					<th>nazwa</th>
					<th>kier./spec.</th>
					<th>nr semestru</th>
					<th>semestr</th>
					<th>forma</th>
					<th>materiały</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="course in courses" v-bind:class="{ inactive: !course.active }">
					<td>{{ course.index }}</td>
					<td>{{ course.name }}</td>
					<td>{{ course.field }}</td>
					<td>{{ course.semester_no }}</td>
					<td>{{ course.semester_name }}</td>
					<td>{{ course.form }}</td>
					<td>
						<router-link :to="{ name: 'course.page', params: { id: course.id } }" class="ui tiny icon labeled button">
							przejdź
							<i class="copy icon"></i>
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
				var self = this

				self.$http.get(this.apiUrl + "courses").then(function(response) {
					self.courses = response.body.data
					self.toggleFetchedStatus()

				})
			},
			toggleFetchedStatus() {
				this.fetched = !this.fetched
			}
		},
	}
</script>
