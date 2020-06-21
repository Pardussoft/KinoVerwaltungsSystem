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
        'sql' =>
    ];

    $islem = postValue("islem","");
 
   
    $sql="-";
    if ($islem=="guncelle") {
        
        $filmeID=$_POST["filmeID"];
        $titel=$_POST["titel"];
        $dauer=$_POST["dauer"];
        $fsk=postValue("fsk",0);

        $sql = "Update  films Set Titel='$titel', Dauer='$dauer', FSK=$fsk Where FilmID=$filmeID;";    
    } 
    else if ($islem=="ekle") {

        $titel=$_POST["titel"];
        $dauer=$_POST["dauer"];
        $fsk=postValue("fsk",0);

        $sql = "Insert Into films (Titel, Dauer, FSK) Values ('$titel',$dauer,$fsk);";       
    }
    else if ($islem=="sil") {

        $filmeID=$_POST["filmeID"];
        $sql ="Delete From films Where FilmID=$filmeID;"; 
    } 
    else { //hatalı işlem tipi
        $out->mesaj="Hatalı işlem tipi";
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