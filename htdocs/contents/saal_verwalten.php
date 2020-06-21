
 
  <script>
    function saalSil() {
     veriIslem("sil");
    }
    
    function veriIslem(islem){
   

        $.ajax({

          url:"../ajax/saal_verwalten.php",
          data: $("#saal_form").serialize()+"&islem="+islem,
          type:"POST",
          success: function (cevap) {

            cevap = JSON.parse(cevap);
            
            if (cevap.basarim=="1") {
              mesajKutusu("Saal Verwaltung","Der Vorgang wurde erfolgreich durchgeführt!");
              if (islem=="sil")
                yonlendir3("/?cat=saal_liste");
            }
            else {
              mesajKutusu("saal Verwaltung",cevap.mesaj);
           
            }
            
          }
        
        });
       
   }


  </script>

<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=saal_hinzufuegen">Neuer saal</a>
    </div>
</section>


  <?php
    $Saal_NR= getValue("id","");
    
    if ($Saal_NR == "") {
      die("");
    }
 
  
    $sql ="Select * from saal Where Saal_NR=$Saal_NR";

    $result = $conn->query($sql);

    if ($result) {
      if ($result->num_rows>0) {

        $rec = $result->fetch_assoc();
        $filmberühmtheit= $rec["Filmberühmtheit"];
       
      }
    }
    
  ?>


<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               Saal Verwalten 
              </header>
              <div class="panel-body">
                <div class="form">

                  <form class="form-validate form-horizontal " id="saal_form" method="post" action="">
                    <input type="hidden" name="Saal_NR" value="<?php echo $Saal_NR;?>">
                    <div class="form-group ">
                      <label for="filmberühmtheit" class="control-label col-lg-2">Filmberühmtheit</label>
                      <div class="col-lg-10">
                        <input value="<?php echo $filmberühmtheit;?>" class=" form-control" id="filmberühmtheit" name="filmberühmtheit" type="text" required />
                      </div>
                    </div>
                    </form>
                    <br/>
                    <div class="form-group" >
                      <button id="silButton" class="btn btn-warning" OnClick="onayKutusu('Saallöschen','Wollen Sie diesen Saal wirklich löschen?',saalSil);">Delete</button>
                      <button id="guncelleButton" class="btn btn-primary"  style="float:right;" type="submit" OnClick="veriIslem('guncelle')">Update</button>
               
                    </div>
                </div>
              </div>
            </section>
          </div>
        </div>