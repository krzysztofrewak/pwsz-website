<template>
	<div>
		<h3 class="ui header">
			<i class="calendar icon"></i>
			<div class="content">
				<div class="sub header">konsultacje</div>
				terminarz konsultacji na semestr letni 2017/18
			</div>
		</h3>

		<table class="ui very basic very compact consultations table">
			<thead>
				<tr>
					<th>data</th>
					<th>godzina</th>
					<th>sala</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="consultation in consultations" v-bind:class="{ inactive: !consultation.active }">
					<td>{{ consultation.date }}</td>
					<td v-html="consultation.time"></td>
					<td>{{ consultation.place }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				consultations: [
					{
						date: "19 kwietnia 2018",
						time: "14<sup>15</sup>-15<sup>15</sup>",
						place: "A/356",
						active: false,
					},
					{
						date: "26 kwietnia 2018",
						time: "14<sup>45</sup>-15<sup>15</sup>",
						place: "A/356",
						active: false,
					},
					{
						date: "10 maja 2018",
						time: "14<sup>45</sup>-15<sup>15</sup>",
						place: "A/356",
						active: true,
					},
					{
						date: "17 maja 2018",
						time: "14<sup>45</sup>-15<sup>15</sup>",
						place: "A/356",
						active: true,
					},
					{
						date: "24 maja 2018",
						time: "14<sup>45</sup>-15<sup>15</sup>",
						place: "A/356",
						active: true,
					},
					{
						date: "7 czerwca 2018",
						time: "14<sup>45</sup>-15<sup>15</sup>",
						place: "A/356",
						active: true,
					},
					{
						date: "14 czerwca 2018",
						time: "14<sup>45</sup>-15<sup>15</sup>",
						place: "A/356",
						active: true,
					},
				],
			}
		},
	} 
</script>

<style>
	.consultations.table {
		padding-left: 3em;
	}
</style>
