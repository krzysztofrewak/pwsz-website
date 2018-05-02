<template>
	<div class="field">
		<label>{{ label }}</label>
		<div class="ui left icon input">
			<i class="align left icon"></i>
			<input type="text" :placeholder="label" :value="value" disabled="disabled">
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
			value: {
				type: String
			}
		}
	}
</script>
