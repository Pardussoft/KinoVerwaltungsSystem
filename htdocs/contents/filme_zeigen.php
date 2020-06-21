<script>


    function offnen(filmID) {
       yonlendir("/?cat=filme_verwalten&id="+filmID);    
    }
    
    var filmID=-1;


   
    function loschen() {
        $.ajax({
            url:"../ajax/filme_verwalten.php",
            data: "filmeID=" + filmID + "&islem=sil",
            type:"POST",
            success: function (cevap) {
                cevap = JSON.parse(cevap);
               
                if (cevap.basarim==1) {
                    var tr = document.getElementById("tr"+filmID);
                    tr.style.display="none";
                }
                else {
                    alert(cevap.mesaj);
                }
            }
            
        });
       
    }

    
    function silmeIcinfilmIDBelirle(id) {
        filmID=id;
        onayKutusu("Film Löschen","Möchten Sie diesen Film löschen?", loschen);
    }

</script>

<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=filme_hinzufuegen">Neuer Film</a>
    </div>
</section>

<?php
    $sayfaNo = (int) getValue("seit_nr", 1);
    $kayitSayisi=  (int) getValue("eintrag_nr", 10);
    $sayfalamaHTML =  sayfala($conn, "filme", $sayfaNo, $kayitSayisi, $cat);
    echo $sayfalamaHTML;
  
    $kayitBaslangic = $kayitSayisi * ($sayfaNo-1);
?>

<table class="table" OnClick="">

<?php
    $sql = "Select * from filme Limit $kayitBaslangic, $kayitSayisi";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows>0) {

            while ($rec = $result->fetch_assoc()) {
                $filmID= $rec["FilmID"];
                $titel = $rec["Titel"];
                $dauer = $rec["Dauer"];
                $bild=$rec["Bild"];

                if ($bild=="")
                    $bild="default.png";

                $row = "<tr id='tr$filmID'>";
                    $row .= "<td style='width:60px;'><img src='img/filme/$bild' width='50' height='50'/></td>";
                    $row .= "<td class='text-left'><b class='text-primary'>$filmID</b> - <b>$titel</b> </td>";
                    $row .= "<td class='text-right'>";
                         $row .="<button class='btn btn-primary' style='margin-right:10px;' OnClick='offnen($filmID);'>öffnen</button>";
                         $row .="<buttun id='silButton' class='btn btn-warning' data-toggle='modal' ' OnClick='silmeIcinfilmIDBelirle($filmID);'>Löschen</button>";
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

