<br>
<?php
	if(isset($neveljavenEnaslov))
	{
		?> <h2 style="color: grey; text-align: center; font-family: tahoma"> <?php echo $neveljavenEnaslov; ?> </h2>
	<?php } elseif(isset($neveljavniPodatki))
	{
		?> <h2 style="color: grey; text-align: center; font-family: tahoma"> <?php echo $neveljavniPodatki; ?> </h2>
	<?php }
?>
<div id="prijava">
<form action="https://www.studenti.famnit.upr.si/~89181150/Kviz/CodeIgniter/index.php/Uporabniki/registriraj" method="post" accept-charset="utf-8">
<label><span>Vaš bodoči vzdevek (max 30 znakov): </span></label><br><input type="text" name="vzdevek" value=""  />
<br><br><label><span>Domislite se še gesla (max 30 znakov): </span></label><br><input type="password" name="geslo" value=""  />
<br><br><label><span>Pa nam zaupajte še svoj e-naslov (max 38 znakov): </span></label><br><input type="text" name="enaslov" value=""  />
<br><br><input id="gumbOddajVpr" type="submit" name="submit" value="Registracija!"  />
</form></div>