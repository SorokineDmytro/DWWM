<?php
    require_once('service/myFct.php');
    $nlpp = NLPP;
    $action = 'list';
    $mot = '';
    $page = 1;
    $categories = [
        'TOUTE'=> 'Toutes catégories',
        'BB'=> 'Biere',
        'BA'=> 'Alcool',
        'BC'=> 'Champagne',
        'BV'=> 'Vin',
        'BJ'=> 'Jus',
        'XA'=> 'Alimentation',
    ];
    $code = 'TOUTE';
    extract($_GET);
    switch($action) {
        case 'list':
            $file = 'view/produit/list-bis.html.php';
            $variables = [
                'title' => 'Liste des produits',
                'produits' => getRows($mot, $page, $nlpp, $code),
                'page' => $page,
                'np' => getNumberPage($mot, $nlpp, $code),
                'mot' => $mot,
                'categories' => $categories,
                'code' => $code,
            ];
            generatePage($file, $variables);
            break;
    }
//----------------------Mes fonctions-----------------------//  

function getRows($mot, $page, $nlpp, $code) {
    $connection = getConnexion();
    $limit = $nlpp;
    $offset = ($page - 1) * $nlpp;
    if ($mot) {
        if ($code != 'TOUTE') {
            $condition = 'where (numarticle ilike ? or designation ilike ?) and left(numarticle, 2)=?';
            $values = ["%$mot%", "%$mot%", $code];
        } else {
            $condition = 'where numarticle ilike ? or designation ilike ?';
            $values = ["%$mot%", "%$mot%"];
        }
    } else {
        if ($code != 'TOUTE') {
            $condition = " where left(numarticle, 2)=?";
            $values = [$code];
        } else {
            $condition = "";
            $values = [];
        }
    }
    $sql = "select * from produit $condition limit $limit offset $offset";
    $requete = $connection->prepare($sql);
    $requete->execute($values);
    $rows = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getNumberPage($mot, $nlpp, $code) {
    $connexion = getConnexion();
    if ($mot) {
        if ($code != 'TOUTE') {
            $condition = 'where (numarticle ilike ? or designation ilike ?) and left(numarticle, 2)=?';
            $values = ["%$mot%", "%$mot%", $code];
        } else {
            $condition = 'where numarticle ilike ? or designation ilike ?';
            $values = ["%$mot%", "%$mot%"];
        }
    } else {
        if ($code != 'TOUTE') {
            $condition = " where left(numarticle, 2)=?";
            $values = [$code];
        } else {
            $condition = "";
            $values = [];
        }
    }
    $sql = "select count(id) as nbre from produit $condition";
    $requete = $connexion->prepare($sql);
    $requete->execute($values);
    $nbres = $requete->fetch(PDO::FETCH_ASSOC);
    $nbre = $nbres['nbre'];
    $np = ceil($nbre/$nlpp);
    return $np;
}