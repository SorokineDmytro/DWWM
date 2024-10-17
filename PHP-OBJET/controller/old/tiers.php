<?php
    require_once("service/myFct.php");

    $action = 'list';
    extract($_GET);
    switch($action) {
        case 'list' : 
            $tiers = lister(); // utilisation de la fonction custom (crée en bas de la page)
            $file = 'view/tiers/list.html.php';
            $variable = ['tiers'=>$tiers];
            generatePage($file,$variable);
            break;
        case 'show' :
            $tiers = afficher($id); // utilisation de la fonction custom (crée en bas de la page)
            $tiers = json_encode($tiers);
            echo $tiers;
            break;
        case 'update' :
            $data = $_POST;
            enregistrer($data);
            echo 'Enregistrememt bien fait';
            break;
        case 'delete' :
            extract($_POST);
            supprimer($id); // utilisation de la fonction custom (crée en bas de la page)
            $response = 'Suppression bien faite dans la BDD!';
            echo $response;
            break;
        case 'search' :
            extract($_POST);
            $tiers = lister($mot);
            $rows = json_encode($tiers);
            echo $rows;
            break;
    }

    /*--------------------Mes fonctions---------------*/
    function lister($mot = '') {
        $connexion = getConnexion();
            if ($mot) {
                $sql= 'select * from tiers where numTiers ilike ? or nomTiers ilike ?';
                $requete = $connexion->prepare($sql);
                $requete->execute(["%$mot%", "%$mot%"]);
            } else {
                $sql = 'select * from tiers order by numTiers';
                $requete = $connexion->prepare($sql);
                $requete->execute();
            }
            $tiers = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $tiers;
    }

    function afficher($id) {
        $connexion = getConnexion();
        $sql = 'select * from tiers where id=?';
        $requete = $connexion->prepare($sql);
        $requete->execute([$id]);
        $tiers = $requete->fetch(PDO::FETCH_ASSOC);
        return $tiers;
    }

    function enregistrer($data) {
        extract($data);
        $connexion = getConnexion();
        if ($id == 0) {
            $sql = 'insert into tiers (numTiers, nomTiers, adresseTiers) values(?,?,?)';
            $requete = $connexion->prepare($sql);
            $requete->execute([$numTiers,$nomTiers,$adresseTiers]);
        } else {
            $sql = 'update tiers set numTiers=?, nomTiers=?, adresseTiers=? where id=?';
            $requete = $connexion->prepare($sql);
            $requete->execute([$numTiers,$nomTiers,$adresseTiers,$id]);
        }
    }

    function supprimer($id) {
        $connexion = getConnexion();
        $sql = 'delete from tiers where id=?';
        $requete = $connexion->prepare($sql);
        $requete->execute([$id]);
    } 
?>