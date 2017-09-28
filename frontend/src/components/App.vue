<template>
	<div id="app">
		<app-header></app-header>

		<div class="ui vertical stripe segment" id="content">
			<div class="ui container">
				<router-view></router-view>
			</div>
		</div>

		<app-footer></app-footer>
	</div>
</template>

<script>
	import AppFooter from "./AppFooter"
	import AppHeader from "./AppHeader"

	export default {
		name: "app",
		components: {
			AppFooter,
			AppHeader
		},
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
		padding: 5em 0em;
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
