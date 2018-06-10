<template>
	<div v-if="authenticated && !fetching">
		<h1 class="ui header">
			<i class="tile bordered inverted cogs icon"></i>
			<div class="content">
				Logi z dnia {{ $route.params.day }}
				<div class="sub header">
					Lista zalogowanych akcji w systemie: {{ filteredLogs.length }}
				</div>
			</div>
		</h1>

		<div class="ui fluid icon search input">
			<input placeholder="Przeszukaj tabelę..." type="text" v-model="searchPhrase">
			<i class="search icon"></i>
		</div>

		<table class="ui very basic very compact table" v-if="!fetching">
			<thead>
			<tr>
				<th>czas</th>
				<th>adres IP</th>
				<th>stopień</th>
				<th>wiadomość</th>
			</tr>
			</thead>
			<tbody>
				<tr v-for="log in filteredLogs">
					<td class="single line">{{ log.time }}</td>
					<td class="single line">{{ log.ip }}</td>
					<td class="single line"><i class="circular small circle icon" :class="getIconColor(log.method)"></i> {{ log.method }}</td>
					<td>{{ log.message }}</td>
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
				searchPhrase: "",
			}
		},
		computed: {
			filteredLogs() {
				return this.searchPhrase.length ? this.logs.filter(value => {
					return JSON.stringify(value).toLowerCase().includes(this.searchPhrase.toLowerCase())
				}) : this.logs
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("management/logs/" + this.$route.params.day).then(response => {
					this.logs = response.data.data
					this.fetching = false
				})
			},
			getIconColor(method) {
				switch(method) {
					case "INFO":
						return "blue"
					case "WARNING":
						return "yellow"
					case "ALERT":
						return "red"
					case "DEBUG":
						return "white"
					default:
						return "black"
				}
			}
		},
	} 
</script>

<style lang="scss" scoped>
	.search.input {
		margin: 3em auto;
	}

	.table td {
		font-family: "Consolas";
	}
</style>