

<script type="text/javascript">

function kaydet(e) {

  e.preventDefault();
    
  $.ajax ({
    url:"ajax/reservierung_verwalten.php",
    data: $("#reservierung_form").serialize() + "&islem=ekle",
    type:"POST",
    success: function(rtn) {
     console.log(rtn);
      var cevap = JSON.parse(rtn);
      if (cevap.basarim>0) {
          mesajKutusu("Reservierung",  "Der Reservirungprozess wurde erfolgreich abgeschlossen.");
          yonlendir2("/index.php?cat=reservierung_verwalten&id=" + cevap.basarim);
      }
      else {
        mesajKutusu("Error", "Konnte nicht hinzufügen!" + cevap.mesaj);
      }
    }
  });

}

function vorfuhrungListe() {
    
    $.ajax ({
      url:"ajax/vorfuhrung_liste.php",
      data: $("#reservierung_form").serialize(),
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

</script> 

<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Neuer Vorführung
              </header>
              <div class="panel-body">
                <div class="form">

                  <form id="reservierung_form" class="form-validate form-horizontal" OnSubmit="kaydet(event);">      

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

                        echo selectYapSorgu($conn, $sql, "FilmID", "Titel", -1, "filmID","form-control","vorfuhrungListe()"); 
                        
                        ?>
                        </div>
                    </div>

                    <div class="form-group " style="padding-left:15px; padding-right:17px;">
                      <label for="vorfuhrung_liste" class="control-label col-lg-2">Vorfugrung Liste:</label>
                      <div class="col-lg-10 text-left" id="vorfuhrung_liste" style="border:1px solid #eeeeee;border-radius: 5px;">
                        ...
                      </div>
                    </div>
                    
                    <div class="form-group ">
                      <label for="vorname" class="control-label col-lg-2">Vorname:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="vorname" name="vorname" type="text" required />
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="nachname" class="control-label col-lg-2">Nachname:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="nachname" name="nachname" type="text" required />
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="platzanzahi" class="control-label col-lg-2">Platzanzahi:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="platzanzahi" name="platzanzahi" type="number" min="0" required />
                      </div>
                    </div>

                                 
                    <div class="form-group"  >
                        <div class="col-lg-offset-2 col-lg-10" style="margin-top:30px;">
                        <button class="btn btn-primary" type="submit"  >Komplett</button>
                        <button class="btn btn-default" type="button" OnClick="geriGit();">Stornieren</button>
                        </div>
                    </div>


                   
                    
                  </form>
              

                
                
                </div>
              </div>
            </section>
          </div>
        </div>