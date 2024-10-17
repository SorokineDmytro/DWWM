<?php
    require_once("service/myFct.php");

    $action = 'list';
    extract($_GET);
    switch($action) {
        case 'list' : 
            // $articles = lister(); // utilisation de la fonction custom (crée en bas de la page)
            $file = 'view/article/list.html.php';
            // $variable = ['articles'=>$articles];
            generatePage($file);
            break;
        case 'show' :
            $article = afficher($id); // utilisation de la fonction custom (crée en bas de la page)
            $article = json_encode($article);
            echo $article;
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
            $articles = lister($mot);
            $rows = json_encode($articles);
            echo $rows;
            break;
    }

    /*--------------------Mes fonctions---------------*/
    function lister($mot = '') {
        $connexion = getConnexion();
            if ($mot) {
                $sql= 'select * from article where numArticle ilike ? or designation ilike ?';
                $requete = $connexion->prepare($sql);
                $requete->execute(["%$mot%", "%$mot%"]);
            } else {
                $sql = 'select * from article order by numArticle';
                $requete = $connexion->prepare($sql);
                $requete->execute();
            }
            $articles = $requete->fetchAll(PDO::FETCH_ASSOC);
            return $articles;
    }

    function afficher($id) {
        $connexion = getConnexion();
        $sql = 'select * from article where id=?';
        $requete = $connexion->prepare($sql);
        $requete->execute([$id]);
        $article = $requete->fetch(PDO::FETCH_ASSOC);
        return $article;
    }

    function enregistrer($data) {
        extract($data);
        $connexion = getConnexion();
        if ($id == 0) {
            $sql = 'insert into article (numArticle, designation, prixUnitaire, prixRevient) values(?,?,?,?)';
            $requete = $connexion->prepare($sql);
            $requete->execute([$numArticle,$designation,$prixUnitaire,$prixRevient]);
        } else {
            $sql = 'update article set numArticle=?, designation=?, prixUnitaire=?, prixRevient=? where id=?';
            $requete = $connexion->prepare($sql);
            $requete->execute([$numArticle,$designation,$prixUnitaire,$prixRevient,$id]);
        }
    }

    function supprimer($id) {
        $connexion = getConnexion();
        $sql = 'delete from article where id=?';
        $requete = $connexion->prepare($sql);
        $requete->execute([$id]);
    } 
?>