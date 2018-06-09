<template>
	<div v-if="fetched">
		<h1>{{ title }}</h1>

		<form class="ui dashboard form">
			<component v-for="(input, index) in inputs" :key="index" v-bind:is="input.type" :label="input.label" :name="input.name" v-model="input.value"></component>
		</form>

		<div class="ui fluid buttons">
			<router-link class="ui icon button" :to="{ name: listRoute }">
				<i class="chevron left icon"></i>
				Wróć do listy
			</router-link>
			<div class="or" data-text="||"></div>
			<button class="ui icon primary button" @click="post()" :class="{ loading: loading }">
				<i class="save icon"></i>
				Zapisz
			</button>
		</div>
	</div>
	<div class="ui" v-else>
		<div class="ui active inverted dimmer">
			<div class="ui text loader">Ładowanie...</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	import BooleanInput from "./Forms/BooleanInput.vue"
	import CourseTopicsInput from "./Forms/CourseTopicsInput.vue"
	import DescriptionInput from "./Forms/DescriptionInput.vue"
	import DisabledInput from "./Forms/DisabledInput.vue"
	import SelectInput from "./Forms/SelectInput.vue"
	import StudentsInput from "./Forms/StudentsInput.vue"
	import TextInput from "./Forms/TextInput.vue"

	export default {
		components: {
			BooleanInput,
			CourseTopicsInput,
			DescriptionInput,
			DisabledInput,
			SelectInput,
			StudentsInput,
			TextInput,
		},
		data() {
			return {
				fetched: false,
				loading: false,
				repository: "",
				title: "",
				inputs: []
			}
		},
		computed: {
			listRoute() {
				return "dashboard." + this.repository + ".list"
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				if(!(this.$route.params.id > 0) && this.$route.meta.createForm === undefined) {
					return
				}

				this.fetched = false
				this.repository = this.$route.meta.repository
				this.title = ""
				this.inputs = []

				let url = this.repository + "/form"
				if(this.$route.params.id) {
					url += "/" + this.$route.params.id
				}

				this.$http.get("management/" + url).then(response => {
					this.fetched = true
					this.inputs = response.data.data.inputs
					this.title = response.data.data.title
				})
			},
			prepareParameters() {
				let parameters = {}

				for(let input of this.inputs) {
					parameters[input.name] = input.value
				}

				return parameters
			},
			post() {
				let parameters = this.prepareParameters()
				
				this.loading = true

				this.$http.post("management", { repository: this.repository, request: parameters }).then(response => {
					this.loading = false
					this.notifySuccess("Zapytanie zakończono sukcesem.")
					this.$router.push({ name: this.listRoute })
				}).catch(error => {
					this.loading = false
					this.notifyError("Wystąpił błąd.")
				})
			}
		},
		watch: {
			"$route"(from, to) {
				this.fetchInitialData()
			}
		}
	}
</script>

<style lang="scss" scoped>
	.dashboard.form {
		margin-top: 2em;
		margin-bottom: 4em;
	}
</style>
