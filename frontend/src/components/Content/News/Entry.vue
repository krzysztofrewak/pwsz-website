<template>
	<div v-if="!fetching">
		<div class="ui piled segments">
			<div class="ui entry title secondary segment">
				<span class="ui medium header">{{ entry.title }}</span>
			</div>
			<div class="ui segment" v-html="entry.content">
			</div>
		</div>

		<div class="ui relaxed horizontal list">
			<div class="item">
				<i class="large user middle aligned icon"></i>
				<div class="content">
					<span class="header">autor</span>
					<div class="description">{{ entry.author }}</div>
				</div>
			</div>
			<div class="item">
				<i class="large calendar middle aligned icon"></i>
				<div class="content">
					<span class="header">dodano</span>
					<div class="description">{{ entry.publication }}</div>
				</div>
			</div>
			<div class="item">
				<i class="large clock middle aligned icon"></i>
				<div class="content">
					<span class="header">data publikacji</span>
					<div class="description">{{ entry.timestamp }}</div>
				</div>
			</div>
			<div class="item" v-if="authenticated">
				<router-link class="ui green circular icon button" :to="{ name: 'dashboard.news.form', params: { id: entry.id } }">
					<i class="pencil icon"></i>
				</router-link>
				<div class="content">
					<span class="header">edytuj</span>
					<div class="description">id: {{ entry.id }}</div>
				</div>
			</div>
		</div>
	</div>
	<div class="ui" v-else>
		<div class="ui active inverted dimmer">
			<div class="ui loader"></div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				fetching: true,
				entry: null,
			}
		},
		created() {
			this.fetchInitialData()
		},
		methods: {
			fetchInitialData() {
				this.$http.get("news/" + this.$route.params.id).then(response => {
					this.entry = response.data.data
					this.fetching = false
				}).catch(error => {
					this.$router.replace({ name: "not-found" })
				})
			},
		},
	}
</script>

<style scoped>
	.segments {
		margin-bottom: 1.5em !important;
	}

	.list {
		float: right;
	}
</style>