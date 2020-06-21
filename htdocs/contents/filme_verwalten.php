
   <?php
    $filmeID= getValue("id","");
    
    if ($filmeID == "") {
      die("");
    }
 
  
    $sql ="Select * from filme Where FilmID=$filmeID";

    $result = $conn->query($sql);

    if ($result) {
      if ($result->num_rows>0) {

        $rec = $result->fetch_assoc();
        $titel= $rec["Titel"];
        $douer= $rec["Dauer"];
        $fsk= $rec["FSK"]==1 ? "Checked" : "";
        $bild = $rec["Bild"];

        if ($bild=="")
          $bild="default.png";
        
      }
    }
    
  ?>


  <script>

    function filmSil() {
     veriIslem("sil");
    }
    
    function veriIslem(islem){
   

        $.ajax({

          url:"../ajax/filme_verwalten.php",
          data: $("#film_form").serialize()+"&islem="+islem,
          type:"POST",
          success: function (cevap) {

            cevap = JSON.parse(cevap);
            
            if (cevap.basarim=="1") {
              mesajKutusu("Film Verwaltung","Der Vorgang wurde erfolgreich durchgeführt!");
              if (islem=="sil")
                yonlendir3("/?cat=filme_zeigen");
            }
            else {
             // document.getElementById("mesajButton").click();
              mesajKutusu("Film Verwaltung",cevap.mesaj);
            
            }
            
          }
        
        });
       
   }

   function filmeBild() {
		
		var form_data = new FormData(); // Form data objesini çağır
		form_data.append("filmeBildFile", filmeBildFile.files[0]); // append metodu ile dosyayı ekle. 1.parametre isimi 2.parametre ise seçtiğimiz dosya 
		
		$(this).ajaxError(function(event,xhr,opt,exc){
			//mesajKutusu("Hata", opt.url + ": " + xhr.status + " " + xhr.statusText + " " + xhr.responseText + " "  + exc);
			mesajKutusu("Error", xhr.responseText);
		});

		$.ajax({  // Ajax isteği başlat
			url:"../loadFilmeBild.php?&id=<?php echo $filmeID; ?>", // resim_yukle.php dosyasına istek gönder
			data:form_data, // Veri olarak form data değişkeni içerisine depoladığımız değeleri gönder
			processData: false,
			contentType: false,
			type:"POST", // İsteğimizin tipi post olsun
			dataType:"json", // Geriye json olarak değer göndersin
			success:function(cevap)  // İstek başarılıysa
			{
				if(cevap.basarili == "1")  // Json ile gönderilen basarili değerini varsa çalıştır
				{
					$("#filmeBildImg").attr("src","/img/filme/" + cevap.resimIsim + "?timestamp=" + new Date().getTime()); // new Date().getTime() tarayıcıyı resmi yeniden yüklemeye zorluyoruz.
				}else
				{
					mesajKutusu("Hata", cevap.hata);
				}
			}

		});
	}

  </script>

<section class="panel">
    <div class="panel-body">
        <a class="btn btn-primary" href="/?cat=filme_hinzufuegen">Neuer Film</a>
    </div>
</section>

<div class="row">
		<div class="col-lg-4">
            <section class="panel">
              <header class="panel-heading">
				Filme Bild
			  </header>
			   <img id="filmeBildImg" src="../img/filme/<?php echo $bild;?>" style="width:100%;" border="0" alt="">
			    <div class="form-group ">
				<input type="file" name="filmeBildFile" id="filmeBildFile" class="form-control" Onchange="filmeBild(this);">
				</div>
			 </section>
		</div>
          <div class="col-lg-8">
            <section class="panel">
              <header class="panel-heading">
               Filme Info 
              </header>
              <div class="panel-body">
                <div class="form">

                  <form class="form-validate form-horizontal " id="film_form" method="post" action="">
                    <input type="hidden" name="filmeID" value="<?php echo $filmeID;?>">
                    <div class="form-group ">
                      <label for="dauer" class="control-label col-lg-2">Titel</label>
                      <div class="col-lg-10">
                        <input value="<?php echo $titel;?>" class=" form-control" id="dauer" name="titel" type="text" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="dauer" class="control-label col-lg-2">Dauer</label>
                      <div class="col-lg-10">
                        <input value="<?php echo $douer;?>" class=" form-control" id="dauer" name="dauer" type="number" min="0"  required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="fsk" class="control-label col-lg-2">FSK</label>
                      <div class="col-lg-10">
                        <input <?php echo $fsk;?> type="checkbox" style="width: 20px" class="checkbox form-control" id="fsk" name="fsk"  value="1" />
                      </div>
                    </div>
                    </form>

                    <div class="form-group">

                      <button id="silButton" class="btn btn-warning" OnClick="onayKutusu('Filmlöschen','Wollen Sie diesen Film wirklich löschen?',filmSil);">Delete</button>
                      <button id="guncelleButton" class="btn btn-primary"  style="float:right;" type="submit" OnClick="veriIslem('guncelle')">Update</button>
               
                    </div>
                </div>
              </div>
            </section>
          </div>
        </div>