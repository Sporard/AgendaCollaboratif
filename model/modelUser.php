﻿<?php 

//partie du model concernant l'user
//****************************************************************
//Fonction qui vérifie si un utilisateur est déjà présent dans la base

function verif($email){
	global $c;
	$sql="SELECT * FROM USER 
where email ='".$email."'";

	$result=mysqli_query($c,$sql);

	$row=mysqli_fetch_assoc($result);

	if ($row == []){
		return true ; 
	}
	else {
		return false ;
	}

}

//****************************************************************
//Fonction de connexion


function connect($login,$mdp){

    global $c;
    $req = $c->query("SELECT * FROM USER 
WHERE email ='".$login."' and mdp = '".$mdp."'");



	$row=$req->fetch(PDO::FETCH_ASSOC) ;
	if ($row != []){
		//on met en session les informations utiles de la personne qui se connecte
		$_SESSION["id"]=$row["id_user"];
		$_SESSION["name"]=$row["nom"];
		$_SESSION["prenom"]=$row["prenom"];


	}
	
}


//****************************************************************
//Fonction de deconnexion

function disconnect(){
	unset($_SESSION["id"]);
	unset($_SESSION["name"]);
	unset($_SESSION["prenom"]);
}


//****************************************************************

//Fonction d'inscription au site 


function inscription($email,$nom,$prenom,$mdp){

	global $c;
	
	$c->query ("INSERT INTO USER(email,nom,prenom,mdp) VALUES('".$email."','".$nom."','".$prenom."','".$mdp."')");
    $id = $c ->lastInsertId();

    $c -> query("INSERT INTO GROUPE(id_user,nomgroupe,color,description) VALUES ('".$id."','PERSO',526,'perso')");
    $id2 =$c ->lastInsertId();
    $c -> query("INSERT INTO ADHERENT(id_user,id_groupe)VALUES('".$id."','".$id2."')");

	}
//****************************************************************
//	Fonction qui récupère les groupes d'un utilisateur

function recupGroupe($id)
{
    global $c;
    $sql = $c->query("SELECT DISTINCT gr.id_groupe,nomgroupe 
FROM GROUPE gr 
JOIN ADHERENT a 
ON a.id_groupe=gr.id_groupe 
JOIN USER u 
ON u.id_user=a.id_user 
WHERE u.id_user ='" . $id . "'");
    $res=[];
    while($row=$sql->fetch(PDO::FETCH_ASSOC)){
        $res[]=$row;
    }
    return $res;
}


//*****************************************************************
//Fonction qui ajoute un membre dans un groupe

function inscriptionGr($id,$idgroupe){

    global $c ;
    $sql = $c->query("INSERT INTO ADHERENT (id_user,id_groupe) VALUES ('".$id."','".$idgroupe."')");

    }

//****************************************************************
//Fonction qui récupère l'id d'un utilisateur avec son email ( pour ajouter des gens dans un groupe )

function emailToId($email){
    global $c ;

    $sql =$c->query(" SELECT id_user FROM USER WHERE email = '".$email."'");


}
//****************************************************************
//fonction qui ajoute un groupe créer par un utilisateur

function addGroupe($nom,$description,$idCreateur){
    global $c;

    $c -> query("INSERT INTO GROUPE(id_user,nomgroupe,description)
VALUES('".$idCreateur."','".$nom."','".$description."')");
    //on ajoute le créateur a son propre groupe
    $adherer = $c->lastInsertId();
    $c -> query("INSERT INTO ADHERENT(id_user,id_groupe) 
VALUES ('".$idCreateur."','".$adherer."')");
}

//****************************************************************
//Fonction qui vérifie si un groupe n'est pas déjà existant
function existe($nomgroupe){
    global $c;
    $sql = $c->query("SELECT nomgroupe 
          FROM GROUPE
          WHERE nomgroupe = '".$nomgroupe."'");
    $res = $sql -> fetch(PDO::FETCH_ASSOC);
    if( $res == null ){
         return false;
    }
    else {
        return true;
    }
}