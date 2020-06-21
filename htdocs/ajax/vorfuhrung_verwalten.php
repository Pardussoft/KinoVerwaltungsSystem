<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    include "../conn.php";
    include "../funcs.php";

 
    
function tarihKontrol($conn, $saal_NR, $filmID, $beginn, $ende, $islem, $vor=-1) {


    $sql = "
        Select VorfuhrungID from vorfuhrung 
        Where 
            Saal_NR=$saal_NR 
            and 
                (
                    (Beginn<=str_to_date('$beginn', '%Y-%m-%d') and str_to_date('$beginn', '%Y-%m-%d') <=Ende) 
                    or 
                    (Beginn<=str_to_date('$ende', '%Y-%m-%d')  and str_to_date('$ende', '%Y-%m-%d') <=Ende)
                    or
                    (str_to_date('$beginn', '%Y-%m-%d')<=Beginn and Ende<=str_to_date('$ende', '%Y-%m-%d'))

                );";



    $result = $conn->query($sql);

    if ($result) {

        if ($islem =="guncelle") {
            if ($result->num_rows>0) {

                $rec= $result->fetch_assoc();
                if ($rec["VorfuhrungID"] != $vor) {
                    return false;
                }
            }
        }
        else {
            if ($result->num_rows>0) {
                return false;
            }
        }
    }
    else {
        return false;
    }

    return true;
}


    $out= (object) [
        'hatano' => '',
        'basarim' => 0,
        'mesaj' =>'',
        'sql' =>''
    ];

    $islem = postValue("islem","");
 
    $sql="-";
	$kontrol=true;

    if ($islem=="guncelle") {
        
        $vorfuhrungID=$_POST["vorfuhrungID"];
        $saal_NR=$_POST["saal_NR"];
		$filmID=$_POST["filmID"];
        $beginn=$_POST["beginn"];
        $ende=$_POST["ende"];

		$kontrol = tarihKontrol($conn, $saal_NR, $filmID, $beginn, $ende, $islem, $vorfuhrungID);
        $sql = "Update vorfuhrung Set Saal_NR=$saal_NR, FilmID=$filmID, Beginn='$beginn', Ende='$ende' Where VorfuhrungID=$vorfuhrungID;";    
    } 
    else if ($islem=="ekle") {

        $saal_NR=$_POST["saal_NR"];
		$filmID=$_POST["filmID"];
        $beginn=$_POST["beginn"];
        $ende=$_POST["ende"];

		$kontrol = tarihKontrol($conn, $saal_NR, $filmID, $beginn, $ende, $islem);
        $sql = "Insert Into vorfuhrung (Saal_NR, FilmID, Beginn, Ende) Values ($saal_NR, $filmID, '$beginn', '$ende');";       
    }
    else if ($islem=="sil") {

        $vorfuhrungID=$_POST["vorfuhrungID"];
        $sql ="Delete From vorfuhrung Where VorfuhrungID=$vorfuhrungID;"; 
    } 
    else { //hatalı işlem tipi
        $out->mesaj="Fehlerhafter Vorgang";

		echo json_encode($out);

		return;
    }
   
    $out->sql = $sql;

   if ($kontrol) {
		
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
	 
   }
   else {
		$out->mesaj="Die Halle ist in diesem Zeitraum nicht verfügbar.";
   }

    echo json_encode($out);

?>