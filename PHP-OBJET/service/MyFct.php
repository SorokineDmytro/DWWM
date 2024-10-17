<?php
    require_once("config/parametre.php");
    class MyFct extends Manager {
        // Fonction qui change de date en format FR depuis US
        function dateFrs($cdate) { //cdate = chaine de characteres
            $date = new DateTime($cdate);
            $dateFrs = $date->format("d-m-Y");
            return $dateFrs;
        }

        function crypter($password) {
            $n = 77;
            for($i = 1; $i <= $n; $i++) {
                $password = sha1($password);
            }
            return $password;
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

        // Fonctionne qui va faire des sequences dans la BDD
        function numeroter($prefixe, $format, $numInitial) {
            return sprintf($prefixe.$format, $numInitial);
        }

        function createNumEntity($em, $entity_id) {
            $entity = $em -> find($entity_id);
            $prefixe = $entity -> getPrefixe();
            $numeroInitial = $entity -> getNumeroInitial();
            $format = $entity -> getFormat();
            $numEntity = $this -> numeroter($prefixe, $format, $numeroInitial);
            $numeroInitial++;
            $data = [
                'id' => $entity_id,
                'numeroInitial' => $numeroInitial,
            ];
            $em -> save($data);
            return $numEntity;
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
        }

    }

    


