<script type="text/javascript">

function kaydet(event) {

  event.preventDefault();

  $.ajax ({
    url:"ajax/vorfuhrung_verwalten.php",
    data: $("#vorfuhrung_form").serialize() + "&islem=ekle",
    type:"POST",
    success: function(cevap) {
    //  alert(cevap);
      var cevap = JSON.parse(cevap);
      if (cevap.basarim>0) {
        mesajKutusu("Vorführung Hinzufuegen","Der Vorgang wurde erfolgreich durchgeführt!");
        yonlendir2("/index.php?cat=vorfuhrung_verwalten&id=" + cevap.basarim);
      }
      else
        mesajKutusu("Error!","Konnte nicht hinzufügen! <br/><br/>" + cevap.mesaj);
    }
  });

}

</script> 

<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Neuer Vorführung
              </header>
              <div class="panel-body">
                <div class="form">

                  <form id="vorfuhrung_form" class="form-validate form-horizontal" OnSubmit="kaydet(event);">
                
                  <div class="form-group ">
                      <label for="filmID" class="control-label col-lg-2">Film:</label>
                      <div class="col-lg-10">
                        <?php echo selectYap($conn, "filme", "FilmID", "Titel", -1, "filmID",0,"form-control"); ?>
                        </div>
                    </div>

                  <div class="form-group ">
                      <label for="saal_NR" class="control-label col-lg-2">Saal:</label>
                      <div class="col-lg-10">
                        <?php echo selectYap($conn, "saal", "Saal_NR", "Filmberühmtheit", -1, "saal_NR",0,"form-control"); ?>
                        </div>
                    </div>

                    <div class="form-group ">
                      <label for="beginn" class="control-label col-lg-2">Beginn:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="beginn" name="beginn" type="date"  required/>
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="ende" class="control-label col-lg-2">Ende:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="ende" name="ende" type="date"  required/>
                      </div>
                    </div>
    
                   
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-default" type="button" OnClick="geriGit();">Cancel</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </section>
          </div>
        </div>