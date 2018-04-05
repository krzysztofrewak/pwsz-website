<template>
	<div>
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
							v-bind:class="{ primary: semester.id == formData.semesterId }">{{ semester.name }}</span>
					</td>
					<td v-else><i class="spinner loading icon"></i></td>
				</tr>
				<tr v-if="step > 0">
					<td class="collapsing single line">
						Wybierz kurs:
					</td>
					<td v-if="courses.length > 0">
						<span class="ui tiny button"
							v-for="course in courses"
							v-on:click="fetchGroups(course.id)"
							v-bind:class="{ primary: course.id == formData.courseId }">{{ course.name }}</span>
					</td>
					<td v-else><i class="spinner loading icon"></i></td>
				</tr>
				<tr v-if="step > 1">
					<td class="collapsing single line">
						Wybierz grupę:
					</td>
					<td v-if="groups.length > 0">
						<span class="ui tiny button"
							v-for="group in groups"
							v-on:click="chooseGroup(group.id)"
							v-bind:class="{ primary: group.id == formData.groupId }">{{ group.name }}</span>
					</td>
					<td v-else><i class="spinner loading icon"></i></td>
				</tr>
			</tbody>
		</table>

		<div v-if="step > 3">
			<div class="student grades" v-if="grades.students">
				<table class="ui very basic celled very compact unstackable table">
					<thead>
						<tr>
							<th class="one wide single line"></th>
							<th v-for="studentClass in grades.classes" class="center aligned">
								<input class="student grade" :value="studentClass.name" v-on:keyup.enter="updateClass(studentClass)">
							</th>
							<th class="center aligned">
								<button class="ui circular tiny icon button" v-on:click="addColumn()">
									<i class="plus icon"></i>
								</button>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="student in grades.students">
							<td>{{ student.initials }}</td>
							<td v-for="grade in student.classes" class="student" v-bind:class="{ present: grade.present == true, absent: grade.present == false }" v-on:dblclick="toggleGrade(grade)">
								<input class="student grade" :value="grade.value" v-on:keyup.enter="updateGrade(grade.id)">
							</td>
							<td></td>
						</tr>
					</tbody>
				</table>
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
			moveStep() {
				this.step++
			},
			fetchInitialData() {
				this.step = 0
				this.$http.post("management/grades/semesters").then((response) => {
					if(response.status) {
						this.semesters = response.body.data
					}
				})
			},
			fetchCourses(semesterId) {
				this.formData.courseId = null
				this.courses = []

				this.formData.semesterId = semesterId
				this.$http.post("management/grades/courses", this.formData).then((response) => {
					if(response.status) {
						this.courses = response.body.data
						this.moveStep()
					}
				})
			},
			fetchGroups(courseId) {
				this.step = 1
				this.formData.groupId = null
				this.groups = []

				this.formData.courseId = courseId
				this.$http.post("management/grades/groups", this.formData).then((response) => {
					if(response.status) {
						this.groups = response.body.data
						this.moveStep()
					}
				})
			},
			chooseGroup(groupId) {
				this.formData.groupId = groupId
				this.moveStep()
				this.fetchGrades()
			},
			fetchGrades() {
				this.grades = null
				this.$http.post("management/grades", this.formData).then((response) => {
					this.grades = response.body.data
					this.moveStep()
				})
			},
			toggleGrade(grade) {
				if(grade.present === null) grade.present = "1"
				else if(grade.present === "1") grade.present = "0"
				else if(grade.present === "0") grade.present = null

				// ajax na zmianę stanu
			},
			addColumn() {
				this.fetchGrades()
			},
			updateClass(id) {
				this.fetchGrades()
			},
			updateGrade(id) {
				this.fetchGrades()
			}
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

	.student.grades {
		margin-top: 1em;

		tr td:last-child { font-weight: bold; }

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

	.student.grade {
		width: 100%;
		background: none;
		border: none;
		font-family: "Lato";
	}
</style>
