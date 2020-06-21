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
        
        $PersonalVR=$_POST["PersonalVR"];
        
        $vorname=$_POST["vorname"];
        $nachname=$_POST["nachname"];
        $email=$_POST["email"];
        $position=$_POST["position"];
        $svnr=$_POST["svnr"];
        //$password=$_POST["password"];

        $sql = "
            Update kinopersonal 
            Set vorname='$vorname', nachname='$nachname', email='$email', position='$position', SVNR='$svnr'
            Where PersonalVR=$PersonalVR;";    
    } 
    else if ($islem=="ekle") {


        $vorname=$_POST["vorname"];
        $nachname=$_POST["nachname"];
        $email=$_POST["email"];
        $position=$_POST["position"];
        $svnr=$_POST["svnr"];
        $password=$_POST["password"];


        $sql = "Insert Into kinopersonal (vorname, nachname, email, position, SVNR, password) Values ('$vorname', '$nachname', '$email', '$position', '$svnr', '$password');";       
    }
    else if ($islem=="sil") {

        $PersonalVR=$_POST["PersonalVR"];
        $sql ="Delete From kinopersonal Where PersonalVR=$PersonalVR;"; 
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