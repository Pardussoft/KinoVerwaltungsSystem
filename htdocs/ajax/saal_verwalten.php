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
        
        $Saal_NR=$_POST["Saal_NR"];
        $filmberühmtheit=$_POST["filmberühmtheit"];
      

        $sql = "Update  saal Set filmberühmtheit='$filmberühmtheit' Where Saal_NR=$Saal_NR;";    
    } 
    else if ($islem=="ekle") {

        $filmberühmtheit=$_POST["filmberühmtheit"];


        $sql = "Insert Into saal (filmberühmtheit) Values ('$filmberühmtheit');";       
    }
    else if ($islem=="sil") {

        $Saal_NR=$_POST["Saal_NR"];
        $sql ="Delete From saal Where Saal_NR=$Saal_NR;"; 
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