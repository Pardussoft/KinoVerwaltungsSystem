<!--header start-->
<script>
$(document).ready(function(){

    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("/ajax/liveSearch.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                console.log(data);
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});

</script>
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="/" class="logo">Film <span class="lite">Master</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            <form class="navbar-form search-box">
              <input class="form-control " type="text" autocomplete="off" placeholder="Search" aria-label="Search"
              
              <?php //if ($_SESSION["Position"]>1) echo "disabled"; ?>

              >
              <div class="result col-12 mt-5 card" style="background:white; position:absolute; border:1px solid black;"></div>
            </form>
          </li>
        </ul>
        <!--  search form end -->
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

          <!-- task notificatoin start -->
        
          <!-- alert notification end-->
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" width="25" src="img/avatar.jfif">
                            </span>
                            <span class="username"><?php echo substr($_SESSION["Vorname"],0,1).".".$_SESSION["Nachname"]."(".$_SESSION["Position"].")";?></span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="\?cat=personal_myprofile"><i class="icon_profile"></i> My Profile</a>
              </li>
              <li>
                <a href="\?cat=verkauf_liste&personal=<?php echo $_SESSION["PersonalVR"];?>"><i class="icon_key_alt"></i> Meine Verkäufe</a>
              </li>
              <li>
                <a href="logout.php"><i class="icon_key_alt"></i> Log Out</a>
              </li>
              
            <!--
              <li>
                <a href="#"><i class="icon_mail_alt"></i> My Inbox</a>
              </li>
              <li>
                <a href="#"><i class="icon_clock_alt"></i> Timeline</a>
              </li>
              <li>
                <a href="#"><i class="icon_chat_alt"></i> Chats</a>
              </li>
             
              <li>
                <a href="documentation.html"><i class="icon_key_alt"></i> Documentation</a>
              </li>
              <li>
                <a href="documentation.html"><i class="icon_key_alt"></i> Documentation</a>
              </li>
            -->
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->


    <!-- Modal -->
 <div class="modal fade" id="onayModal" tabindex="-1" role="dialog" aria-labelledby="Film Master" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 id="onayTitle" class="modal-title">Delete?</h4>
        </div>
        <div id="onayBody" class="modal-body">
         Möchten Sie diesen Film löschen?
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Nein</button>
          <button id="jaButton" data-dismiss="modal" class="btn btn-warning" type="button">Ja</button>
        </div>
      </div>
    </div>
  </div>
  <a id="onayButton" class="btn btn-warning" data-toggle="modal" href="#onayModal" style="display:none;"></a>

 <!-- Modal -->
 <div class="modal fade" id="mesajModal" tabindex="-1" role="dialog" aria-labelledby="Film Master" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 id="mesajTitle" class="modal-title">...</h4>
        </div>
        <div id="mesajBody" class="modal-body">
         ...
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-primary" type="button"> Ok</button>
        </div>
      </div>
    </div>
  </div>

  <a id="mesajButton" class="btn btn-warning" data-toggle="modal" href="#mesajModal" style="display:none;"></a>
  <!-- modal -->
