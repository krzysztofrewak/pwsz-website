<template>
	<div class="ui inverted vertical superheader center aligned segment">
		<div class="ui container" id="navigation">
			<div class="ui large secondary inverted pointing menu">
				<router-link :to="{ name: 'home' }" class="brand item">
					Krzysztof <span class="bolded">Rewak</span>
				</router-link>

				<router-link v-for="link in headerLinks" :to="{ name: link.name }" v-bind:key="link.name" class="item" v-bind:class="{ active: isActive(link.name) }">{{ link.label }}</router-link>

				<router-link class="item" v-if="authenticated" :to="{ name: 'dashboard' }" v-bind:class="{ active: isActive('dashboard') }">Zarządzaj</router-link>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
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
				return section == this.$route.meta.section
			},
		}
	} 
</script>

<style lang="scss" scoped>
	.superheader {
		z-index: 99;

		.menu {
			border: none !important;
			box-shadow: none;
		}

		a.item.active {
			border: 0px !important;
			margin: 0px !important;
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

	@media only screen and (max-width: 720px) {
		#navigation {
			.menu {
				display: flex;
				flex-direction: column;

				a {
					display: block !important;
					flex: 1;
					width: 100%;
				}
			}
		}
	}
</style>
