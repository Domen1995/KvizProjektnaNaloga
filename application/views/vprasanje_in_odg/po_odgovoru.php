<style>
	body{
		background-image: url('<?php echo base_url(); ?>/slike/test-results-in-school-picture-id529206743.jpg');
		background-size: cover;
	}
</style>

<div class="beloOzadje">

<p> <?php echo "<span style='background-color: white; padding:2px'>Pravilni odgovor: ";
		  echo $odgovorPravilni."</span><br>";
		  echo "<span style='background-color: white'>Vaš odgovor: ";
		  echo $odgovorIgralca;
		  echo "</span>"
?> 
</p>
<p> <?php echo "<span style='background-color: white; padding:5px'>Pravilnost odgovora: "; 
		  echo $pravilnostTekstovnegaOdg; 
		  echo "%.</span><br>";
		  echo "<span style='background-color: white; padding:2px'>Čas: ";
		  echo $hitrostOdgovora;
		  echo " sekund.</span><br>";
		  echo "<span style='background-color: white; padding:5px'>Točke odgovora: ";
		  echo $pravilnostTeksUpostevajocCas."%.</span>";
		  echo "<span style='background-color: white; padding-bottom:5px'>Sedaj lahko igro zapustite brez izgube točk!</span>";
		  ?></p>

<?php
echo form_open('vprasanja/random_question'); ?>
<input id="gumbNaslednjeVprasanje" type="submit" name="submit" value="Naslednje vprašanje!"  />
</form>
</div>