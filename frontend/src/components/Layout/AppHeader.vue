<template>
	<div>
		<transition name="page" mode="out-in">
			<div class="modal" v-if="modalActivated" v-on:click="modalActivated = false">
				<div class="content">
					<router-link :to="{ name: 'home' }" class="ui inverted basic button" v-bind:class="{ primary: isActive('home') }">
						Strona główna
					</router-link>
					<router-link v-for="link in headerLinks" :to="{ name: link.name }" v-bind:key="link.name" class="ui inverted basic button" v-bind:class="{ primary: isActive(link.name) }">{{ link.label }}</router-link>
					<router-link class="ui inverted basic button" v-if="authenticated" :to="{ name: 'dashboard' }" v-bind:class="{ primary: isActive('dashboard') }">Zarządzaj</router-link>
				</div>
			</div>
		</transition>

		<div class="ui inverted vertical superheader center aligned segment" id="header">
			<div class="ui container" id="navigation">
				<div class="ui large secondary inverted pointing menu">
					<router-link :to="{ name: 'home' }" class="brand item">
						Krzysztof <span class="bolded">Rewak</span>
					</router-link>
					<span class="brand item menu toggler" v-on:click="modalActivated = true">
						<i class="bars icon"></i>
					</span>

					<router-link v-for="link in headerLinks" :to="{ name: link.name }" v-bind:key="link.name" class="item" v-bind:class="{ active: isActive(link.name) }">{{ link.label }}</router-link>

					<router-link class="item" v-if="authenticated" :to="{ name: 'dashboard' }" v-bind:class="{ active: isActive('dashboard') }">Zarządzaj</router-link>
				</div>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				modalActivated: false,
				headerLinks: [
					{ name: "news", label: "Aktualności" },
					{ name: "courses", label: "Kursy" },
					{ name: "grades", label: "Oceny" },
					{ name: "faq", label: "FAQ" },
					{ name: "contact", label: "Kontakt" },
				],
			}
		},
		methods: {
			isActive(section) {
				return section === this.$route.meta.section
			},
		}
	} 
</script>

<style lang="scss" scoped>
	.superheader {
		z-index: 99;

		.ui.menu {
			border: none !important;
			box-shadow: none;

			a.item.active {
				border: 0px !important;
				margin: 0px !important;
			}
			
			.menu.toggler {
				display: none;
				cursor: pointer;
			}

			.brand.item {
				font-weight: 700;
				background: rgba(255, 255, 255, 0.1) !important;

				.bolded {
					text-transform: uppercase;
					margin-left: 5px;
					color: White;
				}
			}
		}
	}

	.modal {
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		width: 100vw;
		background: rgba(Black, .9);
		display: flex;
		align-items: center;
		justify-content: center;
		z-index: 100;
		color: White;

		.content {
			width: 100%;

			a {
				display: block;
				width: 50%;
				margin: 1em auto;
			}
		}
	}

	@media only screen and (max-width: 720px) {
		#header {
			position: fixed;
			width: 100vw;

			.menu {
				.brand {
					width: 50%;
				}
				
				.menu.toggler {
					display: inline-block;
					text-align: right;
				}

				a.item:not(.brand) {
					display: none !important;
				}
			}
		}

		.landing #header {
			position: absolute;
			width: 100vw;
		}
	}
</style>
