<?php
    require_once("./service/extra.php");
    spl_autoload_register("router");
    //---------forme générale de l'url :   index.php?url=nom_class&action=nom_action
    // $um=new UserManager;
    // $myFct=new MyFct;
    // $conditions=[
    //     'username'=>'paul',
    //     'password'=>sha1('1234'),
    // ];
    // $user = $um->findAll($conditions);
    // $myFct->printr($user);die;

    //-------
    $url="accueil";
    extract($_GET);
    $controller=ucfirst($url)."Controller";  //----ucfirt met en majuscule le premier caratère de la variable $url
    $controller_file="controller/$controller.php";
    if(file_exists($controller_file)){
        $page=new $controller;
    }else{
        echo "<h1>Désolé! Le fichier $controller_file n'existe pas </h1>";
    }




?>