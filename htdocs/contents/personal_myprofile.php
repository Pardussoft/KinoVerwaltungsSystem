
 
  <script>
    function personalSil() {
     veriIslem("sil");
    }
    
    function veriIslem(islem){
   

        $.ajax({

          url:"../ajax/personal_verwalten.php",
          data: $("#personal_form").serialize()+"&islem="+islem,
          type:"POST",
          success: function (rt) {
           // alert(rt);
            cevap = JSON.parse(rt);
            
            if (cevap.basarim=="1") {
              mesajKutusu("Personal Verwaltung","Der Vorgang wurde erfolgreich durchgeführt!");
              if (islem=="sil") {
                yonlendir3("/?cat=personal_liste");
              }
            }
            else {
              mesajKutusu("Personal Verwaltung",cevap.mesaj);
           
            }
            
          }
        
        });
       
   }

  </script>

  <?php
    $PersonalVR=$_SESSION["PersonalVR"];
    
    if ($PersonalVR == "") {
      die("");
    }
 
  
    $sql ="Select * from kinopersonal Where PersonalVR=$PersonalVR";

    $result = $conn->query($sql);

    if ($result) {
      if ($result->num_rows>0) {

        $rec = $result->fetch_assoc();

        $vorname=$rec["vorname"];
        $nachname=$rec["nachname"];
        $email=$rec["email"];
        $position=$rec["position"];
        $svnr=$rec["SVNR"];
        $password=$rec["password"];
       
      }
    }
    
  ?>


<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               My Info 
              </header>
              <div class="panel-body">
                <div class="form">

                  <form class="form-validate form-horizontal " id="personal_form" method="post" action="">
                    <input type="hidden" name="PersonalVR" value="<?php echo $PersonalVR;?>">

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
                      <label for="email" class="control-label col-lg-2">Email:</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="email" name="email" type="email" required  value="<?php echo $email; ?>"/>
                      </div>
                    </div>
                    
                    <div class="form-group ">
                      <label for="position" class="control-label col-lg-2">Position:</label>
                      <div class="col-lg-10">
                        <select class=" form-control" id="position" name="position"  required >
                            <option value="1" <?php echo $position==1?"selected":""; ?> >Manager</option>
                            <option value="2" <?php echo $position==2?"selected":""; ?> >Operator</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="svnr" class="control-label col-lg-2">SVRN</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="svnr" name="svnr" type="number" required  value="<?php echo $svnr; ?>"/>
                      </div>
                    </div>

                   

                    </form>
                    <br/>
                    <div class="form-group" >
                      
                      <button id="guncelleButton" class="btn btn-primary"  style="float:right;" type="submit" OnClick="veriIslem('guncelle')">Update</button>
               
                    </div>
                </div>
              </div>
            </section>
          </div>
        </div>