<template>
	<div class="field">
		<label>{{ label }}</label>
		<div class="ui icon input">
			<textarea type="text" :placeholder="label" :value="value" @input="$emit('input', $event.target.value)"></textarea>
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
		}
	}
</script>
