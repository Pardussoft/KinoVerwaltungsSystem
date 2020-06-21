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
$vorID=$_POST["vorfuhrung"];

//SitzID, Platznummer, Reihennummer ,Saal_NR
$sql = "
Select sitzplatz.*, eintrittskarte.KartenNr
From sitzplatz
Left Join eintrittskarte On eintrittskarte.VorfuhrungID=$vorID AND sitzplatz.SitzID=eintrittskarte.SitzID 
Where Saal_NR= (Select Saal_NR From vorfuhrung Where VorfuhrungID=$vorID)
Order By Reihennummer, Platznummer";
    
$out->sql = $sql;
    
$result = $conn->query($sql);

$liste = "<div style='margin:5px; padding:5px;'>
    <h3 style='position:relative; left:calc(50% - 100px); text-align:center; display:inline-block; width:200px; height:50px; border:1px solid;'>Vorhang</h3></div>";
$liste .= "<table border='1' style='position:relative; margin: 0 auto;'>";
if ($result) {
    if ($result->num_rows>0) {
        $out->basarim=1;
        $preReih=-1;
        while ($rec = $result->fetch_assoc()) {
            $reih=$rec["Reihennummer"];
            $plat = $rec["Platznummer"];
            $sitzID = $rec["SitzID"];
             
            if ($reih != $preReih) {
                if ($preReih == -1)
                    $liste .="<tr>";
                else
                    $liste .="</tr><tr>";
                $preReih = $reih;
            }
            if ($rec["KartenNr"] =="")    {
                $liste .= "<td class=''>

                    <button id='$sitzID' class='leerer_platz' OnClick='sec(this,$reih,$plat);'>
                        $reih-$plat 
                    </button>

                </td>";
            }
            else {
                $liste .= "<td class=''>

                    <button disabled id='$sitzID' class='voller_platz' OnClick='sec(this,$reih,$plat);'>
                        $reih-$plat 
                    </button>

                </td>";
            }
        }      
    }

    $liste .="</tr>";
}
else {
    $out->hatano=$conn->errno;
    $out->mesaj=$conn->error;
}

$liste .="</table>";

$out->liste=$liste;

echo json_encode($out);

?>