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
    'sql' =>'',
    'liste' =>''
];


$filmID=$_POST["filmID"];
$vorfuhrungSelected = postValue("vorfuhrung","-1");

$sql = "
Select vorfuhrung.*, saal.filmberühmtheit, filme.Titel 
From vorfuhrung
Inner Join filme On vorfuhrung.FilmID=filme.FilmID
Inner Join saal On vorfuhrung.Saal_NR=saal.Saal_NR
Where vorfuhrung.Ende>=Now() && vorfuhrung.FilmID=$filmID
Order By Titel";
    
$out->sql = $sql;
    
$result = $conn->query($sql);

$liste="<br/>";
if ($result) {
    if ($result->num_rows>0) {
        $out->basarim=1;
        while ($rec = $result->fetch_assoc()) {
            $vorfuhrungID=$rec["VorfuhrungID"];
            $filmberühmtheit = $rec["filmberühmtheit"];
            $beginn=$rec["Beginn"];
            $ende = $rec["Ende"];

            if ($vorfuhrungSelected == $vorfuhrungID) {
                $liste .= "<label class='container_radio'><p style='min-width:250px;display:inline-block;'>$filmberühmtheit</p> <span style='font-size:11pt;'>[ $beginn - $ende ]</span>
                <input type='radio' checked required name='vorfuhrung' id='$filmberühmtheit' value='$vorfuhrungID' OnClick='sitzplatzListe()'> 
                <span class='checkmark'></span></label>";
            }
            else {
                $liste .= "<label class='container_radio'><p style='min-width:250px;display:inline-block;'>$filmberühmtheit</p> <span style='font-size:11pt;'>[ $beginn - $ende ]</span>
                <input type='radio' name='vorfuhrung' required id='$filmberühmtheit' value='$vorfuhrungID' OnClick='sitzplatzListe()'> 
                <span class='checkmark'></span></label>";
            }
           
        }
        $liste.="<br/>";
        $out->liste=$liste;
    }
}
else {
    $out->hatano=$conn->errno;
    $out->mesaj=$conn->error;
}
    



echo json_encode($out);

?>