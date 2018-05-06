<template>
	<div>
		<h1>Konto użytkownika</h1>
		<form class="ui form" v-if="user">
			<disabled-input label="ID" name="id" :value="user.id"></disabled-input>
			<text-input label="Login" name="login" v-model="user.login"></text-input>
			<text-input label="Email" name="email" v-model="user.email"></text-input>
			<password-input label="Hasło" name="new_password" v-model="user.new_password"></password-input>
			<password-input label="Powtórz hasło" name="new_password_repeat" v-model="user.new_password_repeat"></password-input>
			<disabled-input label="Data rejestracji" name="created_at" :value="user.created_at"></disabled-input>
			<disabled-input label="Data ostatniej edycji" name="updated_at" :value="user.updated_at"></disabled-input>

			<span class="ui fluid icon primary button" @click="updateUser()" :class="{ loading: loading }">
				<i class="save icon"></i>
				Zapisz
			</span>
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
	import PasswordInput from "./Forms/PasswordInput.vue"
	import TextInput from "./Forms/TextInput.vue"

	export default {
		components: {
			DisabledInput,
			PasswordInput,
			TextInput,
		},
		data() {
			return {
				loading: false,
				user: null
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("management/user").then(function(response) {
					if(response.body.success) {
						this.user = response.body.data
					}
				})
			},
			updateUser() {
				this.loading = true
				
				this.$http.post("management/user", { user: this.user }).then(function(response) {
					this.loading = false
					this.notifySuccess("Dane zostały zmienione.")
				}).catch(error => {
					this.loading = false
					this.notifyError(error.data.message)
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