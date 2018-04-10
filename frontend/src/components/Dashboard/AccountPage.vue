<template>
	<div>
		<h1>Konto użytkownika</h1>
		<form class="ui form" v-if="user">
			<disabled-input label="ID" name="id" :value="user.id"></disabled-input>
			<text-input label="Login" name="login" v-model="user.login"></text-input>
			<text-input label="Hasło" name="new_password" v-model="user.new_password"></text-input>
			<text-input label="Powtórz hasło" name="new_password_repeat" v-model="user.new_password_repeat"></text-input>
			<disabled-input label="Data rejestracji" name="created_at" :value="user.created_at"></disabled-input>
			<disabled-input label="Data ostatniej edycji" name="updated_at" :value="user.updated_at"></disabled-input>

			<button class="ui fluid icon primary button" @click="post()">
				<i class="save icon"></i>
				Zapisz
			</button>
		</form>
		<div class="ui" v-else>
			<div class="ui active inverted dimmer">
				<div class="ui text loader">Ładowanie...</div>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	import DisabledInput from "./Forms/DisabledInput.vue"
	import TextInput from "./Forms/TextInput.vue"

	export default {
		components: {
			DisabledInput,
			TextInput,
		},
		data() {
			return {
				user: null
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("user").then(function(response) {
					if(response.body.success) {
						this.user = response.body.data
					}
				})
			},
		},
	} 
</script>

<style lang="scss" scoped>
	.form {
		margin-top: 2em;
	}

	.button {
		margin-top: 3em;
	}
</style>