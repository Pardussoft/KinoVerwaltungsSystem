
 
  <script>
    function filmSil() {
     veriIslem("sil");
    }
    
    function veriIslem(islem){
   

        $.ajax({

          url:"../ajax/sitzplatz_verwalten.php",
          data: $("#film_form").serialize()+"&islem="+islem,
          type:"POST",
          success: function (cevap) {
alert(cevap);
            cevap = JSON.parse(cevap);
            
            if (cevap.basarim=="1") {
              mesajKutusu("Sitzplatz Verwaltung","Der Vorgang wurde erfolgreich durchgeführt!");
              if (islem=="sil")
                yonlendir3("/?cat=sitzplatz_liste");
            }
            else {
             // document.getElementById("mesajButton").click();
              mesajKutusu("Sitzplatz Verwaltung",cevap.mesaj);
            
            }
            
          }
        
        });
       
   }


  </script>

<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=sitzplatz_hinzufuegen">Neuer Platz</a>
    </div>
</section>


  <?php
    $sitzID= getValue("id","");
    
    if ($sitzID == "") {
      die("");
    }
 
  
    $sql ="Select * from sitzplatz Where SitzID=$sitzID";

    $result = $conn->query($sql);

    if ($result) {
      if ($result->num_rows>0) {

        $rec = $result->fetch_assoc();
        $sitzID = $rec["SitzID"];
        $reihennummer= $rec["Reihennummer"];
        $platznummer= $rec["Platznummer"];
        $saal_NR= $rec["Saal_NR"];
      }
    }
    
  ?>


<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               Sitzplatz Verwalten 
              </header>
              <div class="panel-body">
                <div class="form">

                  <form class="form-validate form-horizontal " id="film_form" method="post" action="">
                    <input type="hidden" name="sitzID" value="<?php echo $sitzID;?>">
                    <div class="form-group ">
                      <label for="saal_NR" class="control-label col-lg-2">Filmberühmtheit</label>
                      <div class="col-lg-10">
                        <?php echo selectYap($conn, "saal", "Saal_NR", "Filmberühmtheit",  $saal_NR, "saal_NR", 0, "form-control"); ?>
                        </div>
                    </div>

                    <div class="form-group ">
                      <label for="reihennummer" class="control-label col-lg-2">Reihennummer</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="reihennummer" name="reihennummer" type="number" min="0"  value="<?php echo $reihennummer; ?>" required/>
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="platznummer" class="control-label col-lg-2">Platznummer</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="platznummer" name="platznummer" type="number" min="0"  value="<?php echo $platznummer; ?>" required/>
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