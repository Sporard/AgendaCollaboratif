<?php



//****************************************************************
// fonction qui récupère sous forme de tableau la liste des évenements lié a l'user en cours

function recupEvent($id){
    global $c;
        $sql = "SELECT DISTINCT * 
    FROM AGENDA a 
    JOIN EVENT e 
    ON a.id_event = e.id_event
    JOIN GROUPE gr 
    ON gr.id_groupe = a.id_groupe
    JOIN ADHERENT ad 
    ON ad.id_groupe = gr.id_groupe
    WHERE ad.id_user ='".$id."'";
    $result=mysqli_query($c,$sql);
    $res=[];
    while($row=mysqli_fetch_assoc($result)){
            $res[]=$row ;
    }
    return $res;

}


//*****************************************************************
//Fonction qui récupère sous forme de tableau la liste des évenements lié au groupe séléctionner

function recupEventGr($idgr){
    global $c ;
    $sql=$c->query("SELECT debut,fin,e.description,e.id_event 
FROM EVENT e 
JOIN AGENDA a 
on a.id_event = e.id_event 
JOIN GROUPE gr 
on gr.id_groupe=a.id_groupe 
WHERE gr.id_groupe ='".$idgr."'");

    $res=[];
    while($row=$sql->fetch(PDO::FETCH_ASSOC)){
        $res[]=$row;

    }
    return $res;
}

//****************************************************************
//Fonction qui ajoute les evenements dans la base
function addEvent($idgroupe,$debut,$fin,$description){
    global $c;
    $sql=$c->query("INSERT INTO EVENT (debut,fin,description) VALUES ('".$debut."','".$fin."','".$description."')");


    $id=$c->lastInsertId();
    $sql2=$c->query("INSERT INTO AGENDA (id_groupe,id_event) VALUES ('".$idgroupe."','".$id."')");


}
