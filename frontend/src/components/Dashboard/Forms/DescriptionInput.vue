<template>
	<div class="field">
		<label>{{ label }}</label>
		<vue-editor v-model="html" @input="$emit('input', html)"></vue-editor>
	</div>
</template>

<script>
	import { VueEditor } from "vue2-editor"

	export default {
		components: {
			VueEditor
		},
		data() {
			return {
				html: ""
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
				type: String
			}
		},
		mounted() {
			this.html = this.value
		},
	}
</script>

<style>
	#quill-container { padding: 1em; }	
</style>
