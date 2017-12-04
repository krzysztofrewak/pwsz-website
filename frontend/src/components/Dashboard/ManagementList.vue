<template>
	<div v-if="fetched">
		<h1>Edytujesz: {{ title }}</h1>

		<table class="ui dashboard very basic very compact table">
			<thead>
				<tr>
					<th>id</th>
					<th>skrótowiec</th>
					<th>nazwa</th>
					<th class="right aligned">akcje</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="data in dataset">
					<td>{{ data.id }}</td>
					<td>{{ data.index }}</td>
					<td>{{ data.name }}</td>
					<td class="right aligned">
						<router-link class="ui tiny green icon labeled button" :to="{ name: repositoryName, params: { id: data.id } }">
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
				dataset: [],
				repository: "field",
			}
		},
		computed: {
			repositoryName: function() {
				return "dashboard." + this.repository
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				var self = this

				self.$http.get(self.apiUrl + "management/field").then(function(response) {
					self.dataset = response.body.data.data
					self.title = response.body.data.title
					self.toggleFetchedStatus()
				})
			},
			toggleFetchedStatus() {
				this.fetched = !this.fetched
			}
		},
	}
</script>

<style lang="scss">
	.dashboard.table {
		margin-top: 3em;
	}
</style>
