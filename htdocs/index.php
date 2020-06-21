<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

//login yönlendirme
if (isset($_SESSION["Login"]) == false || $_SESSION["Login"]=false) {
    header("Location: login.php");
}

include "conn.php";
include "funcs.php";

include "head.php";
include "header.php";

$cat=getValue("cat","");

$sayfaBaslik="";
$contentPage="";
switch ($cat) {

    case "saal_liste": 
        $sayfaBaslik="Saalliste";
        $contentPage = "saal_liste.php";
    break;

    case "saal_hinzufuegen": 
        $sayfaBaslik="Saal Hinzufuegen";
        $contentPage = "saal_hinzufuegen.php";
    break;

    case "saal_verwalten":
        $sayfaBaslik="Saal Verwalten";
        $contentPage="saal_verwalten.php";
    break;

    case "personal_liste": 
        $sayfaBaslik="Personalliste";
        $contentPage = "personal_liste.php";
    break;

    case "personal_hinzufuegen": 
        $sayfaBaslik="Personal Hinzufuegen";
        $contentPage = "personal_hinzufuegen.php";
    break;

    case "personal_verwalten":
        $sayfaBaslik="Personal Verwalten";
        $contentPage="personal_verwalten.php";
    break;

    case "personal_myprofile":
        $sayfaBaslik="My Profile";
        $contentPage="personal_myprofile.php";
    break;

    case "filme_zeigen": //film_ekle
        $sayfaBaslik="Filme Zeigen";
        $contentPage = "filme_zeigen.php";
    break;

    case "filme_hinzufuegen": //film_ekle
        $sayfaBaslik="Film Hinzufuegen";
        $contentPage = "filme_hinzufuegen.php";
    break;

    case "filme_verwalten": //film_yönet
        $sayfaBaslik="Film Verwalten";
        $contentPage="filme_verwalten.php";
    break;


    case "saal_liste": 
        $sayfaBaslik="Saalliste";
        $contentPage = "saal_liste.php";
    break;

    case "saal_hinzufuegen": 
        $sayfaBaslik="Saal Hinzufuegen";
        $contentPage = "saal_hinzufuegen.php";
    break;

    case "saal_verwalten":
        $sayfaBaslik="Saal Verwalten";
        $contentPage="saal_verwalten.php";
    break;
    

    case "sitzplatz_liste": 
        $sayfaBaslik="Sitzplatzliste";
        $contentPage = "sitzplatz_liste.php";
    break;

    case "sitzplatz_hinzufuegen": 
        $sayfaBaslik="Sitzplatz Hinzufuegen";
        $contentPage = "sitzplatz_hinzufuegen.php";
    break;

	case "sitzplatz_hinzufuegen_multipel": 
        $sayfaBaslik="sitzplatz Hinzufuegen Multipel";
        $contentPage = "sitzplatz_hinzufuegen_multipel.php";
    break;
    case "sitzplatz_verwalten":
        $sayfaBaslik="Sitzplatz Verwalten";
        $contentPage="sitzplatz_verwalten.php";
    break;

    case "vorfuhrung_liste": 
        $sayfaBaslik="Vorfuhrungliste";
        $contentPage = "vorfuhrung_liste.php";
    break;

    case "vorfuhrung_hinzufuegen": 
        $sayfaBaslik="Vorfuhrung Hinzufuegen";
        $contentPage = "vorfuhrung_hinzufuegen.php";
    break;

    case "vorfuhrung_verwalten":
        $sayfaBaslik="Vorfuhrung Verwalten";
        $contentPage="vorfuhrung_verwalten.php";
    break;

    case "verkauf_liste": 
        $sayfaBaslik="Verkaufliste";
        $contentPage = "verkauf_liste.php";
    break;

    case "verkauf_hinzufuegen": 
        $sayfaBaslik="Verkauf Hinzufuegen";
        $contentPage = "verkauf_hinzufuegen.php";
    break;

    case "verkauf_verwalten":
        $sayfaBaslik="Verkauf Verwalten";
        $contentPage="verkauf_verwalten.php";
    break;

    case "reservierung_liste": 
        $sayfaBaslik="Reservierungliste";
        $contentPage = "reservierung_liste.php";
    break;

    case "reservierung_hinzufuegen": 
        $sayfaBaslik="Reservierung Hinzufuegen";
        $contentPage = "reservierung_hinzufuegen.php";
    break;

    case "reservierung_verwalten":
        $sayfaBaslik="Reservierung Verwalten";
        $contentPage="reservierung_verwalten.php";
    break;

    default:
        $sayfaBaslik="Dashboard";
        $contentPage="home.php";
}
$contentPage = "contents/".$contentPage; 

include "sidemenu.php";
include "pageStart.php";

include $contentPage;

include "footer.php";

?>