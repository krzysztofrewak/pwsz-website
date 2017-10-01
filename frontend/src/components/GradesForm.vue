<template>
	<div>
		<h1>Sprawdź swoje oceny</h1>

		<table class="ui very basic celled table">
			<tbody>
				<tr>
					<td class="collapsing single line">
						Wybierz semestr z opcji po prawej:
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
							v-on:click="fetchGroups(course.id)"
							v-bind:class="{ primary: course.id == formData.courseId }">{{ course.label }}</span>
					</td>
				</tr>
				<tr v-if="step > 1">
					<td class="collapsing single line">
						Wybierz grupę:
					</td>
					<td>
						<span class="ui tiny button"
							v-for="group in groups"
							v-on:click="chooseGroup(group.id)"
							v-bind:class="{ primary: group.id == formData.groupId }">{{ group.label }}</span>
					</td>
				</tr>
				<tr v-if="step > 2">
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

		<div class="ui negative icon message" v-if="step > 3">
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

		<div v-if="step > 4">
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
					courseId: null,
					groupId: null,
					semesterId: null,
					studentId: null,
				},
				grades: {
					grades: [],
					students: [],
				},
				groups: [],
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

				this.$http.post(self.apiUrl + "grades/semesters").then(function(response) {
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

				this.formData.semesterId = semesterId
				this.$http.post(self.apiUrl + "grades/courses", self.formData).then(function(response) {
					if(response.status) {
						self.courses = response.body.data
						self.step = 1
					}
				})
			},
			fetchGroups(courseId) {
				var self = this

				this.step = 1
				this.formData.groupId = null
				this.groups = []

				this.formData.courseId = courseId
				this.$http.post(self.apiUrl + "grades/groups", self.formData).then(function(response) {
					if(response.status) {
						self.groups = response.body.data
						self.step = 2
					}
				})
			},
			chooseGroup(groupId) {
				this.step = 3
				this.formData.groupId = groupId
				this.formData.studentId = null
			},
			fetchGrades() {
				var self = this

				this.$http.post(self.apiUrl + "grades", self.formData).then(function(response) {
					if(response.status) {
						self.grades = response.body.data
						self.step = 4
					}
				})
			},
		},
	} 
</script>

<style lang="scss">
	.semester.button {
		margin: 0.25em;
	}
</style>
