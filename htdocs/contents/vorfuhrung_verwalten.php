
 
  <script>
    function filmSil() {
     veriIslem("sil");
    }
    
    function veriIslem(islem){
   

        $.ajax({

          url:"../ajax/vorfuhrung_verwalten.php",
          data: $("#film_form").serialize()+"&islem="+islem,
          type:"POST",
          success: function (cevap) {
            //alert(cevap);
            cevap = JSON.parse(cevap);
			
            if (cevap.basarim=="1") {

			        mesajKutusu("Vorführung Verwaltung","Der Vorgang wurde erfolgreich durchgeführt!");
              
			        if (islem=="sil")
                  yonlendir2("/?cat=vorfuhrung_liste");
                  
            }
            else {
	 
              mesajKutusu("Vorführung Verwaltung",cevap.mesaj);
            
            }
            
          }
        
        });
       
   }


  </script>

<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=vorfuhrung_hinzufuegen">Neuer Vorführung </a>
    </div>
</section>


  <?php
    $vorfuhrungID= getValue("id","");
    
    if ($vorfuhrungID == "") {
      die("");
    }
 
  
    $sql ="Select * from vorfuhrung Where VorfuhrungID=$vorfuhrungID";

    $result = $conn->query($sql);

    if ($result) {
      if ($result->num_rows>0) {

        $rec = $result->fetch_assoc();
        $vorfuhrungID = $rec["VorfuhrungID"];
        $saal_NR= $rec["Saal_NR"];
        $filmID= $rec["FilmID"];
        $beginn= $rec["Beginn"];
        $ende= $rec["Ende"];
      }
    }
    
  ?>


<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               Vorführung Verwalten 
              </header>
              <div class="panel-body">
                <div class="form">

                  <form class="form-validate form-horizontal " id="film_form" method="post" action="">
                    <input type="hidden" name="vorfuhrungID" value="<?php echo $vorfuhrungID;?>">
                  
				   <div class="form-group ">
                      <label for="filmID" class="control-label col-lg-2">Film:</label>
                      <div class="col-lg-10">
                        <?php echo selectYap($conn, "filme", "FilmID", "Titel", $filmID, "filmID",0,"form-control"); ?>
                        </div>
                    </div>

                  <div class="form-group ">
                      <label for="saal_NR" class="control-label col-lg-2">Saal:</label>
                      <div class="col-lg-10">
                        <?php echo selectYap($conn, "saal", "Saal_NR", "Filmberühmtheit", $saal_NR, "saal_NR",0,"form-control"); ?>
                        </div>
                    </div>

                    <div class="form-group ">
                      <label for="beginn" class="control-label col-lg-2">Beginn</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="beginn" name="beginn" type="date"  value="<?php echo $beginn;?>" required/>
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="ende" class="control-label col-lg-2">Ende</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="ende" name="ende" type="date"  value="<?php echo $ende;?>" required/>
                      </div>
                    </div>
				</form>

                    <br/>
                    <div class="form-group">

                      <button id="silButton" class="btn btn-warning" OnClick="onayKutusu('Filmlöschen','Wollen Sie diesen Film wirklich löschen?',filmSil);">Delete</button>
                      <button id="guncelleButton" class="btn btn-primary"  style="float:right;" type="submit" OnClick="veriIslem('guncelle')">Update</button>
               
                    </div>
                </div>
              </div>
            </section>
          </div>
        </div>