<template>
	<div v-if="authenticated">
		<h1>Logger</h1>
		<table class="ui dashboard very basic very compact table">
			<thead>
				<tr>
					<th>data</th>
					<th>
						<div class="ui teal horizontal fluid label">
							<i class="play circle icon"></i>
							debug
						</div>
					</th>
					<th>
						<div class="ui blue horizontal fluid label">
							<i class="question circle icon"></i>
							info
						</div>
					</th>
					<th>
						<div class="ui yellow horizontal fluid label">
							<i class="exclamation circle icon"></i>
							warning
						</div>
					</th>
					<th>
						<div class="ui red horizontal fluid label">
							<i class="times circle icon"></i>
							alert
						</div>
					</th>
					<th>
						<div class="ui green horizontal fluid label">
							<i class="circle icon"></i>
							łącznie
						</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="log in logs">
					<td><strong>{{ log.date }}</strong></td>
					<td>{{ log.debug }}</td>
					<td>{{ log.info }}</td>
					<td>{{ log.warning }}</td>
					<td>{{ log.alert }}</td>
					<td><strong>{{ log.all }}</strong></td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				logs: [],
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("management/logs").then(function(response) {
					this.logs = response.body.data
				})
			},
		},
	} 
</script>

<style lang="scss" scoped>

</style>