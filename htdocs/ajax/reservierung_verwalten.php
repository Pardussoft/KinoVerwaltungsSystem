<?php


    session_start();

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
        
        $resNR=$_POST["ResNR"];
        
        $personal = $_SESSION["PersonalVR"];


        if (isset($_POST["vorfuhrung"]))
            $vorfuhrungID=$_POST["vorfuhrung"];
        else {
            $out->mesaj="Bitte wählen Sie einen vorführung.";
            echo json_encode($out);
            exit();
        }

        $vorname=$_POST["vorname"];
        $nachname=$_POST["nachname"];
        $platzanzahi=$_POST["platzanzahi"];

        $sql = "
            Update reservierung 
            Set VorfuhrungID='$vorfuhrungID', Vorname='$vorname', 
                Nachname='$nachname', KinopersonalID='$personal',Platzanzahi='$platzanzahi'
            Where ResNR=$resNR;";    
    } 
    else if ($islem=="ekle") {

        $personal = $_SESSION["PersonalVR"];
        $vorfuhrungID=$_POST["vorfuhrung"];
        $vorname=$_POST["vorname"];
        $nachname=$_POST["nachname"];
        $platzanzahi=$_POST["platzanzahi"];
        
        $sql = "Insert Into reservierung (VorfuhrungID, Vorname, Nachname, KinopersonalID, Platzanzahi)
         Values ($vorfuhrungID,'$vorname', '$nachname', '$personal', '$platzanzahi');";       
    }
    else if ($islem=="sil") {

        $resNR=$_POST["ResNR"];
        $sql ="Delete From reservierung Where ResNR=$resNR;"; 
    } 
    else if ($islem=="complett") {

        $resNR=$_POST["ResNR"];
        $sql ="Delete From reservierung Where ResNR=$resNR;"; 
    } 
    else { //hatalı işlem tipi
        $out->mesaj="Fehlerhafter Vorgang";
    }
   
    $out->sql = $sql;
    //echo  reserveirungBis($conn, $vorfuhrungID);
    if ($islem == 'ekle' || $islem=='guncelle') {
        $fark = reserveirungBis($conn, $vorfuhrungID);
        if ($fark<=1) {
            $out->mesaj="Es müssen mindestens 24 im Screening verbleiben, um eine Reservierung vorzunehmen.";
            echo json_encode($out);
            exit();
        }
    }
   
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