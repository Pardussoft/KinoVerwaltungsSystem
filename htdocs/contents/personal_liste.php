<script>


    function offnen(PersonalVR) {
       yonlendir("/?cat=personal_verwalten&id="+PersonalVR);    
    }
    
    var PersonalVR=-1;


   
    function loschen() {
        $.ajax({
            url:"../ajax/personal_verwalten.php",
            data: "PersonalVR=" + PersonalVR + "&islem=sil",
            type:"POST",
            success: function (cevap) {
                cevap = JSON.parse(cevap);
               
                if (cevap.basarim==1) {
                    var tr = document.getElementById("tr"+PersonalVR);
                    tr.style.display="none";
                }
                else {
                    alert(cevap.mesaj);
                }
            }
            
        });
       
    }

    
    function silmeIcinPersonalVRBelirle(id) {
        PersonalVR=id;
        onayKutusu("Personallöschen","Möchten Sie diesen personal löschen?", loschen);
    }

</script>

<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=personal_hinzufuegen">Neuer Personal</a>
    </div>
</section>

<?php
    $sayfaNo = (int) getValue("seit_nr", 1);
    $kayitSayisi=  (int) getValue("eintrag_nr", 10);
    $sayfalamaHTML =  sayfala($conn, "kinopersonal", $sayfaNo, $kayitSayisi, $cat);
    echo $sayfalamaHTML;
  
    $kayitBaslangic = $kayitSayisi * ($sayfaNo-1);
?>

<table class="table" OnClick="">

<?php
    $sql = "Select * from kinopersonal Limit $kayitBaslangic, $kayitSayisi";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows>0) {

            while ($rec = $result->fetch_assoc()) {
                $PersonalVR= $rec["PersonalVR"];
                $name = $rec["vorname"]." ".$rec["nachname"];

                $row = "<tr id='tr$PersonalVR'>";
                    $row .= "<td class='text-left'><b class='text-primary'>$PersonalVR</b> - <b>$name </b> </td>";
                    $row .= "<td class='text-right'>";
                         $row .="<button class='btn btn-primary' style='margin-right:10px;' OnClick='offnen($PersonalVR);'>öffnen</button>";
                         $row .="<buttun id='silButton' class='btn btn-warning' data-toggle='modal' ' OnClick='silmeIcinPersonalVRBelirle($PersonalVR);'>Löschen</button>";
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

