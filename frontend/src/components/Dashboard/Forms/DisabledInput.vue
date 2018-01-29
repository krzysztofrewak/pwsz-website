<template>
	<div class="field">
		<label>{{ label }}</label>
		<input type="text" :placeholder="label" :value="value" disabled="disabled">
	</div>
</template>

<script>
	export default {
		props: {
			label: {
				type: String,
				required: true
			},
			value: {
				type: String
			}
		}
	}
</script>
