<?php

class Lekovi {

	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function ubaciLek($data) {

		$parameters = json_encode($data);
			$path = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

			$curl_zahtev = curl_init("{$path}/rest/ubaci.json");
			curl_setopt($curl_zahtev, CURLOPT_POST, TRUE);
			curl_setopt($curl_zahtev, CURLOPT_POSTFIELDS, $parameters);
			curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
			$curl_odgovor = curl_exec($curl_zahtev);
			$json_objekat=json_decode($curl_odgovor, true);
			curl_close($curl_zahtev);

			if($json_objekat == "Uspesno ste dodali novi lek!") {
				return true;
			}
			else {
				return false;
			}
		return $sacuvano;

	}
}

?>
