<template>
	<div>
		<h1 class="ui header">
			<div class="content">
				Logowanie do systemu
				<div class="sub header">
					Zaloguj się, aby zarządzać zawartością strony
				</div>
			</div>
		</h1>

		<div class="content">
			<form id="login-form" @submit.prevent="login">
				<div class="ui three column grid">
					<div class="column">
						<div class="ui fluid icon input">
							<input v-model="credentials.login" placeholder="Nazwa użytkownika" type="text" autofocus>
							<i class="user icon"></i>
						</div>
					</div>
					<div class="column">
						<div class="ui fluid icon input">
							<input v-model="credentials.password" placeholder="Hasło" type="password">
							<i class="lock icon"></i>
						</div>
					</div>
					<div class="column">
						<button class="ui fluid green ok inverted button" v-bind:class="{ loading: loading }">
							<i class="sign in icon"></i>
							Zaloguj się
						</button>
					</div>
				</div>

				<input class="hidden" type="submit">
			</form>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				credentials: {
					login: "",
					password: "",
				},
				loading: false
			}
		},
		methods: {
			login() {
				this.loading = true

				let parameters = this.credentials === undefined ? [] : this.credentials

				this.$http.post("login", parameters).then(response => {
					this.$bus.$emit("authenticate", true)
					this.notifySuccess("Zalogowano poprawnie.")
					this.$router.push({ name: "dashboard" })
					this.toggleLoading()
				}).catch(error => {
					this.notifyError(error.response.data.message)
					this.loading = false
				})
			},
			toggleLoading() {
				this.loading = !this.loading
			}
		}
	}
</script>

<style>
	#login-form {
		margin-top: 5em;
	}
</style>
