<?php

    		include("init.php");
    		include("lekoviKlasa.php");
    		$lekovi = new Lekovi($db);
        $response = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name     = $_FILES['file']['name'];
            $tmpName  = $_FILES['file']['tmp_name'];
            $error    = $_FILES['file']['error'];
            $size     = $_FILES['file']['size'];
            $ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            switch ($error) {
                case UPLOAD_ERR_OK:
                    $valid = true;
                    if ( !in_array($ext, array('jpg','jpeg','png','gif')) ) {
                        $valid = false;
                        $response = 'Losa ekstenzija';
                    }
                    if ( $size/1024/1024 > 2 ) {
                        $valid = false;
                        $response = 'Preveliki fajl.';
                    }
                    if ($valid) {
                        $targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'slike' . DIRECTORY_SEPARATOR. $name;
                        move_uploaded_file($tmpName,$targetPath);
          						$data = Array (
                                    "naziv" => trim($_POST['naziv']),
                                    "opis" => trim($_POST['opis']),
                      				"cena" => trim($_POST['cena']),
                      				"kategorija" => trim($_POST['kategorija']),
                      				"slika" => $name
                      				);

          							$lekovi->ubaciLek($data);
                        header( 'Location: admin.php' ) ;
                        $response = 'Uspesno ubaen novi lek';
                        echo $response;
                        exit;
                    }
                    break;

                default:
                    $response = 'GRESKA';
                break;
            }

            echo $response;
        }
        ?>
