<template>
	<div>
		<h1>Sprawdź swoje oceny</h1>

		<table class="ui very basic celled table">
			<tbody>
				<tr>
					<td class="collapsing single line">
						Wybierz semestr:
					</td>
					<td>
						<span class="ui tiny semester button"
							v-for="semester in semesters"
							v-on:click="fetchCourses(semester.id)"
							v-bind:class="{ primary: semester.id == formData.semesterId }">{{ semester.label }}</span>
					</td>
				</tr>
				<tr v-if="step > 0">
					<td class="collapsing single line">
						Wybierz kurs:
					</td>
					<td>
						<span class="ui tiny button"
							v-for="course in courses"
							v-on:click="chooseCourse(course.id)"
							v-bind:class="{ primary: course.id == formData.courseId }">{{ course.label }}</span>
					</td>
				</tr>
				<tr v-if="step > 1">
					<td class="collapsing single line">
						Podaj swój numer indeksu:
					</td>
					<td>
						<input class="ui tiny button" v-model="formData.studentId" v-on:keyup.enter="fetchGrades">
						<button class="ui tiny icon labeled primary button" v-on:click="fetchGrades">
							<i class="chevron right icon"></i>
							zobacz
						</button>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="ui positive icon message" v-if="step > 2">
			<i class="warning circle icon"></i>
			<div class="content">
				<div class="header">
					Niestety nic nie znaleziono.
				</div>
				<p>
					Dla podanej kombinacji identyfikatorów semestru, kursu i numeru indeksu nie odnaleziono żadnych danych. Sprawdź poprawność podanych informacji. Jeżeli semestr dopiero się rozpoczął, może po prostu jeszcze niczego tu nie ma.
				</p>
			</div>
		</div>

		<div v-if="step > 3">
<!-- 			<table class="ui very basic very compact table">
				<thead>
					<tr>
						<th>indeks</th>
						<th>inicjały</th>
						<th v-for="grade in grades.grades">{{ grade }}</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="student in grades.students">
						<td>{{ student.id }}</td>
						<td>{{ student.initials }}</td>
						<td v-for="grade in grades.grades"></td>
					</tr>
				</tbody>
			</table> -->
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				formData: {
					semesterId: null,
					courseId: null,
					studentId: null,
				},
				grades: {
					grades: [],
					students: [],
				},
				semesters: [],
				courses: [],
				step: 0,
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				var self = this

				self.$http.get(self.apiUrl + "grades/semesters").then(function(response) {
					if(response.status) {
						self.semesters = response.body.data
					}
				})
			},
			fetchCourses(semesterId) {
				var self = this

				this.step = 0
				this.formData.courseId = null
				this.courses = []

				self.$http.get(self.apiUrl + "grades/semesters/" + semesterId).then(function(response) {
					if(response.status) {
						self.step = 1
						self.formData.semesterId = semesterId
						self.courses = response.body.data
					}
				})
			},
			fetchGrades() {
				var self = this

				self.$http.post(self.apiUrl + "grades", self.formData).then(function(response) {
					if(response.status) {
						self.step = 3
						self.grades = response.body.data
					}
				})
			},
			chooseCourse(courseId) {
				this.step = 2
				this.formData.courseId = courseId
			}
		},
	} 
</script>

<style lang="scss">
	.semester.button {
		margin: 0.25em;
	}
</style>
