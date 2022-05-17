<style>
	body{
		background-image: url('<?php echo base_url(); ?>/slike/test-results-in-school-picture-id529206743.jpg');
		background-size: cover;
	}
</style>
<div>

<!--<h2>Pazite! Ob zvitem poskusu vrnitve na predhodno vprašanje se bodo vaše skupne točke sfižile!</h2> -->

<?php
//$data['vprasanjeInOdg'] = "bla";
echo validation_errors();
echo form_open('vadbena/fetch_answer/'.$vprasanjeIdOdg['sifra']);
echo "<div>";
echo $vprasanjeIdOdg['Vprasanje']; 
echo "</div>";
echo "<p>";
echo form_input('answer');
echo "</p>";
echo form_submit('submit', 'Oddaj odgovor!');
echo form_close();
?>

<h2 id="trenutniCas">-1</h2>
<script>
function casovnik(){
	let trenutniCas = document.getElementById("trenutniCas").innerHTML;
	trenutniCas++;
	document.getElementById("trenutniCas").innerHTML = trenutniCas;
	setTimeout(casovnik, 1000);
}

casovnik();

</script>
</div>