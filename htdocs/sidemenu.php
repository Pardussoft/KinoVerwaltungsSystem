  
  <!--
    Anfi yönetimi...
    Anfi-film ilişkilendirme
    Film ve anfi seçip koltuk rezervasyonu...

-->
  <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="">
            <a class="" href="index.php">
                          <i class="icon_house_alt"></i>
                          <span>Homepage</span>
                      </a>
          </li>

<?php    if ($_SESSION["Position"]<=1) { ?> <!-- Yönetici veya master erişebilir menü -->

        <li class="sub-menu" id="personal_menu">
            <a id="filme" href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Kinnopersonal</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="/?cat=personal_liste"><i class="fa fa-list"></i> Personalliste</a></li>
              <li><a class="" href="/?cat=personal_hinzufuegen"><i class="fa fa-plus"></i>Personal Hinz.</a></li>
    
            </ul>
          </li>

          <li class="sub-menu" id="filme_menu">
            <a id="filme" href="javascript:;" class="">
                          <i class=" icon_film"></i>
                          <span>Filme</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="/?cat=filme_zeigen"><i class="fa fa-list"></i> Filmliste</a></li>
              <li><a class="" href="/?cat=filme_hinzufuegen"><i class="fa fa-plus"></i>Film Hinzufuegen</a></li>
    
            </ul>
          </li>

          <li class="sub-menu" id="saal_menu">
            <a id="saal" href="javascript:;" class="">
                          <i class=" icon_clipboard "></i>
                          <span>Säle</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="/?cat=saal_liste"><i class="fa fa-list"></i>Saalliste</a></li>
              <li><a class="" href="/?cat=saal_hinzufuegen"><i class="fa fa-plus"></i>Saal Hinzufuegen</a></li>
              <li><a class="" style="background-color:#993300;" href="/?cat=sitzplatz_liste"><i class="fa fa-list"></i>Sitzplatzliste</a></li>
              <li><a class="" style="background-color:#993300;" href="/?cat=sitzplatz_hinzufuegen"><i class="fa fa-plus"></i>Sitzplatz Hinz.</a></li>
			  <li><a class="" style="background-color:#993300;" href="/?cat=sitzplatz_hinzufuegen_multipel"><i class="fa fa-plus"></i>Sitzplatz Multipel H.</a></li>
            </ul>
          </li>

         

<?php  } ?>      

        <li class="sub-menu" id="vorfuhrung_menu">
            <a id="vorfuhrung" href="javascript:;" class="">
                          <i class="icon_star_alt"></i>
                          <span>Vorführung</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li  ><a class="" href="/?cat=vorfuhrung_liste"><i class="fa fa-list"></i>Vorführungliste</a></li>
            
            <?php    if ($_SESSION["Position"]<=1) { ?> 
              <li><a class="" href="/?cat=vorfuhrung_hinzufuegen"><i class="fa fa-plus"></i>Vorführung Hinz.</a></li>
            <?php } ?>
            
            </ul>
          </li>

          <li class="sub-menu" id="verkauf_menu">
            <a id="verkauf" href="javascript:;" class="">
                          <i class=" icon_cart "></i>
                          <span>Verkauf</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li  ><a class="" href="/?cat=verkauf_liste"><i class="fa fa-list"></i>Verkaufliste</a></li>
              <li><a class="" href="/?cat=verkauf_hinzufuegen"><i class="fa fa-plus"></i>Verkauf Hinz.</a></li>
            </ul>
          </li>

          <li class="sub-menu" id="reservierung_menu">
            <a id="verkauf" href="javascript:;" class="">
                          <i class="arrow_carrot-2down_alt2 "></i>
                          <span>Reservierung</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li  ><a class="" href="/?cat=reservierung_liste"><i class="fa fa-list"></i>Reservierungliste</a></li>
              <li><a class="" href="/?cat=reservierung_hinzufuegen"><i class="fa fa-plus"></i>Reservierung Hinz.</a></li>
            </ul>
          </li>


        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <script>
    $(document).ready( function () {
      
      var cat = "<?php echo $cat; ?>";

      if (cat!="") {
        var pos =  cat.indexOf("_");
        var sub = cat.substr(0,pos);
        if (sub=="sitzplatz")
          sub="saal";

        var menu_id=sub+"_menu";
        
        document.getElementById(menu_id).className += " active"; 
      }
      
    });

      

    </script>