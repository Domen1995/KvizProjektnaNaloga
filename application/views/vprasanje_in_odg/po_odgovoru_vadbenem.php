<style>
	body{
		background-image: url('<?php echo base_url(); ?>/slike/test-results-in-school-picture-id529206743.jpg');
		background-size: cover;
	}
</style>

<div class="beloOzadje">
<p> <?php echo "<span style='background-color: white; padding:0px'>Pravilni odgovor: ";
		  echo $odgovorPravilni."</span><br>";
		  echo "<span style='background-color: white'>Vaš odgovor: ";
		  echo $odgovorIgralca;
		  echo "</span>"
?> 
</p>
<p> <?php echo "<span style='background-color: white; padding:0px'>Pravilnost odgovora: "; 
		  echo $pravilnostTekstovnegaOdg; 
		  echo "%.</span><br>";
		  echo "<span style='background-color: white; padding:0px'>Čas: ";
		  echo $hitrostOdgovora;
		  echo " sekund.</span><br>";
		  echo "<span style='background-color: white; padding-bottom:5px'>Točke odgovora: ";
		  echo $pravilnostTeksUpostevajocCas."%.</span>";
		  ?></p>

<p><span style="background-color: white; padding:5px"> Izberite želeno področje naslednjega vprašanja:</span></p>

<ul id="podrocjaVpr">
	<li><a id="podrocjaLevo" href="<?php echo site_url('Vadbena/random_question_podrocja/Knjizevnost_tekstovni'); ?>">Književnost</a></li>
	<li><a href="<?php echo site_url('Vadbena/random_question_podrocja/Zgodovina_tekstovni'); ?>">Zgodovina</a></li>
	<li><a href="<?php echo site_url('Vadbena/random_question_podrocja/Zabava_tekstovni'); ?>">Zabava</a></li>
	<li><a id="podrocjaDesno" href="<?php echo site_url('Vadbena/random_question_podrocja/Geografija_tekstovni'); ?>">Geografija/znanost</a></li>
</ul>
</div>