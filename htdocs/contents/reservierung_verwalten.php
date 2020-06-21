
   <?php
    $resNR= getValue("id","");
    
    if ($resNR == "") {
        echo "<h2>None Reservierun VR!</h2>";
    }
 
  
    $sql = "SELECT
			reservierung.*,
			saal.Filmberühmtheit,
			filme.Titel, 
      filme.FilmID,
      datediff(vorfuhrung.Beginn, Now())as Reserviert_bis
		FROM reservierung
    INNER JOIN vorfuhrung ON vorfuhrung.VorfuhrungID=reservierung.VorfuhrungID
    INNER JOIN saal ON vorfuhrung.Saal_NR = saal.Saal_NR
    INNER JOIN filme ON vorfuhrung.FilmID = filme.FilmID
    Where ResNR=$resNR";

    $result = $conn->query($sql);

    if ($result) {
      if ($result->num_rows>0) {

        $rec = $result->fetch_assoc();
   
        $vorname = $rec["Vorname"];
        $nachname = $rec["Nachname"];
        $saal=$rec["Filmberühmtheit"];
        $film = $rec["Titel"];
        $bis = $rec["Reserviert_bis"];
        $platzanzahi = $rec["Platzanzahi"];
        $filmID=$rec["FilmID"];
        $vorfuhrung=$rec["VorfuhrungID"];
       
      }
    }
    
    if (!isset($vorname)) {
        echo "<h2>Reservierun VR problem!</h2>";
    }
    
  ?>

  <script>
    function reservierungSil() {
     veriIslem("sil");
    }
    
    function veriIslem(islem){
    
      $.ajax({
          url:"../ajax/reservierung_verwalten.php",
          data: $("#reservierung_form").serialize()+"&islem="+islem,
          type:"POST",
          success: function (rt) {
           //alert(rt);
            cevap = JSON.parse(rt);
            
            if (cevap.basarim=="1") {
              mesajKutusu("Reservierung Verwaltung","Der Vorgang wurde erfolgreich durchgeführt!");
              if (islem=="sil" || islem=="complett") {
                yonlendir2("/?cat=reservierung_liste");
              }
              else {
                window.refresh();
              }
            }
            else {
              mesajKutusu("Reservierung Verwaltung",cevap.mesaj);
           
            }
            
          }
        
        });
       
   }

   function vorfuhrungListe() {
    
    $.ajax ({
      url:"ajax/vorfuhrung_liste.php",
      data: $("#reservierung_form").serialize()+"&vorfuhrung=" + <?php echo $vorfuhrung; ?>,
      type:"POST",
      success: function(rtn) {
        //alert(rtn);
        var cevap = JSON.parse(rtn);
        
        if (cevap.basarim>0) {
          $("#vorfuhrung_liste").html(cevap.liste);
         //document.getElementById("vorfuhrung_liste").innerHTML=cevap.liste;
          //mesajKutusu("Saal",cevap.liste);
          
        }
        else {
          mesajKutusu("Error","Konnte nicht hinzufügen!" + cevap.mesaj);
        }
      }
    });
  }

   $(document).ready( function() {
    vorfuhrungListe();
  });

  function sitzplatzListe() {}

  function reservierungSil() {
    veriIslem('sil');
  }

  function reservierungComplett() {
    veriIslem('complett');
  }
  
  </script>

<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=reservierung_hinzufuegen">Neuer reservierung</a>
    </div>
</section>

<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               Reservierung Verwalten 
              </header>
              <div class="panel-body">
                <div class="form">

                  <form class="form-validate form-horizontal " id="reservierung_form" method="post" action="">
                    <input type="hidden" name="ResNR" id="ResNR" value="<?php echo $resNR;?>">

                     <div class="form-group ">
                      <label for="vorname" class="control-label col-lg-2">Vorname:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="vorname" name="vorname" type="text" required value="<?php echo $vorname; ?>"/>
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="nachname" class="control-label col-lg-2">Nachname:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="nachname" name="nachname" type="text" required   value="<?php echo $nachname; ?>"/>
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="platzanzahi" class="control-label col-lg-2">Platzanzahi:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="platzanzahi" name="platzanzahi" type="number" required  value="<?php echo $platzanzahi; ?>"/>
                      </div>
                    </div>
                    
                    <div class="form-group ">
                      <label for="bis" class="control-label col-lg-2">Reserviert_bis:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="bis" name="bis" type="number" disabled value="<?php echo $bis; ?>"/>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="filmID" class="control-label col-lg-2">Filme:</label>
                      <div class="col-lg-10">
                        <?php 

                        $sql = "
                        Select Distinct vorfuhrung.FilmID, filme.Titel 
                        From vorfuhrung
                        Inner Join filme On vorfuhrung.FilmID=filme.FilmID
                        Where vorfuhrung.Ende>=Now()
                        Order By Titel";

                        echo selectYapSorgu($conn, $sql, "FilmID", "Titel", $filmID, "filmID","form-control","vorfuhrungListe()"); 
                        
                        ?>
                        </div>
                    </div>

                    <div class="form-group " style="padding-left:15px; padding-right:17px;">
                      <label for="vorfuhrung_liste" class="control-label col-lg-2">Vorfugrung Liste:</label>
                      <div class="col-lg-10 text-left" id="vorfuhrung_liste" style="border:1px solid #eeeeee;border-radius: 5px;">
                        ...
                      </div>
                    </div>        
                    
                    </form>
                    <br/>
                    <div class="form-group" >
                      <button id="silButton" class="btn btn-warning" OnClick="onayKutusu('Saallöschen','Wollen Sie diesen Saal wirklich löschen?',reservierungSil);">Delete</button>
                      <button id="guncelleButton" class="btn btn-primary"  style="float:right;" type="submit" OnClick="veriIslem('guncelle')">Update</button>
                      <button id="onaylaButton" class="btn btn-success"  style="position:relative; left:calc(50% - 100px);" type="submit" OnClick="onayKutusu('Buchungsbestätigung','Möchten Sie diese Reservierung wirklich bestätigen?',reservierungComplett); ">Complett</button>
                    </div>
                </div>
              </div>
            </section>
          </div>
        </div>