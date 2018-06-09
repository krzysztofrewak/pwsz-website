<template>
	<div>
		<div class="student grades" v-if="grades.students">
			<h2 class="ui header">
				Arkusz ocen i obecności
				<div class="sub header">
					Numery indeksów innych studentów są zaciemnione z prawnych względów
				</div>
			</h2>

			<table class="ui very basic celled very compact unstackable table">
				<thead>
				<tr class="center aligned">
					<th class="one wide single line">student</th>
					<th v-for="studentClass in grades.classes">{{ studentClass.name }}</th>
				</tr>
				</thead>
				<tbody>
				<tr class="student row" v-for="student in grades.students" v-bind:class="{ inactive: !student.student }">
					<td class="student number">{{ student.student }}</td>
					<td v-for="grade in student.classes" class="student grade" v-bind:class="{ present: grade.present == true, absent: grade.present == false }">
						{{ grade.value }}
					</td>
				</tr>
				</tbody>
			</table>

			<h3>Legenda:</h3>
			<div class="legend">
				<div class="item">
					<div class="student grade present">&nbsp;</div>
					<div class="content">student obecny lub ocena pozytywna</div>
				</div>
				<div class="item">
					<div class="student grade absent">&nbsp;</div>
					<div class="content">student nieobecny lub ocena niedostateczna</div>
				</div>
			</div>
		</div>

		<div class="ui negative icon message" v-else>
			<i class="warning circle icon"></i>
			<div class="content">
				<div class="header">
					Niestety nic nie znaleziono.
				</div>
				<p>
					Dla podanej kombinacji identyfikatorów semestru, kursu i numeru indeksu nie odnaleziono żadnych danych. Sprawdź poprawność podanych informacji. Jeżeli semestr dopiero się rozpoczął, może po prostu jeszcze niczego tu nie ma.
				</p>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		props: {
			grades: { type: Object }
		}
	}
</script>

<style lang="scss" scoped>

	.student.row {
		height: 2em;
	}

	.student.number {
		text-align: center;
		font-weight: bold;
	}

	.student.grades {
		margin-top: 1em;
		overflow-x: auto;

		tr td:last-child { font-weight: bold; width: 10%; }

		h2 {
			margin-top: 1em;
			margin-bottom: 1em;
		}

		.student.grade {
			text-align: center;
		}

		.student.grade.absent {
			background: #F08080;
		}

		.student.grade.present {
			background: #DAF7A6;
		}

		.legend {
			.item {
				display: inline;
				margin: .25em;
			}

			.student {
				width: 2em;
				height: 2em;
				line-height: 2em;
				text-align: center;
				display: inline-block;
			}

			.content {
				display: inline-block;
				padding-left: .5em;
			}
		}
	}
</style>
