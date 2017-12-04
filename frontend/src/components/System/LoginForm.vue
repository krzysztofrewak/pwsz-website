<template>
	<div>
		<center>
			<div class="ui red icon header" v-if="hasErrorOccurred">
				<i class="close icon"></i>
				Wystąpił błąd: {{ errorMessage }}
			</div>
			<div class="ui icon header" v-else>
				<i class="sign in icon"></i>
				Logowanie do systemu
			</div>
		</center>

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
						<button class="ui fluid green ok inverted button" v-bind:class="{ loading: loading }" v-on:click="login">
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
	import EventBus from "../../eventbus.js"

	export default {
		data() {
			return {
				credentials: {
					login: "",
					password: "",
				},
				hasErrorOccurred: false,
				errorMessage: "",
				loading: false
			}
		},
		methods: {
			login: function() {
				var parameters = this.credentials === undefined ? [] : this.credentials

				this.toggleLoading()
				this.$http.post(this.apiUrl + "login", parameters).then(function(response) {
					if(response.data.success) {
						EventBus.$emit("authentication_status", true)
						this.$router.push({ name: "home" })
						this.toggleLoading()
					} else {
						this.reloadAuthButton(response.data.error)
					}
				})
			},
			reloadAuthButton: function(message) {
				this.toggleLoading()
				this.hasErrorOccurred = true
				this.errorMessage = message
			},
			toggleLoading: function() {
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
