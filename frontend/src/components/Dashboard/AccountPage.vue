<template>
	<div>
		<h1>Konto użytkownika</h1>
		<form class="ui form" v-if="user">
			<div class="field">
				<label>Login</label>
				<div class="ui icon input">
					<i class="user icon"></i>
					<input type="text" :value="user.login">
				</div>
			</div>
			<div class="field">
				<label>Nowe hasło</label>
				<div class="ui icon input">
					<i class="lock icon"></i>
					<input type="text" :value="user.password">
				</div>
			</div>
			<div class="field">
				<label>Potwierdzenie nowego hasła</label>
				<div class="ui icon input">
					<i class="lock icon"></i>
					<input type="text" :value="user.password_repeat">
				</div>
			</div>
		</form>
		<div class="ui" v-else>
			<div class="ui active inverted dimmer">
				<div class="ui text loader">Ładowanie...</div>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
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
