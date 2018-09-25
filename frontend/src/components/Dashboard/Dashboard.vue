<template>
	<div v-if="authenticated">
		<h1 class="ui header">
			<div class="content">
				Panel administracyjny
				<div class="sub header">
					Zarządzaj serwisem jako administrator
				</div>
			</div>
		</h1>

		<div class="ui content divider"></div>

		<div class="ui basic segment" v-for="section in sections">
			<h3>{{ section.label }}</h3>
			<div class="ui item labeled icon menu" v-bind:class="section.elements">
					<router-link class="item" :to="{ name: link.target }" v-if="link.target" v-for="link in section.links" v-bind:key="link.label">
						<i class="icon" v-bind:class="link.icon"></i>
						{{ link.label }}
					</router-link>
					<a class="item" v-on:click="run(link.action)" v-else>
						<i class="icon" v-bind:class="link.icon"></i>
						{{ link.label }}
					</a>
			</div>
		</div>
	</div>
	<content-loader v-else></content-loader>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				sections: [
					{
						label: "Treści statyczne",
						elements: "five",
						links: [
							{ label: "Strona główna", target: "dashboard", icon: "home" },
							{ label: "Aktualności", target: "dashboard.news.list", icon: "newspaper" },
							{ label: "FAQ", target: "dashboard.faqs.list", icon: "question circle" },
							{ label: "Formy kontaktu", target: "dashboard", icon: "envelope" },
							{ label: "Terminy konsultacji", target: "dashboard", icon: "calendar" },
						]
					},
					{
						label: "Dane uczelniane",
						elements: "five",
						links: [
							{ label: "Tryby studiów", target: "dashboard.modes.list", icon: "tasks" },
							{ label: "Formy zajęć", target: "dashboard.forms.list", icon: "tasks" },
							{ label: "Semestry", target: "dashboard.semesters.list", icon: "tasks" },
							{ label: "Kierunki i specjalności", target: "dashboard.fields.list", icon: "tasks" },
							{ label: "Kursy", target: "dashboard.courses.list", icon: "tasks" },
						]
					},
					{
						label: "Zarządzanie studentami",
						elements: "four",
						links: [
							{ label: "Studenci", target: "dashboard.students.list", icon: "user" },
							{ label: "Kursy w semestrze", target: "dashboard.semesterCourses.list", icon: "graduation cap" },
							{ label: "Grupy zajęciowe", target: "dashboard.courseGroups.list", icon: "users" },
							{ label: "Oceny", target: "dashboard.grades", icon: "star" },
						]
					},
					{
						label: "Ustawienia serwisu",
						elements: "five",
						links: [
							{ label: "Konto użytkownika", target: "dashboard.account", icon: "address book outline" },
							{ label: "Ustawienia", target: "dashboard", icon: "cogs" },
							{ label: "Logi", target: "dashboard.logger", icon: "sticky note" },
							{ label: "Analityki", action: "google", icon: "google" },
							{ label: "Wyloguj się", action: "logout", icon: "red sign out" },
						]
					},
				],
			}
		},
		methods: {
			run(action) {
				this[action]()
			},
			logout() {
				this.$http.post("logout").then(response => {
					if(response.data.success) {
						this.$bus.$emit("authenticate", false)
						this.notifySuccess("Zostałeś poprawnie wylogowany.")
						this.$router.push({ name: "home" })
					}
				})
			}
		}
	} 
</script>
