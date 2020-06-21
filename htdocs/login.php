<?php

error_reporting(E_ALL);

session_start();

if (isset($_SESSION["Login"]) == true && $_SESSION["Login"]==true) {
    header("Location: index.php");
}

$msg="";
$email="";

if (isset($_POST["email"])) { //aynı dosya, acaba submitlemi geldi



  include "conn.php";
 

  $email= trim($_POST["email"]);
  $password = trim($_POST["password"]);

  $sql = "Select * from kinopersonal Where email='$email' AND password='$password';";

  $result = $conn->query($sql);

  if ($result) {
    if ($result->num_rows > 0) {

      $rec = $result->fetch_assoc();
      
      session_start();
      session_regenerate_id();
      
      $_SESSION["Login"]=true;
      $_SESSION["PersonalVR"]=$rec["PersonalVR"];
      $_SESSION["Position"]=$rec["position"]; //0->Master, 1->Manager, 2->Operator
      $_SESSION["Email"]=$rec["email"];
      $_SESSION["Vorname"]=$rec["vorname"];
      $_SESSION["Nachname"]=$rec["nachname"];
	   $_SESSION["SVNR"]=$rec["SVNR"];
      $_SESSION["Time"] = time();

      header("Location: index.php");
    }
    else {
      $msg="Benutzername oder Passwort ist falsch.";
    }
  }
  else {
    $msg="Benutzername oder Passwort ist falsch.";
  }
  
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" href="img/favicon.png">

  <title>Login Page - Film Master</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />

</head>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" method="POST" action="">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" name ="email" class="form-control" placeholder="Email" autofocus value="<?php echo $email;?>">
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div id="msg" style="color:red;"><?php echo $msg;?></div>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
      </div>
      
    </form>
    
    <div class="text-right">
      <div class="text-center">

          Designed by Kerem Savas        </div>
    </div>
  </div>


</body>

</html>
