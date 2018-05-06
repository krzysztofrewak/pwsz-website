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
						<span class="ui green circular tiny icon button" v-on:click="saveFile(editedTopic, editedFile)" data-inverted="" data-tooltip="zapisz plik" data-position="top right">
							<i class="check icon"></i>
						</span>
						<span class="ui red circular tiny icon button" v-on:click="deleteFile(editedTopic, editedFile)" data-inverted="" data-tooltip="usuń plik" data-position="top right">
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
						<tr v-for="topic in topics">
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
									<i class="active big file outline icon" v-for="file in topic.files" v-bind:class="[{ huge: editedFile && editedFile.id == file.id }, file.icon]" v-on:click="editFile(topic, file)"></i>
								</span>
								<span class="ui green circular tiny icon button" v-on:click="addFile(topic)" data-inverted="" data-tooltip="dodaj nowy plik" data-position="top right">
									<i class="plus icon"></i>
								</span>
							</td>
							<td class="single line">
								<span class="ui green circular tiny icon button" v-on:click="saveTopic(topic)" data-inverted="" data-tooltip="zmień temat" data-position="top right">
									<i class="check icon"></i>
								</span>
								<span class="ui red circular tiny icon button" v-on:click="deleteTopic(topic)" data-inverted="" data-tooltip="usuń temat" data-position="top right">
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
				editedTopic: null,
				topics: [],
			}
		},
		computed: {
			count: function() {
				return this.topics.length
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
		mounted() {
			this.topics = this.value
		},
		methods: {
			getNewTopic: function() {
				return {
					title: "Nowy temat",
					no: "X",
					course_id: this.$route.params.id
				}
			},
			addNewTopic: function() {
				this.$http.post("management", { repository: "courseTopics", request: this.getNewTopic() }).then(response => {
					let topic = response.data.data
					topic.files = []
					this.topics.push(topic)
					this.notifySuccess("Dodano nowy temat.")
				}).catch(error => {
					this.notifyError("Wystąpił błąd.")
				})
			},
			saveTopic: function(t) {
				let topic = JSON.parse(JSON.stringify(t))
				delete topic.files

				this.$http.post("management", { repository: "courseTopics", request: topic }).then(response => {
					this.notifySuccess("Zmieniono temat.")
				}).catch(error => {
					this.notifyError("Wystąpił błąd.")
				})
			},
			deleteTopic: function(topic) {
				this.$http.delete("management/coursetopics/" + topic.id).then(function(response) {
					this.notifySuccess("Usunięto temat.")
					this.topics = this.topics.filter(t => t.id != topic.id)
				})
			},

			getNewFile: function(topicId) {
				return {
					id: "",
					icon: "black",
					url: "/",
					course_topic_id: topicId,
				}
			},
			addFile: function(topic) {
				this.$http.post("management", { repository: "courseTopicFiles", request: this.getNewFile(topic.id) }).then(response => {
					let file = response.data.data
					topic.files.push(file)
					this.editFile(topic, file)
					this.notifySuccess("Dodano nowy temat.")
				}).catch(error => {
					this.notifyError("Wystąpił błąd.")
				})
			},
			editFile: function(topic, file) {
				this.editedTopic = topic
				this.editedFile = file
			},
			saveFile: function(topic, file) {
				this.$http.post("management", { repository: "courseTopicFiles", request: file }).then(response => {
					this.notifySuccess("Zmodyfikowano plik.")
				}).catch(error => {
					this.notifyError("Wystąpił błąd.")
				})
			},
			deleteFile: function(topic, file) {
				this.$http.delete("management/coursetopicfiles/" + file.id).then(function(response) {
					this.notifySuccess("Usunięto plik.")
					topic.files = topic.files.filter(f => f.id != file.id)
				}).catch(error => {
					this.notifyError("Wystąpił błąd.")
				})
			},
			resetEditedFile: function() {
				this.editedFile = null
			},
			setEditedFileIcon(icon) {
				this.editedFile.icon = icon
			},
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