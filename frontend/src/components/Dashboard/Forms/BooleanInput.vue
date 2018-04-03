<template>
	<div class="field">
		<label>{{ label }}</label>
		<div class="ui slider checkbox">
			<input type="checkbox" :checked="isChecked" @input="$emit('input', prepare(checked))" v-model="checked">
			<label>{{ status }}</label>
		</div>
	</div>
</template>

<script>
	export default {
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
				type: String
			}
		},
		data() {
			return {
				checked: null,
			}
		},
		computed: {
			isChecked: function() {
				return this.value > 0
			},
			status: function() {
				return this.checked ? "tak" : "nie"
			}
		},
		mounted() {
			this.checked = this.value > 0
		},
		methods: {
			prepare(value) {
				return !this.checked ? "1" : "0"
			}
		}
	}
</script>
