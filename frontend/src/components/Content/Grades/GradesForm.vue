<template>
	<div class="">
		<h1 class="ui header">
			<i class="bordered inverted graduation cap icon"></i>
			<div class="content">
				Formularz dostępu do ocen
				<div class="sub header">
					Wybierz odpowiedni semestr, kurs oraz grupę, a następnie wpisz swój numer indeksu, aby uzyskać arkusz ocen i obecności
				</div>
			</div>
		</h1>

		<table class="ui very basic celled grades table">
			<tbody>
				<tr>
					<td class="collapsing single line">Wybierz semestr:</td>
					<td v-if="formSets.semesters !== null">
						<span class="ui basic tiny semester button"
							  v-for="semester in formSets.semesters"
							  v-on:click="selectSemester(semester.id)"
							  v-bind:class="getButtonClass('semester', semester.id)">{{ semester.name }}</span>
						<span v-if="!formSets.semesters.length">brak semestrów do wyświetlenia</span>
					</td>
					<td v-else>
						<i class="circular basic spinner loading icon"></i>
					</td>
				</tr>
				<tr v-if="formData.semesterId">
					<td class="collapsing single line">Wybierz kurs:</td>
					<td v-if="formSets.courses !== null">
						<span class="ui basic tiny semester button"
							  v-for="course in formSets.courses"
							  v-on:click="selectCourse(course.id)"
							  v-bind:class="getButtonClass('course', course.id)">{{ course.name }}</span>
						<span v-if="!formSets.courses.length">brak kursów do wyświetlenia</span>
					</td>
					<td v-else>
						<i class="circular basic spinner loading icon"></i>
					</td>
				</tr>
				<tr v-if="formData.courseId">
					<td class="collapsing single line">Wybierz grupę:</td>
					<td v-if="formSets.groups !== null">
						<span class="ui basic tiny semester button"
							  v-for="group in formSets.groups"
							  v-on:click="selectGroup(group.id)"
							  v-bind:class="getButtonClass('group', group.id)">{{ group.name }}</span>
						<span v-if="!formSets.groups.length">brak grup do wyświetlenia</span>
					</td>
					<td v-else>
						<i class="circular basic spinner loading icon"></i>
					</td>
				</tr>
				<tr v-if="formData.groupId">
					<td class="collapsing single line">Wpisz numer indeksu:</td>
					<td>
						<input class="ui basic tiny button" v-model="temporaryStudentId" v-on:keyup.enter="selectStudent()">
						<button class="ui primary circular icon button" v-bind:class="{ loading: fetchingGrades && formData.studentId }" v-on:click="selectStudent()">
							<i class="search icon"></i>
						</button>
					</td>
				</tr>
			</tbody>
		</table>

		<div v-if="grades">
			<grades-table :grades="grades"></grades-table>
		</div>
	</div>
</template>

<script type="text/javascript">
	import GradesTable from "./GradesTable.vue"

	export default {
		components: {
			GradesTable,
		},
		data() {
			return {
				fetchingGrades: false,
				grades: null,
				formSets: {
					groups: null,
					semesters: null,
					courses: null,
				},
				temporaryStudentId: ""
			}
		},
		computed: {
			formData() {
				return {
					semesterId: this.$route.params.semester,
					courseId: this.$route.params.course,
					groupId: this.$route.params.group,
					studentId: this.$route.params.student,
				}
			}
		},
		mounted() {
			this.initializeForm()
		},
		methods: {
			initializeForm() {
				this.fetch("semesters")
				if(this.formData.semesterId) {
					this.fetch("courses")
				}
				if(this.formData.courseId) {
					this.fetch("groups")
				}
				if(this.formData.studentId) {
					this.temporaryStudentId = this.formData.studentId
					this.fetchGrades()
				}
			},
			fetch(repository) {
				this.$http.get("grades/" + repository, { params: this.formData }).then(response => {
					this.formSets[repository] = response.data.data
				}).catch(() => {
					this.formSets[repository] = []
				})
			},
			fetchGrades() {
				this.fetchingGrades = true
				this.$http.get("grades", { params: this.formData }).then(response => {
					this.fetchingGrades = false
					this.grades = response.data.data.length !== 0 ? response.data.data : {}
				})
			},
			selectSemester(id) {
				this.$router.push({
					name: "grades.semester",
					params: {
						semester: id
					}
				})
				this.fetch("courses")
			},
			selectCourse(id) {
				this.$router.push({
					name: "grades.course",
					params: {
						semester: this.formData.semesterId,
						course: id
					}
				})
				this.fetch("groups")
			},
			selectGroup(id) {
				this.$router.push({
					name: "grades.group",
					params: {
						semester: this.formData.semesterId,
						course: this.formData.courseId,
						group: id
					}
				})
			},
			selectStudent() {
				if(!this.temporaryStudentId) {
					return
				}

				if(this.temporaryStudentId === this.formData.studentId) {
					this.fetchGrades()
				}

				this.$router.push({
					name: "grades.student",
					params: {
						semester: this.formData.semesterId,
						course: this.formData.courseId,
						group: this.formData.groupId,
						student: this.temporaryStudentId
					}
				})
			},
			getButtonClass(repository, id) {
				return this.$route.params[repository] === id ? "primary" : ""
			}
		},
		watch: {
			"$route"(to, from) {
				this.grades = null
				this.initializeForm()
			}
		}
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

</style>
