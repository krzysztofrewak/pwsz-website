<template>
	<div>
		<h1>Panel administracyjny</h1>

		<div class="ui basic segment" v-for="section in sections">
			<h3>{{ section.label }}</h3>
			<span v-for="link in section.links" v-bind:key="link.label">
				<router-link class="ui button" :to="{ name: link.target }" v-if="link.target">
					<i class="user icon"></i> {{ link.label }}
				</router-link>
				<button class="ui red button" v-on:click="run(link.action)" v-else>
					<i class="user icon"></i> {{ link.label }}
				</button>
			</span>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				sections: [
					{
						label: "Treści statyczne",
						links: [
							{ label: "Strona główna", target: "dashboard" },
							{ label: "Aktualności", target: "dashboard" },
							{ label: "FAQ", target: "dashboard" },
							{ label: "Formy kontaktu", target: "dashboard" },
							{ label: "Konsulatcje", target: "dashboard" },
						]
					},
					{
						label: "Uczelnia",
						links: [
							{ label: "Kierunki i specjalności", target: "dashboard.fields.list" },
							{ label: "Formy zajęć", target: "dashboard.forms.list" },
							{ label: "Semestry", target: "dashboard.semesters.list" },
							{ label: "Kursy", target: "dashboard.courses.list" },
						]
					},
					{
						label: "Studenci",
						links: [
							{ label: "Studenci", target: "dashboard" },
							{ label: "Grupy zajęciowe", target: "dashboard" },
							{ label: "Oceny", target: "dashboard" },
						]
					},
					{
						label: "Ustawienia",
						links: [
							{ label: "Konto użytkownika", target: "dashboard" },
							{ label: "Wyloguj się", action: "logout" },
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
				this.$http.post("logout").then(function(response) {
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
