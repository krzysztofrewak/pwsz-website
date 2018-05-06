<template>
	<div class="field">
		<label>{{ label }} ({{ count }})</label>
		<div class="ui segments">
			<div class="ui secondary segment right aligned">
				<i class="exclamation circle icon"></i>
				zarządzanie tematami odbywa się asynchronicznie
			</div>
			<div class="ui segment" v-if="editedFile">
				<div class="inline fields">
					<div class="six wide field">
						<div class="ui left icon input">
							<i class="big file outline icon" v-bind:class="editedFile.icon"></i>
							<input type="text" v-model="editedFile.icon">
						</div>
					</div>
					<div class="eight wide field">
						<div class="ui left icon input">
							<i class="linkify icon"></i>
							<input type="text" v-model="editedFile.url">
						</div>
					</div>
					<div class="two wide field file actions">
						<span class="ui green circular tiny icon button" v-on:click="resetEditedFile()" data-inverted="" data-tooltip="zapisz plik" data-position="top right">
							<i class="check icon"></i>
						</span>
						<span class="ui red circular tiny icon button" v-on:click="deleteFile()" data-inverted="" data-tooltip="usuń plik" data-position="top right">
							<i class="close icon"></i>
						</span>
						<span class="ui primary circular tiny icon button" v-on:click="resetEditedFile()" data-inverted="" data-tooltip="zamknij okno edycji" data-position="top right">
							<i class="chevron down icon"></i>
						</span>
					</div>
				</div>
				<div class="ui grid">
					<div class="six wide column center aligned">
						<i class="active file outline big icon" v-for="icon in icons" v-bind:class="icon" v-on:click="setEditedFileIcon(icon)"></i>
					</div>
				</div>
			</div>
			<div class="ui segment relaxed list">
				<table class="ui very basic celled table">
					<thead>
						<tr>
							<th>#</th>
							<th>temat zajęć</th>
							<th>pliki</th>
							<th class="collapsing right aligned">akcje</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="topic in dataset">
							<td class="collapsing field">
								<div class="ui left icon input">
									<i class="hashtag icon"></i>
									<input type="text" v-model="topic.no" class="topic no input">
								</div>
							</td>
							<td class="field">
								<div class="ui left icon input">
									<i class="align left icon"></i>
									<input type="text" v-model="topic.title">
								</div>
							</td>
							<td>
								<span data-inverted="" data-tooltip="edytuj plik" data-position="top right">
									<i class="active big file outline icon" v-for="file in topic.files" v-bind:class="[{ huge: editedFile && editedFile.id == file.id }, file.icon]" v-on:click="editFile(file)"></i>
								</span>
								<span class="ui green circular tiny icon button" v-on:click="addFile(topic)" data-inverted="" data-tooltip="dodaj nowy plik" data-position="top right">
									<i class="plus icon"></i>
								</span>
							</td>
							<td class="single line">
								<span class="ui red circular tiny icon button" data-inverted="" data-tooltip="usuń temat" data-position="top right">
									<i class="close icon"></i>
								</span>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="ui dimmer">
					<div class="content">
						<h2 class="ui inverted icon header">
							<i class="sync loading icon"></i>
						</h2>
					</div>
				</div>
			</div>
			<div class="ui secondary clearing segment">
				<span class="ui green right floated button" v-on:click="addNewTopic()">Dodaj nowy temat</span>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				icons: [
					"",
					"red pdf",
					"green code",
					"yellow archive",
					"teal image",
					"brown audio",
					"violet video",
					"blue word",
					"orange powerpoint",
				],
				editedFile: null,
				searchPhrase: "",
			}
		},
		computed: {
			dataset: function() {
				return this.value
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
			addFile: function(topic) {
				let file = {
					id: "",
					icon: "",
					url: "",
				}

				topic.files.push(file)
				this.editedFile = file
			},
			editFile: function(file) {
				this.editedFile = file
			},
			setEditedFileIcon(icon) {
				this.editedFile.icon = icon
			},
			addNewTopic: function() {
				this.$http.post("management/topics", { course: this.$route.params.id }).then(function(response) {
					console.log("success")
				})
			},
			deleteFile: function() {
				this.editedFile = null
			},
			resetEditedFile: function() {
				this.editedFile = null
			}
		}
	}
</script>

<style lang="scss" scoped>
	.flip-list-move {
		transition: transform 1s;
	}

	.topic.no.input {
		width: 84px !important;
	}

	.fields .big.icon {
		margin-left: -.66em !important;
	}

	.active {
		cursor: pointer;
	}

	.file.actions span {
		margin: .25em !important;
	}
</style>