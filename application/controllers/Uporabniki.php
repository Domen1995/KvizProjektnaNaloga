<?php

class Uporabniki extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('uporabniki_model');
		$this->load->model('Baza_vprasanj');  // Samo za izbris vseh odg na uporabnikovo željo
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function pokazi_obrazec_registracija()
	{
		$headerData['zavihek'] = "registracija";
		$this->load->view('header', $headerData);
		$this->load->view('uporabniski_obrazci/registracija');
		$this->load->view('footer');
	}

	public function registriraj()
	{
		$headerData['zavihek'] = "registracija";

		$this->form_validation->set_rules('vzdevek', 'Vzdevek', 'required');
		$this->form_validation->set_rules('geslo', 'Geslo', 'required');
		$this->form_validation->set_rules('enaslov', 'Enaslov', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$data['neveljavniPodatki'] = "Neveljavni podatki! Poskusite ponovno ...";
			$this->load->view('header', $headerData);
			$this->load->view('uporabniski_obrazci/registracija', $data);
			$this->load->view('footer');
		}else
		{
			$data = array(
				'vzdevek' => $this->input->post('vzdevek'),
				'geslo' => $this->input->post('geslo'),
				'eposta' => $this->input->post('enaslov')
			);
			if($this->vsebujeBeginTag($data['vzdevek']) || $this->vsebujeBeginTag($data['geslo'])|| $this->vsebujeBeginTag($data['eposta']))
			{
				$data['neveljavenEnaslov'] = "Nobeden od vnosov ne sme vsebovati simbola '<'"; // neveljaven tag <
				$this->load->view('header', $headerData);
				$this->load->view('uporabniski_obrazci/registracija', $data);
				$this->load->view('footer');
			}
			elseif(!$this->eNaslovVeljaven($data['eposta']))
			{
				$data['neveljavenEnaslov'] = "Vnesite SVOJ e-naslov!!!";
				$this->load->view('header', $headerData);
				$this->load->view('uporabniski_obrazci/registracija', $data);
				$this->load->view('footer');
			}elseif(strlen($data['vzdevek'])>30 || strlen($data['geslo'])>30 || strlen($data['eposta'])>38)
			{
				$data['neveljavenEnaslov'] = "Prekoračeno število znakov v vaših podatkih!!!";
				$this->load->view('header', $headerData);
				$this->load->view('uporabniski_obrazci/registracija', $data);
				$this->load->view('footer');
			}else{
				$registracijaUspela = $this->uporabniki_model->vnesi_registracijo($data);
				if($registracijaUspela)
				{
					$headerData['zavihek'] = "prijava";
					$ravnoRegistriran['ravnokarRegistriran'] = "S temi podatki se odslej, začenši zdaj, prijavljajte: ";
					$this->load->view('header', $headerData);
					$this->load->view('uporabniski_obrazci/prijava', $ravnoRegistriran);
					$this->load->view('footer');
				}else{
					$headerData['zavihek'] = "registracija";
					$data['neveljavniPodatki'] = "Vnesli ste podatke že obstoječega uporabnika!";
					$this->load->view('header', $headerData);
					$this->load->view('uporabniski_obrazci/registracija', $data);
					$this->load->view('footer');
				}
			}
		}
	}

	public function eNaslovVeljaven($eNaslov)
	{
		$i=0;
		for(; $i<strlen($eNaslov); $i++){
			if(substr($eNaslov, $i, 1)=="@"){
		    	break;
		    }
		}
		if($i>strlen($eNaslov)-6)
		{
			return false;
		}
		return true;
	}

	public function pokazi_obrazec_prijava()
	{
		$headerData['zavihek'] = "prijava";
		$this->load->view('header', $headerData);
		$this->load->view('uporabniski_obrazci/prijava');
		$this->load->view('footer');
	}

	public function prijavi()
	{
		$headerData['zavihek'] = "prijava";

		$this->form_validation->set_rules('vzdevek', 'Vzdevek', 'required');
		$this->form_validation->set_rules('geslo', 'Geslo', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$data['neveljavniPodatki'] = "Neveljavni podatki! Poskusite ponovno ...";
			$this->load->view('header', $headerData);
			$this->load->view('uporabniski_obrazci/prijava', $data);
			$this->load->view('footer');
		}else{
			$data = array(
				'vzdevek' => $this->input->post('vzdevek'),
				'geslo' => $this->input->post('geslo')
			);
			if($this->uporabniki_model->preveri_podatke_prijave($data))
			{
				$this->session->set_userdata('prijavljen', $data);
				$_SESSION['vzdevek'] = $data['vzdevek'];
				$this->zacetek_igre();
			}else
			{
				$data['neveljavniPodatki'] = "Neveljavni podatki! Poskusite ponovno ...";
				$this->load->view('header', $headerData);
				$this->load->view('uporabniski_obrazci/prijava', $data);
				$this->load->view('footer');
			}
		}
	}

	public function odjavi()
	{
		$userdata = array(
			'vzdevek' => ''
		);
		$this->session->unset_userdata('prijavljen', $userdata);
		$headerData['zavihek'] = "odjava";
		$this->load->view('header', $headerData);
		$this->load->view('footer');
	}

	public function zacetek_igre()
	{
		$headerData['zavihek'] = "tockovanaVpr";
		$this->load->view('header', $headerData);
		$this->load->view('vprasanje_in_odg/zacetek_igre');
		$this->load->view('footer');
	}

	public function resetirajMiTockeSvarilo()
	{
		$headerData['zavihek'] = "resetiranjeTock";
		$this->load->view('header', $headerData);
		$this->load->view('uporabniski_obrazci/resetiranje_tock_obrazec');
		$this->load->view('footer');
	}

	public function resetTock()
	{
		$this->Baza_vprasanj->izbrisiVseOdgUporabnika();
		$data['vsiOdgIzbrisani'] = "Vaši dosedanji odgovori so izbrisani. V vnovičnem poskusu pa gremo do perfekcije!";
		$headerData['zavihek'] = "resetiranjeTock";
		$this->load->view('header', $headerData);
		$this->load->view('pages/home', $data);
		$this->load->view('footer');
	}

	public function vsebujeBeginTag($niz)
	{
		for($i=0;$i<strlen($niz); $i++)
		{
			if(substr($niz, $i, 1) == "<")
			{
				return true;
			}
		}
		return false;
	}
}

?>