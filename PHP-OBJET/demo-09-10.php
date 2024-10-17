<?php
    require_once "service/extra.php";
    spl_autoload_register("router");
    
    $cm = new CategorieManager();
    $categorie_obj = $cm->find(2);
    $categorie_array = $cm->find(2, 'array');
    
    echo $categorie_obj->getLibelle();
    echo "<br>";
    printr($categorie_obj);
    echo "<br>";
    echo "<br>";
    echo $categorie_array['libelle'];
    echo "<br>";
    printr($categorie_array);

    die;
    $data = [
        "id"=> 1,
        "numProduit"=> "BB0001",
        "designation"=> "Biere Phoenix",
        "prixUnitaire"=> 2.50,
        "prixRevient"=> 1.25,
        "categorie_id"=> 1,
    ];
    $p = new Produit($data);
    printr($p);

    die;
    //--------------------------------------
    $p = new Produit();
    $p -> setId(1);
    $p -> setNumProduit("BB0001");
    $p -> setDesignation("Biere Castel");
    $p -> setPrixUnitaire(2.50);
    $p -> setPrixRevient(1.25);
    $p -> setCategorie_id(1);
    printr($p);

    function printr($array) { 
        echo "<pre>";
        print_r($array);
        echo "<pre>";
    }