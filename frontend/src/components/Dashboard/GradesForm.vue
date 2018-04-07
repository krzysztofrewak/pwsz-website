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
							<th class="one wide single line center aligned">
								<button class="ui circular tiny icon button" v-on:click="fetchGrades()">
									<i class="icon" v-bind:class="getIcon"></i>
								</button>
							</th>
							<th v-for="studentClass in grades.classes" class="center aligned">
								<input class="student grade" v-model="studentClass.name" v-on:keyup.enter="updateClass(studentClass)">
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
							<td>{{ student.name }}</td>
							<td v-for="grade in student.classes" class="student" v-bind:class="{ present: grade.was_present == true, absent: grade.was_present == false }" v-on:dblclick="toggleGrade(grade)">
								<input class="student grade" v-model="grade.value" v-on:keyup.enter="updateGrade(grade)">
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
				grades: [],
				groups: [],
				semesters: [],
				courses: [],
				step: 0,
				successStatus: false,
			}
		},
		created() {
			this.fetchInitialData()
		},
		computed: {
			getIcon: function() {
				return !this.successStatus ? "refresh" : "green check"
			}
		},
		methods: {
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
						this.step = 1
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
						this.step = 2
					}
				})
			},
			chooseGroup(groupId) {
				this.formData.groupId = groupId
				this.step = 3
				this.fetchGrades()
			},
			fetchGrades() {
				this.grades = []
				this.$http.post("management/grades", this.formData).then((response) => {
					this.grades = response.body.data
					this.step = 4
				})
			},
			toggleGrade(grade) {
				if(grade.was_present === null) grade.was_present = "1"
				else if(grade.was_present === "1") grade.was_present = "0"
				else if(grade.was_present === "0") grade.was_present = null

				this.updateGrade(grade)
			},
			addColumn() {
				let groupClass = {
					name: "?",
					course_group_id: this.formData.groupId
				}

				this.$http.post("management", { repository: "courseGroupClasses", request: groupClass }).then((response) => {
					this.fetchGrades()
				})
			},
			updateClass(grade) {
				let groupClass = {
					id: grade.id,
					name: grade.name,
					course_group_id: this.formData.groupId
				}

				this.$http.post("management", { repository: "courseGroupClasses", request: groupClass }).then((response) => {
					this.fetchGrades()
				})
			},
			updateGrade(grade) {
				this.$http.post("management", { repository: "grades", request: grade }).then((response) => {
					this.successStatus = true
					setTimeout(() => {
						this.successStatus = false;
					}, 1000);
				})
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
		margin-top: 5em;

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
