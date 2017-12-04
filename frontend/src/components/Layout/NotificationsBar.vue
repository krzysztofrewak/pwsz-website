<template>
	<div id="notifications" class="ui center aligned segment">
		<div class="ui container">
			<div class="ui negative message" v-for="n in EventBus.notifications">
				<strong>Wystąpił błąd:</strong>
				Test
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	import EventBus from "../../eventbus.js"

	export default {} 
</script>

<style lang="scss" scoped>
	#notifications {
		padding: 0;
		box-shadow: none;
		border: none;
	}
</style>
