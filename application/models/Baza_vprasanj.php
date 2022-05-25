<?php

class Baza_vprasanj extends CI_Model{

	public function __construct()
	{
		$this->load->database();
	}

	public function random_question_from_database($podrocje)
	{
		$this->db->select('max(id) as "stev"');
		$this->db->from($podrocje);  // tu je bilo Knjizevnost_tekstovni
		$steviloVprasanj = $this->db->get()->row_array();// row_array je 1D tabela, result_array je 2D
		$steviloVpr = intval($steviloVprasanj['stev']);
		$nakljucniIndeksVprasanja = rand(1, $steviloVpr);

		$pogoj = "id = '".$nakljucniIndeksVprasanja."'";
		$this->db->select('*');
		$this->db->from($podrocje);
		$this->db->where($pogoj);
		$vprasanje = $this->db->get();
		return $vprasanje->row_array();
	}

	public function question_from_database_from_sifra($sifra)
	{
		$prve3CrkePodrocja = substr($sifra, 0, 3);
		switch($prve3CrkePodrocja)
		{
			case "knj":
				$podrocje = "Knjizevnost_tekstovni";
				break;
			case "zgo":
				$podrocje = "Zgodovina_tekstovni";
				break;
			case "zab":
				$podrocje = "Zabava_tekstovni";
				break;
			case "geo":
				$podrocje = "Geografija_tekstovni";
		}
		$pogoj = "sifra= '".$sifra."'";
		$this->db->select('*');
		$this->db->from($podrocje);
		$this->db->where($pogoj);
		$vprasanje = $this->db->get();
		return $vprasanje->row_array();
	}

	public function shrani_odgovor($odgovor)
	{
		$data = array(
			'Odgovor' => $odgovor,
			'Vprasanje' => 'ni vazno',
			'id' => 2
		);
		$this->db->insert('Odgovori_test', $data);
	}

	public function shrani_vpr_brez_odg($vprasanje, $pravilniOdgovor)
	{
		$pogoj = "tekmovalec = '".$_SESSION['vzdevek']."'";
		$this->db->select('max(id) as "stev"');
		$this->db->from('Odgovori_test');
		$this->db->where($pogoj);
		$indeksZadnjegaVprasanja = $this->db->get()->row_array();
		$indeksZadnjegaVprasanja = intval($indeksZadnjegaVprasanja['stev']);
		$data = array(
			'Odgovor' => '',
			'Vprasanje' => $vprasanje,
			'id' => $indeksZadnjegaVprasanja + 1,
			'tekmovalec' => $_SESSION['vzdevek'],
			'procenti' => 0,
			'pravilni_odgovor' => $pravilniOdgovor
		);
		$this->db->insert('Odgovori_test', $data);
		$this->pristej1Vprasanje();
	}

	public function pristej1Vprasanje()
	{
		$pogoj = "vzdevek = '".$_SESSION['vzdevek']."'";
		$this->db->select('dosedanjihVpr');
		$this->db->from('Tekmovalec');
		$this->db->where($pogoj);
		$indeksZadnjegaVprasanja = $this->db->get()->row_array();
		$indeksZadnjegaVprasanja = intval($indeksZadnjegaVprasanja['dosedanjihVpr']);
		$indeksZadnjegaVprasanja++;
		$data['dosedanjihVpr'] = $indeksZadnjegaVprasanja;
		$this->db->set($data);
		$this->db->where('vzdevek', $_SESSION['vzdevek']);
		$this->db->update('Tekmovalec');
	}

