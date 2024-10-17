<?php
require_once("./service/myFct.php");

$action = "show";
extract($_GET);
switch($action){
    case "show":
        $file = "./view/test/test1.html.php";
        $base = "./view/base_old.html.php";
        $variables = [];
        generatePage($file, $variables, $base);
        break;
    case "autocomplete":
        extract($_POST);
        $content = getContent($mot);
        echo $content;
        break;
}; 

function getContent($text) {
    $connexion = getConnexion();
    $content = '';
    if($text) {
        $sql = "select designation from produit where designation ilike ?";
        $request = $connexion->prepare($sql);
        $request->execute(["$text%"]);
        $content = $request->fetchAll(PDO::FETCH_ASSOC);
        $content = json_encode($content);
    }
    return $content;
};