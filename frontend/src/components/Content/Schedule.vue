<template>
	<div id="schedule">
		<h1>Plan zajęć</h1>

		<button class="ui right floated button">tydzień nieparzysty</button>
		<button class="ui disabled primary right floated button">tydzień parzysty</button>

		<div class="ui schedule divided grid">
			<div class="five column center aligned row">
				<div class="day column" v-for="day in days">
					<div class="ui relaxed divided list">
						<div class="item">
							<span class="ui basic fluid disabled button">{{ day.name }}</span>
						</div>
						<div class="item slot" v-for="(slot, index) in day.slots" v-bind:class="[slot ? slot.type : 'blank', { collapsed: slots[index].collapsed }]">
							<span class="time">{{ slots[index].time }}</span>
							<span class="name" v-if="slot">{{ slot.name }}</span>
							<span class="group" v-if="slot">{{ slot.group }}</span>
							<span class="place" v-if="slot">{{ slot.place }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="ui info icon message">
			<i class="question circle icon"></i>
			<div class="content">
				<div class="header">
					Dokładny plan znajdziesz na stronie uczelni.
				</div>
				<p>
					Powyższy plan to jedynie schemat ramowy zajęć. Dokładny plan - uwzględniający zamiany zajęć, godziny rektorskie i święta - znajdziesz na <strong><a href="http://www.plan.pwsz.legnica.edu.pl/checkNauczycielAll.php?pracownik=10377&wydzial=1" target="_blank">stronie uczelni</a></strong>.
				</p>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				days: [],
				slots: [
					{ time: "08:15", collapsed: false }, 
					{ time: "10:00", collapsed: false }, 
					{ time: "11:45", collapsed: false }, 
					{ time: "13:30", collapsed: false }, 
					{ time: "15:15", collapsed: false }, 
					{ time: "17:00", collapsed: false }, 
					{ time: "18:45", collapsed: false }, 
					{ time: "20:30", collapsed: false }
				],
			}
		},
		mounted: function() {
			this.fetchData()
			this.recognizeEmptyRows()
		},
		methods: {
			fetchData() {
				this.days = [
					{
						name: "poniedziałek",
						slots: [null, null, null, null, { name: "PPSI1", group: "s2PAM1", place: "C/125", type: "lecture" }, { name: "PPSI1", group: "s2PAM1(2)", place: "C/222", type: "project" }, { name: "PPSI1", group: "s2PAM1(1)", place: "C/222", type: "project" }, null],
					},
					{
						name: "wtorek",
						slots: [null, null, null, null, null, { name: "PPO2", group: "s2PAM1(2)", place: "C/10", type: "laboratory" }, { name: "PPO2", group: "s2PAM1(1)", place: "C/10", type: "laboratory" }, null],
					},
					{
						name: "środa",
						slots: [null, null, null, null, null, null, null, null],
					},
					{
						name: "czwartek",
						slots: [null, null, null, null, null, null, null, null],
					},
					{
						name: "piątek",
						slots: [null, null, null, null, null, null, null, null],
					},
				]
			},
			recognizeEmptyRows() {
				for(let slot in this.slots) {
					let filled = false

					for(let day of this.days) {
						if(day.slots[slot] !== null) {
							filled = true
							break
						}
					}

					if(!filled) {
						this.slots[slot].collapsed = true
					}
				}
			}
		}
	}
</script>

<style lang="scss" scoped>
	.schedule {
		margin-top: 1em;
		clear: both;

		.button {
			opacity: .75 !important;
			transition: opacity .5s;
		}

		.slot {
			min-height: 100px;
			position: relative;
			display: flex;
			align-items: center;
			justify-content: center;
			margin: .5em auto;

			&.collapsed { min-height: 40px; }
			&:not(.blank) { border-right: 1em solid rgba(Black, .15); }

			&.lecture { background: rgba(Red, .5); }
			&.exercises { background: rgba(Lime, .5); }
			&.laboratory { background: rgba(DodgerBlue, .5); }
			&.project { background: rgba(Yellow, .5); }

			.time {
				position: absolute;
				top: 5px;
				left: 5px;
				opacity: .25;
				transition: opacity .5s;
			}

			.name {
				font-weight: bold;
			}

			.group {
				position: absolute;
				top: 5px;
				right: 5px;
				opacity: .75;
			}

			.place {
				position: absolute;
				bottom: 5px;
				right: 5px;
				opacity: .75;
			}
		}
	}

	.right.button { margin-bottom: 1em; }

	.day:hover {
		.button {
			opacity: 1 !important;
			transition: opacity .5s;
		}

		.time {
			opacity: .75;
			transition: opacity .5s;
		}
	}

	.message {
		margin-top: 3em;
	}
</style>