<template>
	<div>
		<h1 class="ui header">
			<i class="bordered inverted envelope icon"></i>
			<div class="content">
				Kontakt
				<div class="sub header">
					Wybierz formę kontaktu z prowadzącym
				</div>
			</div>
		</h1>

		<div class="ui secondary pointing menu">
			<router-link v-for="nav in navs" :key="nav.name" :to="{ name: nav.name }" class="item" v-bind:class="{ active: nav.name == $route.name }">
				<i class="icon" v-bind:class="nav.icon"></i>
				{{ nav.label }}
			</router-link>
		</div>

		<transition name="page" mode="out-in">
			<component v-bind:is="contactComponent"></component>
		</transition>
	</div>
</template>

<script type="text/javascript">
	import Consultations from "./Consultations.vue"
	import Form from "./Form.vue"
	import Page from "./Page.vue"
	
	export default {
		components: {
			"contact": Page,
			"contact-form": Form,
			"contact-consultations": Consultations,
		},
		data() {
			return {
				navs: [
					{
						name: "contact",
						label: "e-mail kontaktowy",
						icon: "envelope"
					},
					// {
					// 	name: "contact.form",
					// 	label: "formularz kontaktowy",
					// 	icon: "comment"
					// },
					{
						name: "contact.consultations",
						label: "konsultacje",
						icon: "calendar"
					},
				]
			}
		},
		computed: {
			contactComponent() {
				return this.$route.name.replace(".", "-")
			}
		}
	} 
</script>

<style scoped>
	.menu {
		margin-bottom: 2em;
	}
</style>
