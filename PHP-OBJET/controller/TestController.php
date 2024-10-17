<?php
    class TestController extends MyFct{
        function __construct() {
            $action = "demo1"; // index.php?url=test&action=demo1
            extract( $_GET );
            switch ( $action ) {
                case "demo1": // case de fonction findAllTable
                    $m = new Manager(); // utiliser obligatoirement sans EXTENDS MyFct 
                    $table = "article";
                    $condition = ["left(numarticle,2)"=>"BB"];
                    $articles = $m->findAllTable( $table, $condition);
                    $mf = new MyFct(); // utiliser obligatoirement sans EXTENDS MyFct
                    $mf->printr($articles);                    
                    break;
                case "demo2": // case de fonction findTable
                    $id = 5;
                    $table = "article";
                    $resultat = $this->findTable( $table, $id );
                    $this->printr($resultat); 
                    break;
                case "demo3": // case de fonction getColumnsTable
                    $table = "article";
                    $columns = $this->getColumnsTable($table);
                    $this->printr($columns);
                    break; 
                case "demo4": // case de fonction searchTableByConditions
                    $table = "article";
                    $columns = ["designation","numarticle"];
                    $mot = "vin";
                    $condition = [];
                    $resultats=$this->searchTableByConditions($table,$columns,$mot, $condition);
                    $this->printr($resultats);
                    break;
                case "demo5": // case de fonction save qui detecte s'agit-il de la creation ou du modification d'un article en fonction de ID passé dans $data
                    $table = "article";
                    $data = [
                        "id"=>0, 
                        "numarticle"=>"XX0025", 
                        "designation"=>"Article nouvellement ajouté", 
                        "prixunitaire"=>1.5, 
                        "prixrevient"=>0.75
                    ];
                    $this->saveTable($table,$data);
            }
        }
    }