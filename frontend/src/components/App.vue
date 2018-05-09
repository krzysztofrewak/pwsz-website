<template>
	<div id="app">
		<app-header></app-header>
		<notifications-bar></notifications-bar>

		<div class="ui vertical stripe segment" id="content">
			<div class="ui container">
				<keep-alive>
					<transition name="page" mode="out-in">
						<router-view></router-view>
					</transition>
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
			this.$bus.$on("show-notification", notification => {
				this.systemNotifications.push(notification)
				this.reduceNotificationLifespan(notification)
			})
			this.$bus.$on("close-notification", notification => this.systemNotifications = this.systemNotifications.filter(e => e !== notification))
		},
		methods: {
			checkAuthentication() {
				this.$http.post("auth").then(response => this.$bus.$emit("authenticate", true)).catch(error => this.$bus.$emit("authenticate", false))
			},
			reduceNotificationLifespan(notification) {
				if(notification.lifespan) {
					setTimeout(() => { 
						notification.lifespan--
						this.reduceNotificationLifespan(notification)
					}, 1000)
				} else {
					this.$bus.$emit("close-notification", notification)
				}
			}
		}
	}
</script>

<style lang="scss">
	* {
		outline: 0px;
	}

	body {
		overflow-y: scroll;
		overflow-x: none;
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
		padding: 3em 0em 3em;
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

	.page-enter-active, .page-leave-active {
		transition: opacity .1s, transform .1s;
	}
	
	.page-leave-to {
		opacity: 0;
		transform: translateX(50%);
	}
	
	.page-enter {
		opacity: 0;
		transform: translateX(-50%);
	}
</style>
