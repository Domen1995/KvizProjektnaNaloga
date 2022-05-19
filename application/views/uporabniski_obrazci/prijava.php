<?php
	if(isset($neveljavniPodatki))
	{
		?> <h2 style="color: grey; text-align: center; font-family: tahoma"> <?php echo $neveljavniPodatki; ?> </h2>
	<?php }
?>

<div id="prijava">
<form action="https://www.studenti.famnit.upr.si/~89181150/Kviz/CodeIgniter/index.php/uporabniki/prijavi" method="post" accept-charset="utf-8">
<label><span>Vaš vzdevek: </span></label><br><input class="uporabniskiPodatki" type="text" name="vzdevek" value=""  />
<br>
<label><span>Vaše geslo: </span></label>
	<br><input class="uporabniskiPodatki" type="password" name="geslo" value=""  />
<br><br>
<input id="gumbOddajVpr" type="submit" name="submit" value="Prijavi me!"  />
</form></div>