<template>
	<div id="app">
		<app-header></app-header>
		<notifications-bar></notifications-bar>

		<div class="ui vertical stripe segment" id="content">
			<div class="ui container">
				<keep-alive>
					<router-view></router-view>
				</keep-alive>
			</div>
		</div>

		<app-footer></app-footer>
	</div>
</template>

<script>
	import AppFooter from "./Layout/AppFooter"
	import AppHeader from "./Layout/AppHeader"
	import NotificationsBar from "./Layout/NotificationsBar"
	import EventBus from "../eventbus.js"

	export default {
		name: "app",
		components: {
			AppFooter,
			AppHeader,
			NotificationsBar,
		},
		data() {
			return {
				isAuthenticated: false,
			}
		},
		created() {
			this.checkAuthentication()
		},
		mounted() {
			var self = this
			EventBus.$on("authentication_status", function(authenticationStatus) {
				self.isAuthenticated = authenticationStatus
			})
		},
		methods: {
			checkAuthentication() {
				this.$http.post(this.apiUrl + "auth").then(function(response) {
					EventBus.$emit("authentication_status", response.body.auth_status)
				})
			}
		}
	}
</script>

<style lang="scss">
	* {
		outline: 0px;
	}
	
	.clear {
		clear: both;
	}

	.hidden {
		display: none;
	}

	.inactive {
		opacity: 0.5;
	}

	a, a:hover, a:active, a:visited {
		color: inherit;
	}

	.ui.dimmer {
		background-color: rgba(0, 0, 0, .97);
	}

	#app {
		display: flex;
		flex-direction: column;
		min-height: 100vh;
	}

	#content {
		border-bottom: none;
		flex: 1;
		padding: 3em 0em;
	}

	.clickable {
		cursor: pointer;
	}

	.top.seperated {
		margin-top: 5em;
	}

	.bottom.seperated {
		margin-bottom: 5em;
	}

	.subheader {
		color: rgba(0, 0, 0, 0.5);
		font-weight: initial;
	}
</style>
