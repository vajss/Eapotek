<?php
require 'flight/Flight.php';
require 'jsonindent.php';


Flight::route('/', function(){

	echo("Default api");
});

Flight::register('db', 'Database', array('registrovanNiz'));

Flight::route('GET /kategorije.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$db->vratiKategorije();

	$niz =  array();
	$iterator = 0;
	while ($red = $db->getResult()->fetch_object())
	{
		$niz[$iterator] = $red;
		$iterator += 1;
	}

	echo indent(json_encode($niz));
});

Flight::route('GET /lekoviKupovina.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$db->vratiLekove();

	$niz =  array();
	$iterator = 0;
	while ($red = $db->getResult()->fetch_object())
	{
		$niz[$iterator] = $red;
		$iterator += 1;
	}

	echo indent(json_encode($niz));
});


Flight::route('POST /ubaci.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$post_data = file_get_contents('php://input');
	$json_data = json_decode($post_data,true);
	$db->ubaci($json_data);
	if($db->getResult())
	{
		$response = "Uspesno ste dodali novi lek!";
	}
	else
	{
		$response = "Unosenje lekova nije uspesno!";

	}

	echo indent(json_encode($response));

});
Flight::route('POST /ubaciKorisnika.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$post_data = file_get_contents('php://input');
	$json_data = json_decode($post_data,true);
	$db->ubaciKorisnika($json_data);
	if($db->getResult())
	{
		$response = "Uspesno ste registrovali korisnika!";
	}
	else
	{
		$response = "Neuspesna registracija novog korisnika!";

	}

	echo indent(json_encode($response));

});

Flight::route('POST /kupiLek.json', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$post_data = file_get_contents('php://input');
	$json_data = json_decode($post_data,true);
	$db->kupiLek($json_data);
	if($db->getResult())
	{
		$response = "OK!";
	}
	else
	{
		$response = "Neuspesno";

	}

	echo indent(json_encode($response));

});

Flight::start();
?>
