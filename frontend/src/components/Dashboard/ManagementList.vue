<template>
	<div v-if="fetched">
		<h1>Edytujesz: {{ title }}</h1>

		<transition name="page" mode="out-in">
			<a class="ui fluid red icon button" v-if="deletingItem" v-on:click="deleteItem(deletingItem)">
				Czy jesteś pewien, że chcesz usunąć ten obiekt?
				Kliknij, aby usunąć go bezpowrotnie.
			</a>
		</transition>

		<div class="ui fluid icon search input">
			<input placeholder="Przeszukaj tabelę..." type="text" v-model="searchPhrase">
			<i class="search icon"></i>
		</div>

		<table class="ui dashboard very basic very compact table">
			<thead>
				<tr>
					<th v-for="(label, name) in columns" class="header" v-on:click="sortBy(name)">
						{{ label }}
						<i class="caret icon" v-bind:class="getSortingClass(name)"></i>
					</th>
					<th class="collapsing right aligned">
						<button class="ui blue circular icon button" v-on:click="fetchInitialData()" data-inverted="" data-tooltip="odśwież tabelę" data-position="top right">
							<i class="refresh icon"></i>
						</button>
						<router-link class="ui green circular icon button" :to="{ name: addRoute }" data-inverted="" data-tooltip="dodaj nowy" data-position="top right">
							<i class="plus icon"></i>
						</router-link>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="data in filteredDataset">
					<td v-for="(column, index) in columns">
						<span v-if="typeof(data[index]) !== typeof(true)">
							{{ data[index] }}
						</span>
						<span v-else>
							<i class="green check large icon" v-if="data[index]"></i>
							<i class="red close large icon" v-else></i>
						</span>
					</td>

					<td class="collapsing right aligned">
						<router-link class="ui green circular icon button" :to="{ name: formRoute, params: { id: data.id } }" data-inverted="" data-tooltip="edytuj" data-position="top right">
							<i class="pencil icon"></i>
						</router-link>
						<button class="ui red circular icon button" v-on:click="confirmDelete(data, $event)" v-bind:class="{ disabled: deletingItem }" data-inverted="" data-tooltip="usuń" data-position="top right">
							<i class="close icon"></i>
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
				deletingItem: null,
				searchPhrase: "",
				sortingKey: "",
				sortingAsc: true,
			}
		},
		computed: {
			repository: function() {
				return this.$route.meta.repository
			},
			apiRepositoryUrl: function() {
				return "management/" + this.repository
			},
			addRoute: function() {
				return "dashboard." + this.repository + ".add"
			},
			formRoute: function() {
				return "dashboard." + this.repository + ".form"
			},
			filteredDataset: function() {
				if(this.searchPhrase) {
					return this.dataset.filter((value) => {
						return JSON.stringify(value).toLowerCase().includes(this.searchPhrase.toLowerCase())
					})
				}

				if(!this.sortingKey) {
					return this.dataset
				}

				let directionFactor = this.sortingAsc ? 1 : -1
				return this.dataset.sort((a, b) => {
					if(typeof a[this.sortingKey] != "string") {
						return directionFactor * (a[this.sortingKey] - b[this.sortingKey])
					}

					return directionFactor * (a[this.sortingKey].localeCompare(b[this.sortingKey]))
				})
			},
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.fetched = false
				
				this.$http.get(this.apiRepositoryUrl).then(response => {
					this.dataset = response.data.data.data
					this.title = response.data.data.title
					this.columns = response.data.data.columns
					this.fetched = true
				})
			},
			confirmDelete(item, event) {
				event.target.classList.add("loading")
				this.deletingItem = {
					item: item,
					event: event
				}
			},
			deleteItem(item) {
				this.$http.delete("management/" + this.repository + "/" + item.item.id).then(response => {
					item.event.target.classList.remove("loading")
					this.fetchInitialData()
					this.deletingItem = null
					this.notifySuccess("Zapytanie zakończono sukcesem.")
				}).catch(error => {
					item.event.target.classList.remove("loading")
					this.notifyError("Wystąpił błąd.")
				})
			},
			sortBy(name) {
				if(this.sortingKey === name) {
					this.sortingAsc = !this.sortingAsc
				} else {
					this.sortingKey = name
					this.sortingAsc = true
				}
			},
			getSortingClass(name) {
				if(this.sortingKey === name) {
					return this.sortingAsc ? "up" : "down"
				} 

				return ""
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

	.search.input {
		margin: 3em auto 2em;
	}

	th.header {
		cursor: pointer !important;
	}
</style>
