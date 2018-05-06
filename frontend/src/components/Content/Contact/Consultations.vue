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
				<tr v-for="consultation in consultations" v-bind:class="{ inactive: new Date(consultation) < new Date() }">
					<td>{{ consultation }}</td>
					<td>14<sup>45</sup></td>
					<td>A/356</td>
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
					"2018-02-22",
					"2018-03-01",
					"2018-03-08",
					"2018-03-15",
					"2018-03-22",
					"2018-03-29",
					"2018-04-05",
					"2018-04-12",
					"2018-04-19",
					"2018-04-26",
					"2018-05-10",
					"2018-05-17",
					"2018-05-24",
					"2018-06-07",
					"2018-06-14",
				]
			}
		},
	} 
</script>

<style>
	.consultations.table {
		padding-left: 3em;
	}
</style>
