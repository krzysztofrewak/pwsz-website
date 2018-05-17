<template>
	<div>
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
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="date in dates">
					<td><strong>{{ date.date }}</strong></td>
					<td>{{ date.debug }}</td>
					<td>{{ date.info }}</td>
					<td>{{ date.warning }}</td>
					<td>{{ date.alert }}</td>
					<td><strong>{{ sumLogs(date) }}</strong></td>
					<td>
						<button class="ui primary circular icon button" data-inverted="" data-tooltip="przejrzyj logi" data-position="top right">
							<i class="sticky note icon"></i>
						</button>
						<button class="ui red circular icon button" data-inverted="" data-tooltip="usuń" data-position="top right">
							<i class="close icon"></i>
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script type="text/javascript">

	export default {
		data() {
			return {
				dates: [
					{ date: "2018-05-13", debug: 0, info: 123, warning: 13, alert: 0 },
					{ date: "2018-05-12", debug: 0, info: 142, warning: 11, alert: 0 },
				],
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			sumLogs(date) {
				return date.debug + date.info + date.warning + date.alert
			},
			fetchInitialData() {
			},
		},
	} 
</script>

<style lang="scss" scoped>

</style>