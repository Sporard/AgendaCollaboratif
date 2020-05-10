<?php
class Date{

    var $days       = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi','Dimanche');
    var $months     = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

    //********************************************************************************************
    //Recup un event dans la BDD
    /**
     * @param $year
     * @return array
     */
    function getEvents($year,$id){
        global $c;
        $req = $c->query("SELECT DISTINCT e.id_event,e.description,debut,fin,gr.id_groupe
    FROM AGENDA a 
    JOIN EVENT e 
    ON a.id_event = e.id_event
    JOIN GROUPE gr 
    ON gr.id_groupe = a.id_groupe
    JOIN ADHERENT ad 
    ON ad.id_groupe = gr.id_groupe
    WHERE ad.id_user =".$id."
    AND YEAR(debut)=".$year."
        ORDER BY debut");
        $r = array();
        /**
         * Ce que je veux $r[TIMESTAMP][id] = title
         */

        while($d = $req->fetch(PDO::FETCH_OBJ)){

            $debutEvent = new DateTime($d->debut);
            $finEvent = new DateTime($d->fin);
            $r[strtotime(date_format($debutEvent,'Y-m-d'))][$d->id_event] = date_format($debutEvent,'H:i')." - ".date_format($finEvent,'H:i')." ".$d->description ;

        }
        return $r;
    }

//********************************************************************************************
    //Recup tous les jours de l'année

    function getAll($year){
        $r = array();

        $date = new DateTime($year.'-01-01');
        while($date->format('Y') <= $year){
            // Ce que je veux => $r[ANEEE][MOIS][JOUR] = JOUR DE LA SEMAINE
            $y = $date->format('Y');
            $m = $date->format('n');
            $d = $date->format('j');
            $w = str_replace('0','7',$date->format('w'));
            $r[$y][$m][$d] = $w;
            $date->add(new DateInterval('P1D'));
        }
        return $r;
    }

}