<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    include "../conn.php";
    include "../funcs.php";

    session_start();


    $out= (object) [
        'hatano' => '',
        'basarim' => 0,
        'mesaj' =>'',
        'sql' =>''
    ];

    $islem = postValue("islem","");
    
    $sql="-";
    $sqlCarte="";
 if ($islem=="complett") {
        $typ = $_POST["typ"];
        $filmID=$_POST["filmID"];
        $vorfuhrungID=$_POST["vorfuhrung"];
		$sitz = postValue("sitz","");
        $preis= $typ==0 ? 10:6;
    
        $sql = "Insert Into verkauf (Typ, KinopersonalID) Values ($typ, ". $_SESSION["PersonalVR"].");"; 
        
    }
    else if ($islem=="rezerve_et") {

        $vkID=$_POST["vkID"];
        $sql ="Delete From verkauf Where VkID=$vkID;"; 
    } 
    else if ($islem=="rezerve_onay") {

        $vkID=$_POST["vkID"];
        $sql ="Delete From verkauf Where VkID=$vkID;"; 
    } 
    else if ($islem=="rezerve_iptal") {

        $vkID=$_POST["vkID"];
        $sql ="Delete From verkauf Where VkID=$vkID;"; 
    }
    else { //hatalı işlem tipi
        $out->mesaj="Fehlerhafter Vorgang";

		echo json_encode($out);

		return;
    }
   
   // $out->sql = "Verkauf=[$sql] ";


		
    $result = $conn->query($sql);

    if ($result) {
        if ($islem=='complett') {
            $vkID=$conn->insert_id;
            $out->basarim = $conn->insert_id;

            $sqlKart = "Insert Into eintrittskarte (Preis, VorfuhrungID, SitzID, VkID) Values";
            $platz = explode(", ",$sitz);
            
            foreach ($platz as $sitzID) { //p12
                $sqlKart .="($preis, $vorfuhrungID, $sitzID, $vkID), ";
            }

            //Son eklenen virgülü silmek için
            $sqlKart = substr( $sqlKart, 0, strlen($sqlKart)-2);
            
           // $out->sql .= "Karte=[ $sqlKart;]";

            $kartResult = $conn->query($sqlKart);
            if ($kartResult) {
                $out->basarim = "1";
            }
            else {
                $sql = "Delete From verkauf Where VkID=$vkID"; //Kartlar olşmadığından satış gerçekleşmedi. O zaman ilgili verkaufu sil.
                $result = $conn->query($sql);
            } 
        }
    }
    else {
        $out->hatano=$conn->errno;
        $out->mesaj=$conn->error;
    }
	
    $out->basarim = 1;
   

    echo json_encode($out);

?>