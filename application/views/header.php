<!DOCTYPE html>
<html>
<head>
	<title>Kviz</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/style.css">
</head>
	<body>
		<ul id="headerMenu">
			<?php if(isset($zavihek) && $zavihek=="rangLista") { ?>
				<li><a id ="meniLevo" style="background-color: rgb(100,0,0); color: darkgrey" href="<?php echo site_url('Ranking/vsiRazlicniVzdevki'); ?>">Rang lista</a></li>
			<?php }else{ ?>
				<li><a id ="meniLevo" href="<?php echo site_url('Ranking/vsiRazlicniVzdevki'); ?>">Rang lista</a></li>
			<?php } if(isset($zavihek) && $zavihek=="vadbenaIgra"){ ?>
				<li><a style="background-color: rgb(100,0,0); color: darkgrey" href="<?php echo site_url('Vadbena/zacetek') ?>">Vadbena igra</a></li>
			<?php }else{ ?>
				<li><a href="<?php echo site_url('Vadbena/zacetek') ?>">Vadbena igra</a></li>
			<?php } ?>
		<?php if(isset($this->session->userdata['prijavljen']))	
				{ ?>
					<?php if(isset($zavihek) && $zavihek=="tockovanaVpr") { ?>
						<li><a style="background-color: rgb(100,0,0); color: darkgrey" href="<?php echo site_url('Uporabniki/zacetek_igre'); ?>">Točkovana vprašanja</a></li>
					<?php }else{ ?>
						<li><a href="<?php echo site_url('Uporabniki/zacetek_igre'); ?>">Točkovana vprašanja</a></li>
					<?php } if(isset($zavihek) && $zavihek=="mojeTocke"){ ?>
						<li><a style="background-color: rgb(100,0,0); color: darkgrey" href="<?php echo site_url('Ranking/moje_tocke'); ?>">Moje točke</a></li>
					<?php }else{ ?>
						<li><a href="<?php echo site_url('Ranking/moje_tocke'); ?>">Moje točke</a></li>
					<?php } if(isset($zavihek) && $zavihek=="resetiranjeTock") { ?>
						<li><a style="background-color: rgb(100,0,0); color: darkgrey" href="<?php echo site_url('Uporabniki/resetirajMiTockeSvarilo'); ?>">Ponastavitev točk</a></li>
					<?php }else{ ?>
						<li><a href="<?php echo site_url('Uporabniki/resetirajMiTockeSvarilo'); ?>">Ponastavitev točk</a></li>
					<?php } if(isset($zavihek) && $zavihek=="odjava"){ ?>
						<li><a style="background-color: rgb(100,0,0); color: darkgrey" id="meniDesno" href="<?php echo site_url('Uporabniki/odjavi'); ?>">Odjava</a></li>
					<?php }else{ ?>
						<li><a id="meniDesno" href="<?php echo site_url('Uporabniki/odjavi'); ?>">Odjava</a></li>
					<?php } ?>
		<?php } else{ ?>
					<?php if(isset($zavihek) && $zavihek=="registracija"){ ?>
						<li><a style="background-color: rgb(100,0,0); color: darkgrey" href="<?php echo site_url('Uporabniki/pokazi_obrazec_registracija'); ?>">Registracija</a></li>
					<?php }else{ ?>
						<li><a href="<?php echo site_url('Uporabniki/pokazi_obrazec_registracija'); ?>">Registracija</a></li>
					<?php } if(isset($zavihek) && $zavihek=="prijava"){ ?>
						<li><a style="background-color: rgb(100,0,0); color: darkgrey" id="meniDesno" href="<?php echo site_url('Uporabniki/pokazi_obrazec_prijava'); ?>">Prijava</a></li>
					<?php }else{ ?>
						<li><a id="meniDesno" href="<?php echo site_url('Uporabniki/pokazi_obrazec_prijava'); ?>">Prijava</a></li>
					<?php } ?>
		<?php } ?>
		</ul>
		<br><br><br><br><br>