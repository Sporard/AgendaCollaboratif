<?php 
session_start();
//permet de mettre le fuseau horaire sur Paris
date_default_timezone_set('Europe/Paris');
try{
    $c = new PDO('mysql:host=localhost;dbname=projetS4','root','',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
}
catch(PDOException $e){
    echo 'Base de donnée absente';
    exit();
}

