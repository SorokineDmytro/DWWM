<?php

    function numeroter($prefix, $format, $numInitial) {
        return sprintf($prefix.$format, $numInitial);
    }

    require_once("service/extra.php");
    spl_autoload_register("router");
    $data = [
        "id"=>"",
        "numproduit"=> "",
        "designation"=>"Frigo Samsung",
        "prixunitaire"=>250,
        "prixrevient"=>125,
        "categorie_id"=>6,
    ];
    $categorie_id=$data['categorie_id'];
    $cm=new CategorieManager();
    $categorie=$cm->find($categorie_id);
    $prefixe=$categorie->getPrefixe();
    $numInitial=$categorie->getNumeroInitial();
    $format=$categorie->getFormat();
    $myFct=new MyFct();
    $numProduit=$myFct->numeroter($prefixe,$format,$numInitial);
    //--------------Remplacement de la valeur numProduit de la variable table $data
    $data["numproduit"]=$numProduit;
    $pm=new ProduitManager();
    //--------------Enregistrement de $date dans la table produit
    $pm->save($data);
    $numInitial++;
    //--------------MAJ du champ numeroinitioal dans la table categorie
    $data_cm=[
        'id'=>$categorie_id,
        'numeroInitial'=>$numInitial,
    ];
    $cm->save($data_cm);