<?php
    require_once("service/myFct.php");
    $action="list";
    extract($_GET);
    switch($action) {
        case 'list' :
            $file = 'view/article/list-bis.html.php';
            $articles = findAll();
            $variables = [
                'title'=>'Liste des articles',
                'articles'=>$articles,
            ];
            generatePage($file,$variables);
            break;
        case 'show' :
            $file = 'view/article/form-bis.html.php';
            $article = find($id);
            $variables = [
                'titre'=>'Affichage article',
                'article'=>$article, 
                'disabled'=>'disabled',
                'color'=>'bg-gray',
            ];
            $base = 'view/base-pop-center.html.php';
            generatePage($file, $variables, $base);
            break;
        case 'create' :
            $file = 'view/article/form-bis.html.php';
            $article = [
                'id'=>'0',
                'numarticle'=>'',
                'designation'=>'',
                'prixunitaire'=>'0.00',
                'prixrevient'=>'0.00',
                'image'=>'aucune_image.jpg',
            ];
            $variables = [
                'title'=>'Creation article',
                'article'=>$article,
                'disabled'=>'',
                'color'=>'',
                'submitted'=>0,
            ];
            $base = 'view/base-pop-center.html.php';
            generatePage($file, $variables, $base);
            break;
        case 'update' :
            $file = 'view/article/form-bis.html.php';
            $article = find($id);
            $variables = [
                'title'=>'Modification article', 
                'article'=>$article,
                'disabled'=>'',
                'color'=>'',
                'submitted'=>0,
            ];
            $base = 'view/base-pop-center.html.php';
            generatePage($file, $variables, $base);
            break;
        case 'delete' :
            $exist = existOnLigneCommande($id);
            if($exist){
                $message = "L'article est lié à une vente et ne peut pas être supprimé";
                $file = 'view/article/list-bis.html.php';
                $articles = findAll();
                $variables = [
                    'title' => "Liste Article",
                    'message'=> $message,
                    'articles'=> $articles,
                ];
                generatePage($file, $variables);
            } else {
                delete($id);
                header('location:article-bis.php');
            }
            break;
        case 'deleteDefault' :
                $exist = existOnLigneCommande($id);
                if($exist){
                    $file = 'view/accueil/message.html.php';
                    $variables = [
                        'title' => "Message d'erreur",
                        'message'=> "L'article est lié à une vente et ne peut pas être supprimé",
                    ];
                    generatePage($file, $variables);
                } else {
                    delete($id);
                    header('location:article-bis.php');
                }
            break;
        case 'save' :
            extract($_POST);
            $exist = isSameObject($id, $numarticle);
            if ($exist) {
                $file = 'view/accueil/message.html.php';
                $variables = [
                    'title' => "Message d'erreur",
                    'message'=> "Le CODE d'article ".$numarticle." est déjà pris par l'article ".$exist['designation']
                ];
                generatePage($file, $variables);
            } else {
                save($_POST, $_FILES);
                // header('location:article-bis.php'); //permet d'afficher dans un nouveau onglet au lieu du pop-up
                $file = 'view/article/form-bis.html.php';
                $article = $_POST;
                $variables = [
                    'title'=>'Création article',
                    'article'=>$article,
                    'disabled'=>'',
                    'color'=>'',
                    'submitted'=>1,
                ];
                $base = 'view/base-pop-center.html.php';
                generatePage($file, $variables, $base);
            }
            break;
        case 'search' :
            $file = 'view/article/list-bis.html.php';
            $articles = findAll($mot);
            $variables = [
                'title'=>'Liste des articles',
                'articles'=>$articles,
            ];
            generatePage($file,$variables);
            break;
    }

    //----------------------Mes fonctions-----------------------//
    function findAll($mot = '') {
        $connexion = getConnexion();
        if($mot) {
            $sql = "select * from article where numArticle ilike ? or designation ilike ? order by id desc";
            $requete = $connexion->prepare($sql);
            $requete->execute(["%$mot%", "%$mot%"]);
        } else {
            $sql = "select * from article order by id desc";
            $requete = $connexion->prepare($sql);
            $requete->execute();
        }
        $articles =$requete->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

    function save($data, $files) {
        $connexion = getConnexion();
        extract($data);
        $id=(int) $id;
        if($files['file']) {
            $name = $files['file']['name'];
            $source = $files['file']['tmp_name'];
            move_uploaded_file($source, "public/img/$name");
        } else {
            $name = '';
        }
        if($id == 0) { //$id est egale à 0 en cas de la creation
            if($name != '') {
                $sql = "insert into article (numarticle, designation, prixunitaire, prixrevient, image) values (?,?,?,?,?)";
                $requete = $connexion->prepare($sql);
                $requete->execute([$numarticle, $designation, $prixunitaire, $prixrevient, $name]);
            } else {
                $sql = "insert into article (numarticle, designation, prixunitaire, prixrevient) values (?,?,?,?)";
                $requete = $connexion->prepare($sql);
                $requete->execute([$numarticle, $designation, $prixunitaire, $prixrevient]);
            }
            
        } else { //$id n'est pas egale à 0
            if($name != '') {
                $sql = "update article set numarticle=?, designation=?, prixunitaire=?, prixrevient=?, image=? where id=?";
                $requete = $connexion->prepare($sql);
                $requete->execute([$numarticle, $designation, $prixunitaire, $prixrevient, $name, $id]);
            } else {
                $sql = "update article set numarticle=?, designation=?, prixunitaire=?, prixrevient=? where id=?";
                $requete = $connexion->prepare($sql);
                $requete->execute([$numarticle, $designation, $prixunitaire, $prixrevient, $id]);
            }
        }
    }
    
    function find($id) {
        $connexion = getConnexion();
        $sql = "select * from article where id=?";
        $requete = $connexion->prepare($sql);
        $requete->execute([$id]);
        $article = $requete->fetch(PDO::FETCH_ASSOC);
        return $article;
    }

    function delete($id) {
        $connexion = getConnexion();
        $sql = "delete from article where id=?";
        $requete = $connexion->prepare($sql);
        $requete->execute([$id]);
    }


    function existOnLigneCommande($id) {
        $connexion = getConnexion();
        $sql = "select * from lignecommande where article_id=?";
        $requete = $connexion->prepare($sql);
        $requete->execute([$id]);
        $exist = $requete->fetch(PDO::FETCH_ASSOC);
        return $exist;
    }

    function isSameObject($id, $numarticle) {
        $connexion = getConnexion();
        $sql = 'select * from article where numarticle=? and id<>?';
        $requete = $connexion->prepare($sql);
        $requete->execute([$numarticle, $id]);
        $exist = $requete->fetch(PDO::FETCH_ASSOC);
        return $exist;
    } 

