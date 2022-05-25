<?php

class Vprasanja extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Baza_vprasanj');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library("form_validation");
	}

	public function random_question()
	{
		$indeksPredzadnjegaVprasanja = $this->preveriZadnjeVprasanje();
		if($indeksPredzadnjegaVprasanja != 0)
		{
			$data['goljufija'] = "Hja, niste bili pridni ... Fiženje vaših skupnih točk je izvedeno. Nadaljujete, kot bi se znova registrirali.";
			$this->Baza_vprasanj->izbrisiVseOdgUporabnika();
			$headerData['zavihek'] = "tockovanaVpr";
			$this->load->view('header', $headerData);
			$this->load->view('footer', $data);
		}else
		{
			$podrocje = $this->nakljucno_podrocje();
			$data['vprasanjeIdOdg'] = $this->Baza_vprasanj->random_question_from_database($podrocje);
			$this->Baza_vprasanj->shrani_vpr_brez_odg($data['vprasanjeIdOdg']['Vprasanje'], $data['vprasanjeIdOdg']['Odgovor']);
			$_SESSION['t0'] = microtime(true);
			$headerData['zavihek'] = "tockovanaVpr";
			$this->load->view('header', $headerData);
			$this->load->view('vprasanje_in_odg/vprasanje_in_odgovor', $data);
			$this->load->view('footer');
		}
	}


	public function fetch_answer($sifra)
	{
		$t1 = microtime(true);
		$hitrostOdgovora = round(($t1 - $_SESSION['t0']), 2);
		$odgovorIgralca = $this->input->post('answer');
		$vprasanjeIdOdg = $this->Baza_vprasanj->question_from_database_from_sifra($sifra);
		$odgovorPravilni = $vprasanjeIdOdg['Odgovor'];
		$steviloEnakihCrk = $this->Baza_vprasanj->stevilo_enakih_crk($odgovorIgralca, $odgovorPravilni);
		$dolzinaPravilnegaOdg = strlen($odgovorPravilni);
		$pravilnostTekstovnegaOdg = $this->Baza_vprasanj->pravilnost_tekstovnega_odgovora($steviloEnakihCrk, $dolzinaPravilnegaOdg);
		$pravilnostTeksUpostevajocCas = $this->Baza_vprasanj->oceniUpostevajocCas($pravilnostTekstovnegaOdg, $hitrostOdgovora);
		$data['pravilnostTekstovnegaOdg'] = $pravilnostTekstovnegaOdg;
		$data['odgovorPravilni'] = $odgovorPravilni;
		$data['hitrostOdgovora'] = $hitrostOdgovora;
		$data['pravilnostTeksUpostevajocCas'] = $pravilnostTeksUpostevajocCas;
		$data['odgovorIgralca'] = $odgovorIgralca;
		//$this->Baza_vprasanj->shrani_odgovor($odgovorIgralca);
		$this->Baza_vprasanj->shrani_odg_k_vprasanju($odgovorIgralca, $pravilnostTekstovnegaOdg, $hitrostOdgovora, $pravilnostTeksUpostevajocCas);
		$headerData['zavihek'] = "tockovanaVpr";
		$this->load->view('header', $headerData);
		$this->load->view('vprasanje_in_odg/po_odgovoru', $data);
		$this->load->view('footer');
	}

	public function preveriZadnjeVprasanje() // PREDZADNJE!
	{
		$indeksPredzadnjegaVprasanja = $this->Baza_vprasanj->maksIdVprasanjaUporabnika() -1;
		$predzadnjeVprasanjeTekmovalca = $this->Baza_vprasanj->zadnjeVprasanje($indeksPredzadnjegaVprasanja);
		$odgovorTekmovalca = $predzadnjeVprasanjeTekmovalca['Odgovor'];
		$odgovorPravilni = $predzadnjeVprasanjeTekmovalca['pravilni_odgovor'];
		$steviloEnakihCrk = $this->Baza_vprasanj->stevilo_enakih_crk($odgovorTekmovalca, $odgovorPravilni);
		$dolzinaPravilnegaOdg = strlen($odgovorPravilni);
		$pravilnostTekstovnegaOdg = $this->Baza_vprasanj->pravilnost_tekstovnega_odgovora($steviloEnakihCrk, $dolzinaPravilnegaOdg);
		$prejZapisanaPravilnostOdgovora = $predzadnjeVprasanjeTekmovalca['procenti'];
		if($pravilnostTekstovnegaOdg == $prejZapisanaPravilnostOdgovora)
		{
			return 0;
		}else
		{
			return $indeksPredzadnjegaVprasanja;
		}
	}

	public function nakljucno_podrocje()
	{
		$enaDo4 = rand(1, 4);
		switch($enaDo4)
		{
			case 1:
				return "Knjizevnost_tekstovni";
			case 2:
				return "Zgodovina_tekstovni";
			case 3:
				return "Zabava_tekstovni";
			case 4:
				return "Geografija_tekstovni";
		}
	}
}

?>