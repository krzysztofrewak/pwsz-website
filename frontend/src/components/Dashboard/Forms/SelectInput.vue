<template>
	<div class="field">
		<label>{{ label }}</label>
		<span class="ui basic button" v-for="v in dataset" v-bind:class="{ primary: v.selected }" @click="select(v)">{{ v.label }}</span>
	</div>
</template>

<script>
	export default {
		computed: {
			dataset: function() {
				return this.value
			}
		},
		props: {
			label: {
				type: String,
				required: true
			},
			name: {
				type: String,
				required: true
			},
			value: {
				type: Array
			}
		},
		methods: {
			select(value) {
				this.dataset.map(item => {
					if(value.value == item.value) {
						item.selected = true
					} else {
						item.selected = false
					}

					return value
				})
				this.$emit("input", this.dataset)
			}
		}
	}
</script>

<style lang="scss" scoped>
	.button {
		margin: .5em;
	}
</style>