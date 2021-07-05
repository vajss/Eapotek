<?php
include("init.php");
$id= $_GET['kupovinaID'];
$db->rawQuery("update kupovina set daLiJeObavljena=1 where kupovinaID=".$id);
echo("<p>Potvrđena kupovina. Osvežite stranicu!</p>");
?>
