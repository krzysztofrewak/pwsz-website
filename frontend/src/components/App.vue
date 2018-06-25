<template>
	<div id="app" v-bind:class="{ landing: isHome() }">
		<app-header></app-header>
		<notifications-bar></notifications-bar>

		<div class="ui vertical stripe segment" id="content">
			<div class="ui" v-bind:class="{ container: !isHome() }">
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
				isAuthenticated: null,
				systemNotifications: [],
			}
		},
		created() {
			this.$bus.$on("authenticate", status => this.isAuthenticated = status)
			this.$bus.$on("show-notification", notification => {
				this.systemNotifications.push(notification)
				this.reduceNotificationLifespan(notification)
			})
			this.$bus.$on("close-notification", notification => this.systemNotifications = this.systemNotifications.filter(e => e !== notification))

			this.$http.interceptors.response.use(response => {
				this.$bus.$emit("authenticate", response.data.auth)
				return response
			})
		},
		mounted() {
			setTimeout(() => {
				if(this.isAuthenticated !== null) {
					this.guardRoute(this.isAuthenticated)
					return
				}

				this.$http.post("auth")
					.then(response => this.guardRoute(response.data.auth))
					.catch(error => this.guardRoute(error.data.auth))
			}, 500)
		},
		methods: {
			reduceNotificationLifespan(notification) {
				if(notification.lifespan) {
					setTimeout(() => {
						notification.lifespan--
						this.reduceNotificationLifespan(notification)
					}, 1000)
				} else {
					this.$bus.$emit("close-notification", notification)
				}
			},
			authenticate() {
				if(this.isAuthenticated !== null) {
					this.guardRoute(this.isAuthenticated)
					return
				}

				this.$http.post("auth")
					.then(response => this.guardRoute(response.data.auth))
					.catch(error => this.guardRoute(false))
			},
			guardRoute(authenticationStatus) {
				if(this.$route.meta.requiresAuth && !authenticationStatus) {
					this.$router.push({ name: "not-allowed" })
				}

				if(this.$route.meta.requiresGuest && authenticationStatus) {
					this.$router.push({ name: "not-allowed" })
				}
			},
			isHome() {
				return this.$route.name === "home"
			}
		},
		watch: {
			"$route"(to, from) {
				this.authenticate()
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
		overflow-x: unset;
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

	.only.narrow.screen {
		display: none;
	}

	@media only screen and (max-width: 720px) {
		#content {
			margin-top: 5em;
		}

		.only.narrow.screen {
			display: unset;
		}

		.only.wide.screen {
			display: none;
		}

		.header {
			.content {
				display: block !important;
				width: 100%;
				text-align: center;
			}

			.tile {
				display: none !important;
			}
		}
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

	.primary {
		background: cornflowerblue !important;
	}

	.content.divider {
		margin: 2.5em 0;
	}
</style>
