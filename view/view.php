<?php
/**
 * Created by PhpStorm.
 * User: pierre
 * Date: 19/02/18
 * Time: 18:22
 */
displayNavBar();
if (!isset($_GET["page"]) && !isset($_SESSION["id"])){
    displayAcceuil();
}
if(isset($_GET["page"]) && $_GET["page"] == "connexion"){
    displayConnexion();
}
elseif (isset($_GET["page"]) && $_GET["page"] == "inscription"){
    displayInscription();
}
elseif (isset($_GET["page"]) && $_GET["page"] == "deconnexion"){
    disconnect();
    header("Location:index.php");
}
elseif (isset($_GET["page"]) && $_GET["page"] == "addEvent"){
    $groupe = recupGroupe($_SESSION["id"]);
    displayEventajoute($groupe);
}
elseif (isset($_GET["page"]) && $_GET["page"] == "addGroupe"){
    displayAddGroupe();
}
if(isset($_SESSION["id"]) && !isset($_GET["page"])) {
    $date= new Date();
    $year = date ('Y');
    displayCalendar($year,$date,$_SESSION["id"]);
}
