<template>
	<div v-if="fetched">
		<h1>Edytujesz: {{ title }}</h1>

		<table class="ui dashboard very basic very compact table">
			<thead>
				<tr>
					<th v-for="column in columns">{{ column }}</th>
					<th class="right aligned">akcje</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="data in dataset">
					<td v-for="(column, index) in columns">
						<span v-if="typeof(data[index]) !== typeof(true)">
							{{ data[index] }}
						</span>
						<span v-else>
							<i class="green check icon" v-if="data[index]"></i>
							<i class="red close icon" v-else></i>
						</span>
					</td>

					<td class="right aligned">
						<router-link class="ui tiny green icon labeled button" :to="{ name: formRoute, params: { id: data.id } }">
							<i class="pencil icon"></i> edytuj
						</router-link>
						<button class="ui tiny red icon labeled button">
							<i class="trash icon"></i> usuń
						</button>
					</td>
				</tr>
			</tbody>
		</table>
		
	</div>

	<div class="ui" v-else>
		<div class="ui active inverted dimmer">
			<div class="ui text loader">Ładowanie...</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				fetched: false,
				title: "",
				columns: [],
				dataset: [],
			}
		},
		computed: {
			repository: function() {
				return this.$route.meta.repository
			},
			apiRepositoryUrl: function() {
				return "management/" + this.repository
			},
			formRoute: function() {
				return "dashboard." + this.repository + ".form"
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.fetched = false
				this.$http.get(this.apiRepositoryUrl).then(function(response) {
					this.dataset = response.body.data.data
					this.title = response.body.data.title
					this.columns = response.body.data.columns
					this.fetched = true
				})
			},
		},
		watch: {
			"$route"(from, to) {
				this.fetchInitialData()
			}
		}
	}
</script>

<style lang="scss">
	.dashboard.table {
		margin-top: 3em;
	}
</style>
