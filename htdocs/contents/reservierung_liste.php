<script>


    function offnen(resNR) {
       yonlendir("/?cat=reservierung_verwalten&id="+resNR);    
    }
    
    var resNR=-1;
  
    function loschen() {
        $.ajax({
            url:"../ajax/reservierung_verwalten.php",
            data: "ResNR=" + resNR + "&islem=sil",
            type:"POST",
            success: function (rtn) {
            //    alert(rtn);
                cevap = JSON.parse(rtn);
               
                if (cevap.basarim==1) {
                    var tr = document.getElementById("tr"+resNR);
                    tr.style.display="none";
                }
                else {
                    alert(cevap.mesaj);
                }
            }
            
        });
    }

    
    function silmeIcinReservierungIDBelirle(id) {
        resNR=id;
        onayKutusu("Reservierung Löschen","Möchten Sie diesen Film löschen?", loschen);
    }

</script>

<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=reservierung_hinzufuegen">Neuer Reservierung</a>
    </div>
</section>

<?php
    $sayfaNo = (int) getValue("seit_nr", 1);
    $kayitSayisi=  (int) getValue("eintrag_nr", 20);

    

    $saal_nr = (int) getValue("saal_NR", "0");
	$filmID = (int) getValue("filmID", "0");

    $sayfalamaHTML =  sayfala($conn, "reservierung", $sayfaNo, $kayitSayisi, $cat);
   
  
    $kayitBaslangic = $kayitSayisi * ($sayfaNo-1);
?>

<form id="filter_form" method="GET" style="margin-bottom:5px;" action="">
    <input type="hidden" name="cat" value="<?php echo  $cat;?>">
    <input type="hidden" name="seit_nr" value="<?php echo $sayfaNo;?>">
	
	<section class="panel" >
		<header class="panel-heading">
               Filters
        </header>
		<div class="row panel-body">
			<div class="col-lg-6">
				<h5>Saal:</h5>
				<?php  echo selectYap($conn, "saal", "Saal_NR", "Filmberühmtheit",  $saal_nr, "saal_NR",1,"form-control"); ?>
			</div>

			<div class="col-lg-6">
				<h5>Filme:</h5>
				<?php  echo selectYap($conn, "filme", "FilmID", "Titel",  $filmID, "filmID",1,"form-control"); ?>
			</div>
		</div>
	</section>
</form>

<script>

$(document).ready( function() {

    $("#saal_NR").change(function() {
        $("#filter_form").submit();
    });

	$("#filmID").change(function() {
        $("#filter_form").submit();
    });

});

</script>

<?php  echo $sayfalamaHTML;?>
<table class="table" OnClick="">
<tr>
	<th>ID</th>
    <th>Vorname</th>
	<th>Nachname</th>
	<th>Filme</th>
	<th>Saal</th>
    <th>Anzahl</th>
    <th>Beginn</th>
    <th>Ende</th>
    <th>Reserviert Bis</th>
	<th></th>
</tr>

<?php


$sql = "SELECT
			reservierung.*,
			saal.Filmberühmtheit,
			filme.Titel,
            vorfuhrung.Beginn,
            vorfuhrung.Ende,
            datediff(vorfuhrung.Beginn, Now())as Reserviert_bis
		FROM
			reservierung
        INNER JOIN vorfuhrung ON vorfuhrung.VorfuhrungID=reservierung.VorfuhrungID
		INNER JOIN saal ON vorfuhrung.Saal_NR = saal.Saal_NR
        INNER JOIN filme ON vorfuhrung.FilmID = filme.FilmID";

if ($saal_nr!=0)
	$sql .=" WHERE vorfuhrung.Saal_NR=$saal_nr ";

if ($filmID!=0){
	if ($saal_nr!=0)
		$sql .=" AND vorfuhrung.FilmID=$filmID ";
	else
		$sql .=" WHERE vorfuhrung.FilmID=$filmID ";
}

			
$sql .=	" ORDER BY
				saal.Filmberühmtheit,
				filme.Titel;";

    //echo $sql;
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows>0) {

            while ($rec = $result->fetch_assoc()) {
                $resNR= $rec["ResNR"];
                $vorname = $rec["Vorname"];
                $nachname = $rec["Nachname"];
                $saal=$rec["Filmberühmtheit"];
                $film = $rec["Titel"];
                $bis = $rec["Reserviert_bis"];
                $anzahl = $rec["Platzanzahi"];
                $beginn = $rec["Beginn"];
                $ende= $rec["Ende"];
                $row = "<tr id='tr$resNR'>";
                    $row .= "
                            <td><b class='text-primary'>$resNR</b></td>
                            <td class='text-left'>$vorname</td>
							<td class='text-left'>$nachname</td>
							<td class='text-left'>$film</td>
                            <td class='text-left'>$saal</td>
                            <td class='text-left'>$anzahl</td>
                            <td class='text-left'>$beginn</td>
                            <td class='text-left'>$ende</td>";

                            if ($bis>1)
                                $row .= "<td class='text-left'>$bis</td>";
                            else
                                $row .= "<td class='text-left' style='background:red;'>$bis</td>";
                   
                         $row .="<td class='text-right'>";
                         $row .="<button class='btn btn-primary' style='margin-right:10px;' OnClick='offnen($resNR);'>öffnen</button>";
                         $row .="<buttun id='silButton' class='btn btn-warning' data-toggle='modal' ' OnClick='silmeIcinReservierungIDBelirle($resNR);'>Löschen</button>";
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

