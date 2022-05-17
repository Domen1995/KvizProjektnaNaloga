<style>
	body{
		background-image: url('<?php echo base_url(); ?>/slike/test-results-in-school-picture-id529206743.jpg');
		background-size: cover;
	}
</style>
<div class="beloOzadje">
<!--<span id="ozadjeVprasanja"></span> -->
<!--<h2>Pazite! Ob zvitem poskusu vrnitve na predhodno vprašanje se bodo vaše skupne točke sfižile!</h2> -->

<?php
//$data['vprasanjeInOdg'] = "bla";
echo validation_errors();
echo form_open('vprasanja/fetch_answer/'.$vprasanjeIdOdg['sifra']);
echo "<div class='vprasanje'>";
?>
<span style="background-color: white; padding:15px">
<?php
echo $vprasanjeIdOdg['Vprasanje'];
echo "</span>"; 
echo "</div>";
echo "<p>";?>
<input id="tekstInput" type="text" name="answer" value="">
</p><input id="gumbOddajVpr" type="submit" name="submit" value="Oddaj odgovor!">
</form>

<h2> <span id="trenutniCas" style="background-color: rgb(255, 0, 0); padding: 10px">-1</span></h2>
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