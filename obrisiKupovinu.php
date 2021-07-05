<?php
include("init.php");
$id= $_GET['kupovinaID'];
$db->rawQuery("delete from kupovina where kupovinaID=".$id);
echo("<p>Brisanje porudzbine je uspesno, osvezite stranicu radi osvezenog prikaza podataka!</p>");
?>
