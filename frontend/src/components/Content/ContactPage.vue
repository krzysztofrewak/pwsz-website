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
		
		<h3 class="ui header">
			<i class="user icon"></i>
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
					<td>2 października 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
				<tr class="inactive">
					<td>9 października 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
				<tr class="inactive">
					<td>16 października 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
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
				<tr>
					<td>6 listopada 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
				<tr>
					<td>13 listopada 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
				<tr>
					<td>20 listopada 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
				<tr>
					<td>27 listopada 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
				<tr>
					<td>4 grudnia 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
				<tr>
					<td>11 grudnia 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
				<tr>
					<td>18 grudnia 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
				<tr>
					<td>8 stycznia 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
				<tr>
					<td>15 stycznia 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
				<tr>
					<td>22 stycznia 2017</td>
					<td>14<sup>15</sup>-15<sup>15</sup></td>
					<td>A356</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				local: "RewakK",
				domain: "pwsz.legnica.edu.pl",
			}
		},
	} 
</script>

<style>
	.consultations.table {
		padding-left: 3em;
	}
</style>
