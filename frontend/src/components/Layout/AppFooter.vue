<template>
	<div class="ui inverted vertical footer segment" id="footer">
		<div class="ui container">
			<div class="ui inverted divided equal height three column stackable grid">
				<div class="column">
					<h4 class="ui inverted header">
						Informacje
						<router-link v-if="!authenticated" :to="{ name: 'login' }" class="latent">| Logowanie</router-link>
					</h4>
					<p>Krzysztof Rewak &copy; {{ new Date().getFullYear() }}</p>
				</div>
				<div class="column">
					<h4 class="ui inverted header">Linki na zewnątrz</h4>
					<div class="ui horizontal inverted link list">
						<a href="https://bitbucket.org/krewak/pwsz/" class="item" target="_blank"><i class="bitbucket icon"></i> Bitbucket</a>
						<a href="https://linkedin.com/in/krzysztofrewak" class="item" target="_blank"><i class="linkedin icon"></i> LinkedIn</a>
						<a href="http://rewak.pl/" class="item" target="_blank"><i class="globe icon"></i> rewak.pl</a>
					</div>
				</div>
				<div class="column">
					<h4 class="ui inverted header">Technologie</h4>
					<div class="ui horizontal inverted link list">
						<a href="https://phalconphp.com" class="item" target="_blank">Phalcon</a>
						<a href="https://vuejs.org" class="item" target="_blank">Vue.js</a>
						<a href="https://semantic-ui.com" class="item" target="_blank">Semantic UI</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
	.footer.segment {
		padding: 2em 0em;
	}

	.latent { opacity: 0; }
</style>
