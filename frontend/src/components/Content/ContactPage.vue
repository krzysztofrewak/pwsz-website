<template>
	<div>
		<h1>Kontakt</h1>
		
		<h3 class="ui header">
			<i class="envelope icon"></i>
			<div class="content">
				<div class="sub header">adres email</div>
				{{ local }}@{{ domain }}
			</div>
		</h3>

		<div v-if="showConsultations">
			<div class="ui horizontal divider">
				lub
			</div>
			
			<h3 class="ui header">
				<i class="calendar icon"></i>
				<div class="content">
					<div class="sub header">konsultacje</div>
					terminarz konsultacji na semestr zimowy 2017/18
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
					<tr class="inactive">
						<td>23 października 2017</td>
						<td>14<sup>15</sup>-15<sup>15</sup></td>
						<td>A356</td>
					</tr>
					<tr>
						<td>30 października 2017</td>
						<td>14<sup>15</sup>-15<sup>15</sup></td>
						<td>A356</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				local: "RewakK",
				domain: "pwsz.legnica.edu.pl",
				showConsultations: false,
			}
		},
	} 
</script>

<style>
	.consultations.table {
		padding-left: 3em;
	}
</style>
