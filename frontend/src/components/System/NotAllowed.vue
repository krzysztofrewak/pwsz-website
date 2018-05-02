<template>
	<div>
		<h1>Brak dostępu</h1>
		<p>Nie masz dostępu do tej części serwisu.</p>
	</div>
</template>

<script type="text/javascript">
	export default {
		mounted() {
			this.reloadAuthStatus()
		},
		methods: {
			reloadAuthStatus: function() {
				this.$bus.$emit("authenticate", authenticated)
			},
		}
	}
</script>
