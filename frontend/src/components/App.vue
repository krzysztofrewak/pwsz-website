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
				systemNotifications: [],
			}
		},
		created() {
			this.checkAuthentication()
		},
		mounted() {			
			this.$bus.$on("authenticate", status => this.isAuthenticated = status)
			this.$bus.$on("show-notification", notification => this.systemNotifications.push(notification))
			this.$bus.$on("close-notification", notification => this.systemNotifications = this.systemNotifications.filter(e => e !== notification))
		},
		methods: {
			checkAuthentication() {
				this.$http.post("auth").then(response => this.$bus.$emit("authenticate", response.body.auth_status))
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
