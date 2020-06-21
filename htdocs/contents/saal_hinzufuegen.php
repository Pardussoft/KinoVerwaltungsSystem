<script type="text/javascript">

function kaydet(event) {

  event.preventDefault();

  $.ajax ({
    url:"ajax/saal_verwalten.php",
    data: $("#film_form").serialize() + "&islem=ekle",
    type:"POST",
    success: function(cevap) {
      var cevap = JSON.parse(cevap);
      if (cevap.basarim>0) {
        yonlendir2("/index.php?cat=saal_verwalten&id=" + cevap.basarim);
      }
      else
        alert("Der Vorgang konnte nicht durchgeführt werden!" + cevap.mesaj);
    }
  });

}

</script> 

<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Neuen Film hinzufügen 
              </header>
              <div class="panel-body">
                <div class="form">

                  <form id="film_form" class="form-validate form-horizontal" OnSubmit="kaydet(event);">

                    <div class="form-group ">
                      <label for="fullname" class="control-label col-lg-2">Filmberühmtheit</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="filmberühmtheit" name="filmberühmtheit" type="text" required />
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