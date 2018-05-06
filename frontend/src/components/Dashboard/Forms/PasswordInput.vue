<template>
	<div class="field">
		<label>{{ label }}</label>
		<div class="ui left icon input">
			<i class="align left icon"></i>
			<input type="password" :placeholder="label" :value="value" @input="$emit('input', $event.target.value)">
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
	}
</script>
