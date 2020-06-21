<script>


    function offnen(Saal_NR) {
       yonlendir("/?cat=saal_verwalten&id="+Saal_NR);    
    }
    
    var Saal_NR=-1;


   
    function loschen() {
        $.ajax({
            url:"../ajax/saal_verwalten.php",
            data: "Saal_NR=" + Saal_NR + "&islem=sil",
            type:"POST",
            success: function (cevap) {
                cevap = JSON.parse(cevap);
               
                if (cevap.basarim==1) {
                    var tr = document.getElementById("tr"+Saal_NR);
                    tr.style.display="none";
                }
                else {
                    alert(cevap.mesaj);
                }
            }
            
        });
       
    }

    
    function silmeIcinSaal_NRBelirle(id) {
        Saal_NR=id;
        onayKutusu("Saallöschen","Möchten Sie diesen Saal löschen?", loschen);
    }

</script>

<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=saal_hinzufuegen">Neuer Saal</a>
    </div>
</section>

<?php
    $sayfaNo = (int) getValue("seit_nr", 1);
    $kayitSayisi=  (int) getValue("eintrag_nr", 10);
    $sayfalamaHTML =  sayfala($conn, "saal", $sayfaNo, $kayitSayisi, $cat);
    echo $sayfalamaHTML;
  
    $kayitBaslangic = $kayitSayisi * ($sayfaNo-1);
?>

<table class="table" OnClick="">

<?php
    $sql = "Select * from saal Limit $kayitBaslangic, $kayitSayisi";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows>0) {

            while ($rec = $result->fetch_assoc()) {
                $Saal_NR= $rec["Saal_NR"];
                $filmberühmtheit = $rec["Filmberühmtheit"];

                $row = "<tr id='tr$Saal_NR'>";
                    $row .= "<td class='text-left'><b class='text-primary'>$Saal_NR</b> - <b>$filmberühmtheit</b> </td>";
                    $row .= "<td class='text-right'>";
                         $row .="<button class='btn btn-primary' style='margin-right:10px;' OnClick='offnen($Saal_NR);'>öffnen</button>";
                         $row .="<buttun id='silButton' class='btn btn-warning' data-toggle='modal' ' OnClick='silmeIcinSaal_NRBelirle($Saal_NR);'>Löschen</button>";
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

