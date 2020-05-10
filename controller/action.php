<?php

function failleXSS($variable){
    return strip_tags(addslashes($variable));
}

if (isset($_POST["action"]) && $_POST["action"] == "connexion"){
    connect(failleXSS($_POST["mail"]),failleXSS($_POST["mdp"]));
    header("Location:index.php");
}
if (isset($_POST["action"]) && $_POST["action"] == "inscription"){
    inscription(failleXSS($_POST["mail"]),failleXSS($_POST["firstname"]),failleXSS($_POST["lastname"]),failleXSS($_POST["mdp"]));
    header("Location:index.php");
}
if(isset($_POST["action"]) && $_POST["action"]=="addEvent") {
    addEvent($_POST["groupe"], $_POST["debut"], $_POST["fin"], $_POST["description"]);
    header("Location:");
}
if(isset($_POST["action"]) && $_POST["action"] == "addGroupe"){

    if (existe(failleXSS($_POST["nomGroupe"]))){
        echo "<script> alert('Ce groupe existe déjà')</script>";
    }
    else{
        addGroupe(failleXSS($_POST["nomGroupe"]),failleXSS($_POST["description"]),$_SESSION["id"]);
    }
}