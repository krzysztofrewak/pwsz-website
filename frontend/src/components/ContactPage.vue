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
				proszę kontaktować się poprzez email w celu umówienia terminu
			</div>
		</h3>
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
