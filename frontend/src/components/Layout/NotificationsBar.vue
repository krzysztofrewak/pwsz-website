<template>
	<div id="notifications" class="ui center aligned segment">
		<div class="ui container">
			<div class="ui notification icon message" v-for="n in notifications" :class="n.type" @click="close(n)">
				<i class="exclamation circle icon"></i>
				<div class="content">
					<div class="header">
						<strong v-if="n.type == 'negative'">Wystąpił błąd:</strong>
						<strong v-else>Komunikat:</strong>
					</div>
					{{ n.message }}
				</div>
				<div class="lifespan">
					<i class="inactive tiny circle icon" v-for="life in n.lifespan"></i>
				</div>
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
		background: none;
		border: none;
		bottom: 1em;
		box-shadow: none;
		cursor: pointer;
		padding: 0;
		position: fixed;
		width: 100%;
		z-index: 999;

		.lifespan {
			position: absolute;
			top: 2px;
			right: 5px;

			i {
				transition: all 1s ease-in-out;
				display: block;
				padding: 6px;
			}

			.inactive {
				opacity: .75;
			}
		}
	}
</style>
