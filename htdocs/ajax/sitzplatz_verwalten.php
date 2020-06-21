<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    include "../conn.php";
    include "../funcs.php";


    $out= (object) [
        'hatano' => '',
        'basarim' => 0,
        'mesaj' =>'',
        'sql' =>''
    ];

    $islem = postValue("islem","");
 
    $sql="-";
    if ($islem=="guncelle") {
        
        $sitzID=$_POST["sitzID"];
        $saal_NR=$_POST["saal_NR"];
        $reihennummer=$_POST["reihennummer"];
        $platznummer=$_POST["platznummer"];

        $sql = "Update  sitzplatz Set Saal_NR=$saal_NR, Reihennummer='$reihennummer',  Platznummer='$platznummer' Where SitzID=$sitzID;";    
    } 
    else if ($islem=="ekle") {

        $saal_NR=$_POST["saal_NR"];
        $reihennummer=$_POST["reihennummer"];
        $platznummer=$_POST["platznummer"];

        $sql = "Insert Into sitzplatz (Saal_NR, Reihennummer, Platznummer) Values ($saal_NR, '$reihennummer', '$platznummer');";       
    }
	else if ($islem=="ekle_coklu") {

        $saal_NR=$_POST["saal_NR"];
        $reihennummer=$_POST["reihennummer"];
        $sitzstartnummer=$_POST["sitzstartnummer"];
		$sitzendnummer=$_POST["sitzendnummer"];

        $sql = "Insert Into sitzplatz (Saal_NR, Reihennummer, Platznummer) Values ";
		for($i=$sitzstartnummer; $i<=$sitzendnummer; $i++) {
			$sql .= "($saal_NR, $reihennummer, $i)"; 
			if ($i<$sitzendnummer)
				$sql .=",";
		}
    }
    else if ($islem=="sil") {

        $sitzID=$_POST["sitzID"];
        $sql ="Delete From sitzplatz Where SitzID=$sitzID;"; 
    } 
    else { //hatalı işlem tipi
        $out->mesaj="Fehlerhafter Vorgang";
    }
   
    $out->sql = $sql;

    $result = $conn->query($sql);

     if ($result) {
        if ($islem=='ekle')
            $out->basarim = $conn->insert_id;
        else
            $out->basarim = 1;
    }
    else {
        $out->hatano=$conn->errno;
        $out->mesaj=$conn->error;
    }
 

    echo json_encode($out);

?>