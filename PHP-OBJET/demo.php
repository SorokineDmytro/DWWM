<?php
    require_once "service/extra.php";
    spl_autoload_register("router");
    $m = new Manager(); // Instanciation de la classe Manager
    $data = ["id"=>76, "numarticle"=>"XX0025", "designation"=>"Cartable", "prixunitaire"=>75.00, "prixrevient"=>35.00];
    
    $data = ["id"=>0, "numarticle"=>"XX0028", "designation"=>"Article nouveau ajoute", "prixunitaire"=>1.5, "prixrevient"=>0.75];
    
    
    die;
    $m->saveTable("article", $data); // Utilisation de la fonction save qui va determiner il ságis d'nsertion ou de modification de données
    echo "save bien fait!";
    die;

    $m->deleteTable("article", 76); // Suppression
    echo "Supprerssion bien fait!";
    die;
    $m->updateTable("article", $data); // Modification
    echo "MAJ bien fait!";

    die;
    $data = ["id"=>0, "numarticle"=>"XX0025", "designation"=>"Article divers", "prixunitaire"=>1, "prixrevient"=>0];
    $m->insertTable("article", $data); // Insertion