<template>
	<div id="faq" v-if="fetching">
		<h1 class="ui header">
			<i class="olive bordered inverted question mark circle icon"></i>
			<div class="content">
				FAQ
				<div class="sub header">
					Często zadawane pytania i odpowiedzi na nie
				</div>
			</div>
		</h1>

		<div class="question" v-for="question in questions">
			<div class="ui divider"></div>
			<h3 class="ui header">
				<i class="question circle outline icon"></i>
				{{ question.question }}
			</h3>
			<blockquote v-html="question.answer"></blockquote>
		</div>
	</div>
	<content-loader v-else></content-loader>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				questions: [],
				fetching: true,
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("faq").then(response => {
					this.questions = response.data.data
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