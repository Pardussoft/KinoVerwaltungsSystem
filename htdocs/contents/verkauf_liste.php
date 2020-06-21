<script>


    function offnen(VkID) {
       yonlendir("/?cat=verkauf_verwalten&id="+VkID);    
    }
    
    var VkID=-1;
   
    function loschen() {
        $.ajax({
            url:"../ajax/verkauf_verwalten.php",
            data: "VkID=" + VkID + "&islem=sil",
            type:"POST",
            success: function (cevap) {
                cevap = JSON.parse(cevap);
               
                if (cevap.basarim==1) {
                    var tr = document.getElementById("tr"+VkID);
                    tr.style.display="none";
                }
                else {
                    alert(cevap.mesaj);
                }
            }
            
        });
       
    }

    
    function silmeIcinVkIDBelirle(id) {
        VkID=id;
        onayKutusu("Saallöschen","Möchten Sie diesen Saal löschen?", loschen);
    }

</script>

<?php if ($_SESSION["Position"]<=1) { ?>
<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=verkauf_hinzufuegen">Neuer Verkauf</a>
    </div>
</section>
<?php } ?>
<?php
    $sayfaNo = (int) getValue("seit_nr", 1);
    $kayitSayisi=  (int) getValue("eintrag_nr", 10);
    $personal = getValue("personal","");
    $ek = $personal!="" ? "personal=$personal" : "";

    $sayfalamaHTML =  sayfala($conn, "verkauf", $sayfaNo, $kayitSayisi, $cat, $ek);
    echo $sayfalamaHTML;
  
    $kayitBaslangic = $kayitSayisi * ($sayfaNo-1);
?>

<table class="table" OnClick="">
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Filme</th>
        <th>Saal</th>
        <th>Sitzplatz</th>
        <th>Type</th>
        <th>Preis</th>
        <th>Total</th>
        <th>Personal</th>
    </tr>
<?php

    

    $sql = "Select 
                verkauf.*,
                eintrittskarte.*, 
                saal.Filmberühmtheit,
                filme.Titel,
                CONCAT('P',sitzplatz.Reihennummer, '-',sitzplatz.Platznummer) as sitz,
                CONCAT(kinopersonal.vorname, ' ',kinopersonal.nachname) as pers
            From verkauf 
            Inner Join eintrittskarte On eintrittskarte.VkID=verkauf.VkID
            Inner Join vorfuhrung On eintrittskarte.VorfuhrungID=vorfuhrung.VorfuhrungID
            Inner Join saal On vorfuhrung.Saal_NR = saal.Saal_NR
            Inner Join filme On vorfuhrung.FilmID = filme.FilmID
            Inner Join sitzplatz On eintrittskarte.SitzID = sitzplatz.SitzID 
            Inner Join kinopersonal On kinopersonal.PersonalVR = verkauf.KinopersonalID ";
    


    if ($personal != "") {
        $sql .= "Where verkauf.KinopersonalID=$personal ";
    }
    

    $sql .="Order By verkauf.VkID DESC
            Limit $kayitBaslangic, $kayitSayisi";

            
	//echo  $sql;
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows>0) {
            
            $pvkID=-1;
           
            $sitz="";
            while ($rec = $result->fetch_assoc()) {
             //   print_r($rec);
                $vkID= $rec["VkID"];

           //echo $vkID." ";
            //echo $rec["Filmberühmtheit"]." ";

                if ($pvkID == -1) {
                    $pvkID = $vkID;

                    $zeit=$rec["Zeit"];
                    $filmberühmtheit = $rec["Filmberühmtheit"];
                    $titel = $rec["Titel"];
                    $sitz = $rec["sitz"];
                    $type = $rec["Typ"]==0 ? "Normal" : "Rabatt";
                    $preis=$rec["Preis"];
                    $total=$rec["Preis"];
                    $pers = $rec["pers"];
                }

                if ($vkID!= $pvkID) {
                    $row = "<tr id='tr$vkID'>";
                    $row .= "
                            <td class='text-left'><b class='text-primary'>$pvkID</b></td>
                            <td <b>$zeit</b> </td>
                            <td <b>$titel</b> </td>
                            <td <b>$filmberühmtheit</b> </td>
                            <td <b>$sitz</b> </td>
                            <td <b>$type</b> </td>
                            <td <b>$preis</b> </td>
                            <td <b>$total</b> </td>
                            <td <b>$pers</b> </td>";
                   
                    $row .="</tr>";
                    
                    $pvkID = $vkID;

                    $zeit=$rec["Zeit"];
                    $filmberühmtheit = $rec["Filmberühmtheit"];
                    $titel = $rec["Titel"];
                    $sitz = $rec["sitz"];
                    $type = $rec["Typ"]==0 ? "Normal" : "Rabatt";
                    $preis=$rec["Preis"];
                    $total=$rec["Preis"];
                    $pers = $rec["pers"];
                    
                    echo  $row;
                }
               else {
                
                $sitz .= " , ".$rec["sitz"];
                $total += $rec["Preis"];
               }

               

               
            }

            //Son kaydın çıkması için
            $row = "<tr id='tr$vkID'>";
            $row .= "
                    <td class='text-left'><b class='text-primary'>$pvkID</b></td>
                    <td <b>$zeit</b> </td>
                    <td <b>$titel</b> </td>
                    <td <b>$filmberühmtheit</b> </td>
                    <td <b>$sitz</b> </td>
                    <td <b>$type</b> </td>
                    <td <b>$preis</b> </td>
                    <td <b>$total</b> </td>
                    <td <b>$pers</b> </td>";
            
            $row .="</tr>";

            echo  $row;
            

        }

    }
?>

</table>

<?php
    echo $sayfalamaHTML;
?>