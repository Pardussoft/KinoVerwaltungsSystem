<?php
//seçili gelirse
$filmID=-1;
$vorfuhrungID="";

if (isset($_GET["film"])) {
  $filmID =$_GET["film"];
  $vorfuhrungID=$_GET["vorfuhrung"]; 
}

?>

<div class="modal fade" id="ComplettModal" tabindex="-1" role="dialog" aria-labelledby="Film Master" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 id="ComplettTitle" class="modal-title">Verkaufsübersicht</h4>
        </div>
        <div id="ComplettBody" class="modal-body">
        Verkauf 
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Nein</button>
          <button id="jaButtonCoplette" data-dismiss="modal" class="btn btn-warning" type="button" Onclick="kaydet();">Complette</button>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">

function kaydet() {
  $.ajax ({
    url:"ajax/verkauf_verwalten.php",
    data: $("#verkauf_form").serialize() + "&islem=complett&sitz=" + sitzIDList,
    type:"POST",
    success: function(rtn) {
     console.log(rtn);
      var cevap = JSON.parse(rtn);
      if (cevap.basarim>0) {
          mesajKutusu("Verkauf",  "Der Verkaufsprozess wurde erfolgreich abgeschlossen.");
        
          btnList = document.getElementsByClassName("leerer_platz");

          for(i=0; i<btnList.length; i++) {
            if (btnList[i].style.background=="red") { 
              btnList[i].style.background="gray";
              btnList[i].style.color="black";
             
              btnList[i].disabled=true;

            }
          }

      }
      else
        mesajKutusu("Error", "Konnte nicht hinzufügen!" + cevap.mesaj);
    }
  });

}

function vorfuhrungListe() {
  
  $.ajax ({
    url:"ajax/vorfuhrung_liste.php",
    data: $("#verkauf_form").serialize()+"&vorfuhrung=<?php echo $vorfuhrungID;?>",
    type:"POST",
    success: function(rtn) {
    //  alert(rtn);
      var cevap = JSON.parse(rtn);
      
      if (cevap.basarim>0) {
        $("#vorfuhrung_liste").html(cevap.liste);
        $("#sitz_liste").html("");
        //document.getElementById("vorfuhrung_liste").innerHTML=cevap.liste;
		    //mesajKutusu("Saal",cevap.liste);
		
      }
      else {
        mesajKutusu("Error","Konnte nicht hinzufügen!" + cevap.mesaj);
      }
    }
  });
  
}



function sitzplatzListe() {
    
    $.ajax ({
      url:"ajax/sitzplatz_liste.php",
      data: $("#verkauf_form").serialize(),
      type:"POST",
      success: function(rtn) {
       
        console.log(rtn);
        var cevap = JSON.parse(rtn);
        
        if (cevap.basarim>0) {
         $("#sitz_liste").html(cevap.liste);
     
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

  var sitzList="";
  var sitzIDList="";


  function sec(btn, reih, plat) {

    if (btn.style.background=="red")
      btn.style.background="green";
    else  
      btn.style.background="red";
  
    btnList = document.getElementsByClassName("leerer_platz");

    sitzList="";
    sitzIDList="";

    for(i=0; i<btnList.length; i++) {
      if (btnList[i].style.background=="red") { 
        sitzIDList += btnList[i].id + ", "
        sitzList +="p"+btnList[i].innerHTML.trim() +", ";

      }
    }

    if (sitzList!="") {
      sitzList = sitzList.substring(0, sitzList.length-2);
      sitzIDList = sitzIDList.substring(0, sitzIDList.length-2);
    }

  }

  var dt = new Date();

  function VerkaufSubersicht() {
      if (sitzList=="") {
        mesajKutusu("Uyarı", "Lütfen önce koltuk seçiniz.");
        return;
      }
      var typ = $("#typ :selected").html();
      var film = $("#filmID :selected").text();
      var saal = $("input[name='vorfuhrung']:checked").attr("id");
      var sitz = sitzList;
    

      h  ="<div style='margin:5px;'>";
        h += "<h3 class='text-center'>Verkauf</h3>"; 
        h += "<p><b>Type :</b>" + typ +"</p>";
        h += "<p><b>Filme:</b>" + film +"</p>";
        h += "<p><b>Saal :</b>" + saal +"</p>";
        h += "<p><b>Date :</b>" + (dt.getMonth()+1) + "-" + dt.getDate() + "-" +  dt.getFullYear() + "</p>";
        h += "<br/>"; 
        h += "<h4><b>Sitzpplatz: </b>" + sitz +"</h4s>";
    h +="</div>";

      $("#ComplettBody").html(h);
      $("#ComplettModal").modal('show');

  }

  function printArea(areaName)
    {
        var printContents = document.getElementById(areaName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
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

                  <form id="verkauf_form" class="form-validate form-horizontal" OnSubmit="event.preventDefault();">      

                  <div class="form-group">
                    <label for="typ" class="control-label col-lg-2">Type:</label>
                    <div class="col-lg-10">
                      <select id="typ" name="typ" class="form-control">
                        <option value="0">Normal</option>
                        <option value="1">Rabatt</option>
                      </select>
                    </div>
                  </div>

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

                        echo selectYapSorgu($conn, $sql, "FilmID", "Titel", $filmID, "filmID","form-control","vorfuhrungListe()"); 
                        
                        ?>
                        </div>
                    </div>
                  
                  
                    <div class="form-group " style="padding-left:15px; padding-right:17px;">
                      <label for="vorfuhrung_liste" class="control-label col-lg-2">Vorfugrung Liste:</label>
                      <div class="col-lg-10 text-left" id="vorfuhrung_liste" style="border:1px solid #eeeeee;border-radius: 5px;">
                        ...
                      </div>
                    </div>


                   
                    
                  </form>
                  
                  <div class="form-group text-right" style="margin-top:15px;">

                      <label for="sitz_liste" class="control-label col-lg-2">Sitzplatzauswahl:</label>
                     
                      <div class="col-lg-10 text-left"style="border:1px solid #eeeeee;border-radius: 5px; padding:5px;">
                        <table>
                          <tr><td class='leerer_platz'>Leerer</td><td class=''>&nbsp;&nbsp;</td><td class='voller_platz'>Voller</td></tr>
                        </table>

                        <div  id="sitz_liste" >
                          ...
                        </div>
                      </div>
                  </div>

                
                  <div class="form-group"  >
                      <div class="col-lg-offset-2 col-lg-10" style="margin-top:30px;">
                        <button class="btn btn-primary" type="button" data-toggle="modal"  OnClick="VerkaufSubersicht();">Komplett</button>
                        <button class="btn btn-default" type="button" OnClick="geriGit();">Stornieren</button>
                      </div>
                    </div>
                </div>
              </div>
            </section>
          </div>
        </div>