<template>
	<div class="ui inverted vertical footer segment" id="footer">
		<div class="ui container">
			<div class="ui inverted divided equal height three column stackable grid">
				<div class="column">
					<h4 class="ui inverted header">
						Informacje
						<router-link v-if="!authenticated" :to="{ name: 'login' }" class="latent">| Logowanie</router-link>
					</h4>
					<p>Krzysztof Rewak <i class="creative commons icon"></i> {{ new Date().getFullYear() }} | pewne prawa zastrzeżone</p>
				</div>
				<div class="column">
					<h4 class="ui inverted header">Linki</h4>
					<div class="ui horizontal inverted link list">
						<a :href="link.url" class="item" target="_blank" v-for="link in links">
							<i class="icon" :class="link.icon"></i>
							{{ link.label }}
						</a>
					</div>
				</div>
				<div class="column">
					<h4 class="ui inverted header">Technologie</h4>
					<div class="ui horizontal inverted link list">
						<a :href="technology.url" class="item" target="_blank" v-for="technology in technologies">
							{{ technology.label }}
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				links: [
					{ label: "Bitbucket", icon: "bitbucket", url: "https://bitbucket.org/krewak/" },
					{ label: "LinkedIn", icon: "linkedin", url: "https://linkedin.com/in/krzysztofrewak" },
					{ label: "rewak.pl", icon: "globe", url: "http://rewak.pl/" },
				],
				technologies: [
					{ label: "Phalcon", url: "https://phalconphp.com/" },
					{ label: "Behat", url: "https://behat.org/" },
					{ label: "MySQL", url: "https://mysql.com/" },
					{ label: "Vue.js", url: "https://vuejs.org/" },
					{ label: "Semantic UI", url: "https://semantic-ui.com/" },
				],
			}
		},
	}
</script>

<style scoped>
	.footer.segment { padding: 2em 0em; }
	.latent { opacity: 0; }
	.creative.commons.icon { margin: 0; padding: 0; }
</style>
