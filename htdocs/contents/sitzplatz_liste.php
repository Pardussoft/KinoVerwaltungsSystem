<script>


    function offnen(sitzID) {
       yonlendir("/?cat=sitzplatz_verwalten&id="+sitzID);    
    }
    
    var sitzID=-1;


   
    function loschen() {
        $.ajax({
            url:"../ajax/sitzplatz_verwalten.php",
            data: "sitzID=" + sitzID + "&islem=sil",
            type:"POST",
            success: function (cevap) {
                cevap = JSON.parse(cevap);
               
                if (cevap.basarim==1) {
                    var tr = document.getElementById("tr"+sitzID);
                    tr.style.display="none";
                }
                else {
                    alert(cevap.mesaj);
                }
            }
            
        });
       
    }

    
    function silmeIcinsitzIDBelirle(id) {
        sitzID=id;
        onayKutusu("Sitzplatz Löschen","Möchten Sie diesen Film löschen?", loschen);
    }

</script>

<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=sitzplatz_hinzufuegen">Neuer Film</a>
    </div>
</section>

<?php
    $sayfaNo = (int) getValue("seit_nr", 1);
    $kayitSayisi=  (int) getValue("eintrag_nr", 20);
    $saal_nr = (int) getValue("saal_NR", "0");

    $sayfalamaHTML =  sayfala($conn, "sitzplatz", $sayfaNo, $kayitSayisi, $cat, "saal_NR=$saal_nr");
    echo $sayfalamaHTML;
  
    $kayitBaslangic = $kayitSayisi * ($sayfaNo-1);
?>

<form id="saal_form" method="GET" style="margin-bottom:5px;" action="">
    <input type="hidden" name="cat" value="<?php echo  $cat;?>">
    <input type="hidden" name="seit_nr" value="<?php echo $sayfaNo;?>">
    <?php  echo selectYap($conn, "saal", "Saal_NR", "Filmberühmtheit",  $saal_nr, "saal_NR",1,"form-control"); ?>
</form>

<script>

$(document).ready( function() {

    $("#saal_NR").change(function() {
        $("#saal_form").submit();
    });

});

</script>


<table class="table" OnClick="">

<?php

$sql="";

if ($saal_nr==0)
    $sql = "Select sitzplatz.*, saal.Filmberühmtheit from sitzplatz, saal 
            Where sitzplatz.Saal_NR=saal.Saal_NR 
            Order By saal.Filmberühmtheit, sitzplatz.Reihennummer, sitzplatz.Platznummer
            Limit $kayitBaslangic, $kayitSayisi";
else 
    $sql = "Select sitzplatz.*, saal.Filmberühmtheit from sitzplatz, saal 
            Where sitzplatz.Saal_NR=saal.Saal_NR and sitzplatz.Saal_NR=$saal_nr
            Order By sitzplatz.Reihennummer, sitzplatz.Platznummer
            Limit $kayitBaslangic, $kayitSayisi";

         //   echo $sql;
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows>0) {

            while ($rec = $result->fetch_assoc()) {
                $sitzID= $rec["SitzID"];
                $reihennummer = $rec["Reihennummer"];
                $platznummer = $rec["Platznummer"];
                $filmberühmtheit=$rec["Filmberühmtheit"];
                $row = "<tr id='tr$sitzID'>";
                    $row .= "<td class='text-left'>
                        $filmberühmtheit - 
                        <b class='text-primary'>($sitzID)</b> <big> <b>$reihennummer</b>-<b>$platznummer</b></big> </td>";
                   
                        $row .= "<td class='text-right'>";
                         $row .="<button class='btn btn-primary' style='margin-right:10px;' OnClick='offnen($sitzID);'>öffnen</button>";
                         $row .="<buttun id='silButton' class='btn btn-warning' data-toggle='modal' ' OnClick='silmeIcinsitzIDBelirle($sitzID);'>Löschen</button>";
                    $row .="</td>";
                $row .="</tr>";
                
                echo  $row;
            }
        }

    }
?>

</table>

<?php
    echo $sayfalamaHTML;
?>

