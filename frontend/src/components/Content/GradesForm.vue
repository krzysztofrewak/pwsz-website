<template>
	<div>
		<h1>Sprawdź swoje oceny</h1>

		<table class="ui very basic celled table">
			<tbody>
				<tr>
					<td class="collapsing single line">
						Wybierz semestr z opcji po prawej:
					</td>
					<td v-if="semesters.length > 0">
						<span class="ui tiny semester button"
							v-for="semester in semesters"
							v-on:click="fetchCourses(semester.id)"
							v-bind:class="{ primary: semester.id == formData.semesterId }">{{ semester.label }}</span>
					</td>
					<td v-else><i class="spinner loading icon"></i></td>
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

		<div v-if="step > 3">
			<div class="student grades" v-if="grades.students">
				<h3>Arkusz obecności i ocen</h3>
				<table class="ui very basic celled very compact table">
					<thead>
						<tr>
							<th class="two wide">indeks <i class="sort numeric ascending icon"></i></th>
							<th class="two wide">inicjały</th>
							<th v-for="studentClass in grades.classes" class="center aligned">{{ studentClass }}</th>
							<th class="center aligned" v-if="$parent.authenticated"><i class="plus icon"></i></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="student in grades.students">
							<td>{{ student.number }}</td>
							<td>{{ student.initials }}</td>
							<td v-for="grade in student.classes" class="student" v-bind:class="{ present: grade.present == true, absent: grade.present == false }">
								{{ grade.value }}
							</td>
						</tr>
					</tbody>
				</table>

				<h3>Legenda:</h3>
				<div class="legend">
					<div class="item">
						<div class="student present">&nbsp;</div>
						<div class="content">student obecny</div>
					</div>
					<div class="item">
						<div class="student present">+</div>
						<div class="content">student aktywny na zajęciach</div>
					</div>
					<div class="item">
						<div class="student present">5</div>
						<div class="content">student oceniony na zajęciach</div>
					</div>
					<div class="item">
						<div class="student absent">&nbsp;</div>
						<div class="content">student nieobecny</div>
					</div>
				</div>
			</div>

			<div class="ui negative icon message" v-else>
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
				grades: null,
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
				this.$http.post("grades/semesters").then(function(response) {
					if(response.status) {
						this.semesters = response.body.data
					}
				})
			},
			fetchCourses(semesterId) {
				this.step = 0
				this.formData.courseId = null
				this.courses = []

				this.formData.semesterId = semesterId
				this.$http.post("grades/courses", this.formData).then(function(response) {
					if(response.status) {
						this.courses = response.body.data
						this.step = 1
					}
				})
			},
			fetchGroups(courseId) {
				this.step = 1
				this.formData.groupId = null
				this.groups = []

				this.formData.courseId = courseId
				this.$http.post("grades/groups", this.formData).then(function(response) {
					if(response.status) {
						this.groups = response.body.data
						this.step = 2
					}
				})
			},
			chooseGroup(groupId) {
				this.step = 3
				this.formData.groupId = groupId
			},
			fetchGrades() {
				this.$http.post("grades", this.formData).then(function(response) {
					if(response.status) {
						this.grades = response.body.data
						this.step = 4
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

	.student.grades {
		margin-top: 1em;

		.student {
			text-align: center;
		}

		.student.absent {
			background: #F08080;
		}

		.student.present {
			background: #DAF7A6;
		}

		.legend {
			.item {
				display: block;
				margin: .25em;
			}

			.student {
				width: 2em;
				height: 2em;
				line-height: 2em;
				text-align: center;
				display: inline-block;
			}

			.content {
				display: inline-block;
				padding-left: .5em;
			}
		}
	}
</style>