	public function shrani_odg_k_vprasanju($odgovor, $procenti, $hitrost, $skupni_procenti)  //tudi procente shrani
	{
		$pogoj = "tekmovalec = '".$_SESSION['vzdevek']."'";
		$indeksZadnjegaVprasanja = $this->maksIdVprasanjaUporabnika();
		$pogoj = $pogoj." AND id = '".$indeksZadnjegaVprasanja."'";
		$this->db->select('*');
		$this->db->from('Odgovori_test');
		$this->db->where($pogoj);
		$zadnjeVprasanje = $this->db->get()->row_array();
		$data['Odgovor'] = $odgovor;
		$data['procenti'] = $procenti;
		$data['hitrost'] = $hitrost;
		$data['skupni_procenti'] = $skupni_procenti;
		$this->db->set($data);
		$this->db->where($pogoj);
		$this->db->update('Odgovori_test');
		$odgovorovZaIzbrisati = $indeksZadnjegaVprasanja-42;
		if($odgovorovZaIzbrisati>0)
		{
			$this->izbrisiOdgovore($odgovorovZaIzbrisati);
		}
	}

	public function maksIdVprasanjaUporabnika()
	{
		$pogoj = "tekmovalec = '".$_SESSION['vzdevek']."'";
		$this->db->select('max(id) as "stev"');
		$this->db->from('Odgovori_test');
		$this->db->where($pogoj);
		$indeksZadnjegaVprasanja = $this->db->get()->row_array();
		$indeksZadnjegaVprasanja = intval($indeksZadnjegaVprasanja['stev']);
		return $indeksZadnjegaVprasanja;
	}

	public function zadnjeVprasanje($indeksZadnjegaVprasanja)
	{
		$pogoj = "tekmovalec = '".$_SESSION['vzdevek']."'";
		$pogoj = $pogoj." AND id = '".$indeksZadnjegaVprasanja."'";
		$this->db->select('*');
		$this->db->from('Odgovori_test');
		$this->db->where($pogoj);
		$zadnjeVprasanje = $this->db->get()->row_array();
		return $zadnjeVprasanje;
	}

	public function pravilnost_tekstovnega_odgovora($steviloEnakihCrk, $dolzinaPravilnegaOdg)
	{
		if($dolzinaPravilnegaOdg == 0)
		{
			return 0;
		}
		return round($steviloEnakihCrk/$dolzinaPravilnegaOdg*100, 2);
	}

	public function stevilo_enakih_crk($odgovorIgralca, $odgovorPravilni)
	{
		if($odgovorIgralca=="" || $odgovorPravilni==""){
	    	return 0;
	    }
	    $odgIgralcaBrezPrve = substr($odgovorIgralca, 1, strlen($odgovorIgralca)-1);
	    $odgPravilniBrezPrve = substr($odgovorPravilni, 1, strlen($odgovorPravilni)-1);

	    if(substr($odgovorIgralca, 0, 1) == substr($odgovorPravilni, 0, 1)){
	    	return 1 + $this->stevilo_enakih_crk($odgIgralcaBrezPrve, $odgPravilniBrezPrve);
	    }
	    return $this->stevilo_enakih_crk($odgIgralcaBrezPrve, $odgPravilniBrezPrve);
	}

	public function oceniUpostevajocCas($pravilnostTekstovnegaOdg, $hitrostOdgovora)
	{
		$pravilnostTekstovnegaOdg = $pravilnostTekstovnegaOdg - 3*$hitrostOdgovora;
		if($pravilnostTekstovnegaOdg<=0)
		{
			return 0;
		}
		return $pravilnostTekstovnegaOdg;
	}

	public function izbrisiOdgovore($id)
		// izbrise toliko odg, da jih ostane zadnjih 41
	{
		$vzdevek = $_SESSION['vzdevek'];
		for($i=1; $i<=$id; $i++)
		{
			$data = array('tekmovalec' => $vzdevek, 'id' => $i);
			$this->db->where($data);
			$this->db->delete("Odgovori_test");
		}
	}

	public function izbrisiVseOdgUporabnika()
	{
		$data = array('tekmovalec' => $_SESSION['vzdevek']);
		$this->db->where($data);
		$this->db->delete('Odgovori_test');
	}
}

?>