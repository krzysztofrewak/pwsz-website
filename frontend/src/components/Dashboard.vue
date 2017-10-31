<template>
	<div>
		<h1>Panel administracyjny</h1>

		<div class="ui basic segment" v-for="section in sections">
			<h3>{{ section.label }}</h3>
			<span v-for="link in section.links" v-bind:key="link.label">
				<router-link class="ui tiny button" :to="{ name: link.target }" v-if="link.target">
					<i class="user icon"></i> {{ link.label }}
				</router-link>
				<button class="ui red tiny button" v-on:click="run(link.action)" v-else>
					<i class="user icon"></i> {{ link.label }}
				</button>
			</span>
		</div>
	</div>
</template>

<script type="text/javascript">
	import EventBus from "../eventbus.js"

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
						]
					},
					{
						label: "Uczelnia",
						links: [
							{ label: "Kierunki i specjalności", target: "dashboard.fields" },
							{ label: "Formy zajęć", target: "dashboard" },
							{ label: "Semestry", target: "dashboard" },
							{ label: "Kursy", target: "dashboard" },
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
							{ label: "Wiadomości", target: "dashboard" },
							{ label: "Formy kontaktu", target: "dashboard" },
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
				this.$http.post(this.apiUrl + "logout").then(function(response) {
					if(response.data.success) {
						EventBus.$emit("authentication_status", false)
						this.$router.push({ name: "home" })
					}
				})
			}
		}
	} 
</script>
