<style>
	body{
		background-image: url('<?php echo base_url(); ?>/slike/test-results-in-school-picture-id529206743.jpg');
		background-size: cover;
	}
</style>

<div class="beloOzadje">
<p> <?php echo "Pravilni odgovor: ";
		  echo $odgovorPravilni."<br>";
		  echo "Vaš odgovor: ";
		  echo $odgovorIgralca;
?> 
</p>
<p> <?php echo "Pravilnost odgovora: "; 
		  echo $pravilnostTekstovnegaOdg; 
		  echo "%.<br>";
		  echo "Čas: ";
		  echo $hitrostOdgovora;
		  echo " sekund.<br>";
		  echo "Točke odgovora: ";
		  echo $pravilnostTeksUpostevajocCas."%.";
		  ?></p>

<!--<div class="beloOzadje"> -->
<p>Izberite želeno področje naslednjega vprašanja: </p>

<ul id="podrocjaVpr">
	<li><a id="podrocjaLevo" href="<?php echo site_url('Vadbena/random_question_podrocja/Knjizevnost_tekstovni'); ?>">Književnost</a></li>
	<li><a href="<?php echo site_url('Vadbena/random_question_podrocja/Zgodovina_tekstovni'); ?>">Zgodovina</a></li>
	<li><a href="<?php echo site_url('Vadbena/random_question_podrocja/Zabava_tekstovni'); ?>">Zabava</a></li>
	<li><a id="podrocjaDesno" href="<?php echo site_url('Vadbena/random_question_podrocja/Geografija_tekstovni'); ?>">Geografija/znanost</a></li>
</ul>
</div>