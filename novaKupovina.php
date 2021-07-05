<?php

include("init.php");

    $podaci = Array (
      "lekID" => trim($_POST['lekID']),
      "korisnikID" => trim($_SESSION['korisnik']['korisnikID'])
      );

      $pod = json_encode($podaci);
      $path = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

      $curl_zahtev = curl_init("{$path}/rest/kupiLek.json");
      curl_setopt($curl_zahtev, CURLOPT_POST, TRUE);
      curl_setopt($curl_zahtev, CURLOPT_POSTFIELDS, $pod);
      curl_setopt($curl_zahtev, CURLOPT_RETURNTRANSFER, 1);
      $curl_odgovor = curl_exec($curl_zahtev);
      $json_objekat=json_decode($curl_odgovor, true);
      curl_close($curl_zahtev);

  if($json_objekat == "OK!") {
    echo('<h1 style="color:#000;">Uspesno ste podneli zahtev za kupovinu leka, mozete ocekivati isporuku u narednih 48h! </h1>');
  }
  else {
    echo('GRESKA');
  }



?>
