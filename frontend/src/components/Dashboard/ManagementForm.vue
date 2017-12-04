<template>
	<div>
		<h1>Edytujesz kierunek/specjalność: {{ name }}</h1>

		<form class="ui form">
			<div class="field">
				<label>Pełna nazwa</label>
				<input placeholder="Pełna nazwa" type="text" value="Informatyka">
			</div>

			<div class="field">
				<label>Skrócona nazwa</label>
				<input placeholder="Skrót" type="text" value="INF">
			</div>

			<div class="field">
				<label>Opcje</label>
				<div class="ui fluid buttons">
					<router-link class="ui button" :to="{ name: repository }">Anuluj</router-link>
					 <div class="or" data-text="||"></div>
					<button class="ui positive button" type="submit">Zapisz</button>
				</div>
			</div>

			
		</form>
	</div>
</template>

<script type="text/javascript">
	export default {
		data() {
			return {
				name: "Informatyka",
				repository: "fields"
			}
		},
	}
</script>
