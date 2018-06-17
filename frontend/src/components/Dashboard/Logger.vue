<template>
	<div v-if="authenticated && !fetching">
		<h1 class="ui header">
			<i class="tile bordered inverted cogs icon"></i>
			<div class="content">
				Logi
				<div class="sub header">
					Lista logów systemowych
				</div>
			</div>
		</h1>

		<table class="ui dashboard very basic very compact table">
			<thead>
				<tr>
					<th>plik</th>
					<th>
						<i class="circular white small circle icon"></i>
						debug
					</th>
					<th>
						<i class="circular blue small circle icon"></i>
						info
					</th>
					<th>
						<i class="circular yellow small circle icon"></i>
						warning
					</th>
					<th>
						<i class="circular red small circle icon"></i>
						alert
					</th>
					<th>
						<i class="circular black small circle icon"></i>
						łącznie
					</th>
					<th class="right aligned">
						akcje
					</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="log in logs">
					<td><strong>{{ log.date }}</strong></td>
					<td class="log column">{{ log.debug }}</td>
					<td class="log column">{{ log.info }}</td>
					<td class="log column">{{ log.warning }}</td>
					<td class="log column">{{ log.alert }}</td>
					<td class="log column"><strong>{{ log.all }}</strong></td>
					<td class="right aligned">
						<router-link class="ui blue circular icon button" :to="{ name: 'dashboard.logger.log', params: { day: log.date } }" data-inverted="" data-tooltip="zobacz" data-position="top center">
							<i class="chevron right icon"></i>
						</router-link>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<content-loader v-else></content-loader>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				logs: [],
				fetching: true,
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("management/logs").then(response => {
					this.logs = response.data.data
					this.fetching = false
				})
			},
		},
	} 
</script>

<style lang="scss" scoped>
	.log.column {
		width: 10%;
	}
</style>