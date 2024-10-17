<?php
    require_once('service/myFct.php');
    $action = 'list';
    $code = 'TOUTE';
    $categories = [
        'TOUTE'=>'Toute commande',
        'VTE'=>'Vente',
        'APR'=>'Aprovisionnement',
        'INT'=>'Interne',
    ];
    $mot = '';
    $date = new DateTime();
    $debut = $date->format('Y-01-01'); // Le premier jour du mois en cours
    $fin = $date->format('Y-m-t'); // Le dernier jour du mois en cours - l'option 't' correspond au nombre de jours du mois
    extract($_GET);
    switch($action) {
        case 'list':
            $file = 'view/commande/list.html.php';
            $variables = [
                'title'=>'Liste des commandes',
                'commandes'=>getRows($code, $mot, $debut, $fin),
                'code'=> $code,
                'mot'=> $mot,
                'debut'=> $debut,
                'fin' => $fin,
                'categories' => $categories,
            ];
            generatePage($file, $variables);
            break;
    }

    //----------------------Mes fonctions-----------------------//
    function getRows($code, $mot, $debut, $fin) {
        $connexion = getConnexion();
        if($mot) {
            if($code != 'TOUTE') {
                $condition = "where (numcommande ilike ? or numtiers ilike ? or nomtiers ilike ? or adressetiers ilike ?) and left(numcommande, 3)=? and datecommande between ? and ?";
                $values = ["%$mot%","%$mot%","%$mot%","%$mot%", $code, $debut, $fin];
            } else {
                $condition = "where numcommande ilike ? or numtiers ilike ? or nomtiers ilike ? or adressetiers ilike ? and datecommande between ? and ?";
                $values = ["%$mot%","%$mot%","%$mot%","%$mot%", $debut, $fin];
            }
        } else {
            if($code != "TOUTE") {
                $condition = "where left(numcommande, 3)=? and datecommande between ? and ?";
                $values = [$code, $debut, $fin];
            } else {
                $condition = "where datecommande between ? and ?";
                $values = [$debut, $fin];
            }
        }
        $sql = "select * from listecommande $condition";
        $requete = $connexion->prepare($sql);
        $requete->execute($values);
        $rows = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    