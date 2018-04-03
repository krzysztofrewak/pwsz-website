<template>
	<div class="field">
		<label>{{ label }} ({{ selectedCount }} / {{ count }})</label>
		<div class="ui segments">
			<div class="ui secondary segment">
				<div class="ui fluid icon input">
					<input placeholder="Przeszukaj listę..." type="text" v-model="searchPhrase">
					<i class="search icon"></i>
				</div>
			</div>
			<transition-group name="flip-list" tag="div" class="ui segment celled relaxed list" style="column-count: 3;">
				<li v-for="data in filteredDataset" class="item" v-bind:key="data.value">
					<input type="checkbox" :name="name" class="ui checkbox" v-model="data.selected">
					{{ data.label }}
				</li>
			</transition-group>
			<div class="ui secondary clearing segment">
				<span class="ui primary right floated button" v-on:click="update">Aktualizuj</span>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				searchPhrase: ""
			}
		},
		computed: {
			dataset: function() {
				return this.value.sort((a, b) => {
					return a.selected < b.selected
				})
			},
			filteredDataset: function() {
				return this.dataset.filter(data => JSON.stringify(data).toLowerCase().includes(this.searchPhrase.toLowerCase()))
			},
			selectedCount: function() {
				return this.dataset.filter(data => data.selected).length
			},
			count: function() {
				return this.dataset.length
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
				type: Array
			}
		},
		methods: {
			update: function() {
				console.log("management/coursegroups/students")
				console.log(this.dataset)
			}
		}
	}
</script>

<style lang="scss" scoped>
	.flip-list-move {
		transition: transform 1s;
	}
</style>