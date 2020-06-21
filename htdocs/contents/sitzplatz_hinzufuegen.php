<script type="text/javascript">

function kaydet(event) {

  event.preventDefault();

  $.ajax ({
    url:"ajax/sitzplatz_verwalten.php",
    data: $("#sitzplatz_form").serialize() + "&islem=ekle",
    type:"POST",
    success: function(cevap) {
      //  alert(cevap);
      var cevap = JSON.parse(cevap);
      if (cevap.basarim>0) {
        yonlendir2("/index.php?cat=sitzplatz_verwalten&id=" + cevap.basarim);
      }
      else
        alert("Konnte nicht hinzufügen!" + cevap.mesaj);
    }
  });

}

</script> 

<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Neuer Platz
              </header>
              <div class="panel-body">
                <div class="form">

                  <form id="sitzplatz_form" class="form-validate form-horizontal" OnSubmit="kaydet(event);">
                    
                  <div class="form-group ">
                      <label for="saal_NR" class="control-label col-lg-2">Filmberühmtheit</label>
                      <div class="col-lg-10">
                        <?php echo selectYap($conn, "saal", "Saal_NR", "Filmberühmtheit", -1, "saal_NR",0,"form-control"); ?>
                        </div>
                    </div>

                    <div class="form-group ">
                      <label for="reihennummer" class="control-label col-lg-2">Reihennummer</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="reihennummer" name="reihennummer" type="number" min="0"  required/>
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="platznummer" class="control-label col-lg-2">Platznummer</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="platznummer" name="platznummer" type="number" min="0"  required/>
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