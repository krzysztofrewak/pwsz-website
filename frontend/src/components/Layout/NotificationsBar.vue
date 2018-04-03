<template>
	<div id="notifications" class="ui center aligned segment">
		<div class="ui container">
			<div class="ui message" v-for="n in notifications" :class="n.type" @click="close(n)">
				<i class="close icon" @click="close(n)"></i>
				<strong v-if="n.type == 'negative'">Wystąpił błąd:</strong>
				{{ n.message }}
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		methods: {
			close(notification) {
				this.$bus.$emit("close-notification", notification)
			}
		}
	} 
</script>

<style lang="scss" scoped>
	#notifications {
		padding: 0;
		box-shadow: none;
		border: none;
	}
</style>
