<template>
	<div id="faq">
		<h1>FAQ (często zadawane pytania i odpowiedzi na nie)</h1>

		<div class="question" v-for="question in questions">
			<div class="ui divider"></div>
			<h3 class="ui header">
				<i class="question circle outline icon"></i>
				{{ question.question }}
			</h3>
			<blockquote v-html="question.answer"></blockquote>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				questions: [],
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("faq").then(function(response) {
					this.questions = response.body.data
				})
			},
		},
	}
</script>

<style scoped>
	blockquote { padding: .5em; }
	.question:first-of-type > .ui.divider { display: none; }
	.question { padding: .5em 0; }
</style>