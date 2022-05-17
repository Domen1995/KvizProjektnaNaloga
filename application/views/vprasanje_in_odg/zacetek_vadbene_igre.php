<style>
	body{
		background-image: url('<?php echo base_url(); ?>/slike/test-results-in-school-picture-id529206743.jpg');
		background-size: cover;
	}
</style>

<div class="beloOzadje">
<h3><span style="background-color: white; padding:15px">Tule vaši odgovori ne bodo vplivali na točke ter vas uvrstili na rang listo, tudi če ste prijavljeni.</span></h3>
<p><span style="background-color: white; padding: 15px">Izberite želeno področje vprašanja: </span></p>

<ul id="podrocjaVpr">
	<li><a id="podrocjaLevo" href="<?php echo site_url('Vadbena/random_question_podrocja/Knjizevnost_tekstovni'); ?>">Književnost</a></li>
	<li><a href="<?php echo site_url('Vadbena/random_question_podrocja/Zgodovina_tekstovni'); ?>">Zgodovina</a></li>
	<li><a href="<?php echo site_url('Vadbena/random_question_podrocja/Zabava_tekstovni'); ?>">Zabava</a></li>
	<li><a id="podrocjaDesno" href="<?php echo site_url('Vadbena/random_question_podrocja/Geografija_tekstovni'); ?>">Geografija/znanost</a></li>
</ul>
</div>