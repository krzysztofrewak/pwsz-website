<template>
	<div>
		<h1>Sprawdź swoje oceny</h1>

		<table class="ui very basic celled grades table">
			<tbody>
				<tr>
					<td class="collapsing single line">
						Wybierz semestr z opcji po prawej:
					</td>
					<td v-if="semesters.length > 0">
						<span class="ui basic tiny semester button"
							v-for="semester in semesters"
							v-on:click="fetchCourses(semester.id)"
							v-bind:class="{ primary: semester.id == formData.semesterId }">{{ semester.name }}</span>
					</td>
				</tr>
				<tr v-if="step > 0">
					<td class="collapsing single line">
						Wybierz kurs:
					</td>
					<td>
						<span class="ui basic tiny button"
							v-for="course in courses"
							v-on:click="fetchGroups(course.id)"
							v-bind:class="{ primary: course.id == formData.courseId }">
							{{ course.name }}
						</span>
					</td>
				</tr>
				<tr v-if="step > 1">
					<td class="collapsing single line">
						Wybierz grupę:
					</td>
					<td>
						<span class="ui basic tiny button"
							v-for="group in groups"
							v-on:click="chooseGroup(group.id)"
							v-bind:class="{ primary: group.id == formData.groupId }">{{ group.name }}</span>
					</td>
				</tr>
				<tr v-if="step > 2">
					<td class="collapsing single line">
						Podaj swój numer indeksu:
					</td>
					<td>
						<input class="ui basic tiny button" v-model="formData.studentId" v-on:keyup.enter="fetchGrades">
						<button class="ui primary circular icon button" v-on:click="fetchGrades" v-bind:class="{ loading: fetching }">
							<i class="search icon"></i>
						</button>
					</td>
				</tr>
			</tbody>
		</table>

		<div v-if="step > 3">
			<div class="student grades" v-if="grades.students">
				<h2>Arkusz obecności i ocen</h2>
				<table class="ui very basic celled very compact unstackable table">
					<thead>
						<tr class="center aligned">
							<th class="one wide single line">student</th>
							<th v-for="studentClass in grades.classes">{{ studentClass.name }}</th>
							<th class="center aligned" v-if="$parent.authenticated"><i class="plus icon"></i></th>
						</tr>
					</thead>
					<tbody>
						<tr class="student row" v-for="student in grades.students" v-bind:class="{ inactive: !student.number }">
							<td class="student number">{{ student.number }}</td>
							<td v-for="grade in student.classes" class="student grade" v-bind:class="{ present: grade.present == true, absent: grade.present == false }">
								{{ grade.value }}
							</td>
						</tr>
					</tbody>
				</table>

				<h3>Legenda:</h3>
				<div class="legend">
					<div class="item">
						<div class="student grade present">&nbsp;</div>
						<div class="content">student obecny lub ocena pozytywna</div>
					</div>
					<div class="item">
						<div class="student grade absent">&nbsp;</div>
						<div class="content">student nieobecny lub ocena niedostateczna</div>
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
				fetching: false,
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
				this.$http.get("grades/semesters").then((response) => {
					if(response.status) {
						this.semesters = response.data.data
					}
				})
			},
			fetchCourses(semesterId) {
				this.step = 0
				this.formData.courseId = null
				this.courses = []

				this.formData.semesterId = semesterId
				this.$http.get("grades/courses", { params: this.formData }).then((response) => {
					if(response.status) {
						this.courses = response.data.data
						this.step = 1
					}
				})
			},
			fetchGroups(courseId) {
				this.step = 1
				this.formData.groupId = null
				this.groups = []

				this.formData.courseId = courseId
				this.$http.get("grades/groups", { params: this.formData }).then((response) => {
					if(response.status) {
						this.groups = response.data.data
						this.step = 2
					}
				})
			},
			chooseGroup(groupId) {
				this.step = 3
				this.formData.groupId = groupId
			},
			fetchGrades() {
				this.fetching = true
				this.$http.get("grades", { params: this.formData }).then((response) => {
					this.fetching = false
					if(response.status) {
						this.grades = response.data.data
						this.step = 4
					}
				})
			},
		},
	} 
</script>

<style lang="scss" scoped>

	.button {
		margin: 0.25em;
		padding: 1.25em;
	}

	.check.button {
		line-height: 1.75em;
	}

	@media screen and (max-width: 720px) {
		.grades.table {
			.button {
				width: 100%;
				display: block;
			}
		}
	}

	.student.row {
		height: 2em;
	}

	.student.number {
		text-align: center;
		font-weight: bold;
	}

	.student.grades {
		margin-top: 1em;
		overflow-x: auto;

		tr td:last-child { font-weight: bold; width: 10%; }

		h2 {
			margin-top: 1em;
			margin-bottom: 1em;
		}

		.student.grade {
			text-align: center;
		}

		.student.grade.absent {
			background: #F08080;
		}

		.student.grade.present {
			background: #DAF7A6;
		}

		.legend {
			.item {
				display: inline;
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
