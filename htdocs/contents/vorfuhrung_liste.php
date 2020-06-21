<script>


    function offnen(vorfuhrungID) {
       yonlendir("/?cat=vorfuhrung_verwalten&id="+vorfuhrungID);    
    }
    
    var vorfuhrungID=-1;


   
    function loschen() {
        $.ajax({
            url:"../ajax/vorfuhrung_verwalten.php",
            data: "vorfuhrungID=" + vorfuhrungID + "&islem=sil",
            type:"POST",
            success: function (cevap) {
                cevap = JSON.parse(cevap);
               
                if (cevap.basarim==1) {
                    var tr = document.getElementById("tr"+vorfuhrungID);
                    tr.style.display="none";
                }
                else {
                    alert(cevap.mesaj);
                }
            }
            
        });
       
    }

    
    function silmeIcinVorfuhrungIDBelirle(id) {
        vorfuhrungID=id;
        onayKutusu("Vorführung Löschen","Möchten Sie diesen Film löschen?", loschen);
    }

</script>
<?php    if ($_SESSION["Position"]<=1) { ?> 

<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=vorfuhrung_hinzufuegen">Neuer Vorfuhrung</a>
    </div>
</section>

<?php } ?>

<?php
    $sayfaNo = (int) getValue("seit_nr", 1);
    $kayitSayisi=  (int) getValue("eintrag_nr", 20);
    $saal_nr = (int) getValue("saal_NR", "0");
	$filmID = (int) getValue("filmID", "0");

    $sayfalamaHTML =  sayfala($conn, "vorfuhrung", $sayfaNo, $kayitSayisi, $cat,"saal_NR=$saal_nr&filmID=$filmID");
   
  
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
	<th>Filme</th>
	<th>Saal</th>
	<th>Beginn</th>
	<th>Ende</th>
	<th></th>
</tr>

<?php


$sql = "SELECT
			vorfuhrung.*,
			saal.Filmberühmtheit,
			filme.Titel
		FROM
			vorfuhrung
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
                filme.Titel,
                saal.Filmberühmtheit,
                vorfuhrung.Beginn
				;";

    //echo $sql;
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows>0) {

            while ($rec = $result->fetch_assoc()) {
                $vorfuhrungID= $rec["VorfuhrungID"];
                $beginn = $rec["Beginn"];
                $ende = $rec["Ende"];
                $filmberühmtheit=$rec["Filmberühmtheit"];
				$film = $rec["Titel"];
                $row = "<tr id='tr$vorfuhrungID'>";
                    $row .= "
							<td><b class='text-primary'>$vorfuhrungID</b></td>
							<td class='text-left'>$film</td>
							<td class='text-left'>$filmberühmtheit</td>
							<td class='text-left'>$beginn</td>
							<td class='text-left'>$ende</td>";
                   
                         $row .= "<td class='text-right'>";
                         if ($_SESSION["Position"]<=1) {
                            $row .="<button class='btn btn-primary' style='margin-right:10px;' OnClick='offnen($vorfuhrungID);'>öffnen</button>";
                            $row .="<buttun id='silButton' class='btn btn-warning' data-toggle='modal' ' OnClick='silmeIcinVorfuhrungIDBelirle($vorfuhrungID);'>Löschen</button>";
                         }    
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

