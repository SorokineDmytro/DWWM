<?php
    require_once("config/parametre.php");

    // Fonction qui change de date en format FR depuis US
    function dateFrs($cdate) { //cdate = chaine de characteres
        $date = new DateTime($cdate);
        $dateFrs = $date->format("d-m-Y");
        return $dateFrs;
    }
    
    function dateHeureFrs($cdate) { //cdate = chaine de characteres
        $date = new DateTime($cdate);
        $dateHeureFrs = $date->format("d-m-y G:i");
        return $dateHeureFrs;
    }

    // Fonctionne qui va preformater le texte et imprimme
    function printr($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    // Fonctionne de connection pour securisation
    function connexion() {
        // $dns = "mysql:host=127.0.0.1;dbname=dwwm_2024;port=3306;charset=utf8"; ----------pour mariaDB
        // $connexion = new PDO($dns,"root",""); ----------pour mariaDB
        $dsn = "pgsql:host=127.0.0.1;dbname=dwwm_2024;options='--client_encoding=UTF8'";
        try{
            $connexion = new PDO($dsn,"postgres","160717");
            return $connexion;
        } catch(Exception $e) {
            echo "<h1 style='color:red; text-align:center;'>Impossible de se connecter à la base de données!</h1>";
            die;
        } 
    }

    // Fonctionne de connection plus securisée par les constants definis dans config/parametre.php
    function getConnexion($host = HOST, $dbname = DBNAME, $user = USER, $password = PASSWORD) {
        $dsn = "pgsql:host=$host;dbname=$dbname;options='--client_encoding=UTF8'";
        try{
            $connexion = new PDO($dsn, $user, $password);
            return $connexion;
        } catch(Exception $e) {
            echo "<h1 style='color:red; text-align:center;'>Impossible de se connecter à la base de données!</h1>";
            die;
        } 
    }

    // Function qui genére la page
    function generatePage($file , $variables =[], $base="view/base.html.php") {
        if (file_exists($file)) {

            ob_start(); // Ouverture de la memoire content (pour transformer la fichier en texte)
            extract($variables); // Creation de variables à utiliser dans le fichier $file (les indices deviennent variables)
            require_once($file); // Chargement du fichier representé par la variable $file
            $content = ob_get_clean(); // Fermeture de a memoire tampon (pour transformer son contenu en texte et le met dans la variable $content)

            ob_start(); // Ouverture de la memoire content (pour y inserer encone la fichier base.html.php)
            require_once($base); // Chargement du fichier representé par la variable $base (son contenu est rempli par $content)
            $page = ob_get_clean(); // Fermeture de la memoire tampn (pour transformer son contenu en texte et le mettre dans la variable $page)

            echo $page; // Afficher le contenu du fichier base.html.php remli par $content

        } else {
            echo "<h1 style='color:red; text-align:center;'>Le fichier $file n'existe pas!</h1>";
            die;
        }
    };
    
?>

