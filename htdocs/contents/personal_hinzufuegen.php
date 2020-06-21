<script type="text/javascript">

function kaydet(event) {

    event.preventDefault();

    if ($("#password").val() != $("#passwordTek").val())
    {
        mesajKutusu("Error!","Şifreler eşleşmiyor.");
        return;
    }

    $.ajax ({
        url:"ajax/personal_verwalten.php",
        data: $("#personal_form").serialize() + "&islem=ekle",
        type:"POST",
        success: function(rt) {
            var cevap = JSON.parse(rt);
            if (cevap.basarim>0) {
                mesajKutusu("Kinopersonal","Kayıt başarılı.");
                yonlendir2("/index.php?cat=personal_verwalten&id=" + cevap.basarim);
            }
            else {
                mesajKutu("Error", "Konnte nicht hinzufügen!" + cevap.mesaj);
            }
        }
    });

}

</script> 

<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Neuen Personal hinzufügen 
              </header>
              <div class="panel-body">
                <div class="form">

                  <form id="personal_form" class="form-validate form-horizontal" OnSubmit="kaydet(event);">

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
                      <label for="email" class="control-label col-lg-2">Email:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="email" name="email" type="email" required />
                      </div>
                    </div>
                    
                    <div class="form-group ">
                      <label for="position" class="control-label col-lg-2">Position:</label>
                      <div class="col-lg-10">
                        <select class=" form-control" id="position" name="position"  required >
                            <option value="1">Manager</option>
                            <option value="2" selected>Operator</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="svnr" class="control-label col-lg-2">SVRN</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="svnr" name="svnr" type="number" required />
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="password" class="control-label col-lg-2">Password:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="password" name="password" type="password"   required/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="passwordTek" class="control-label col-lg-2">Password(Weider):</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="passwordTek" name="passwordTek" type="password"  required/>
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