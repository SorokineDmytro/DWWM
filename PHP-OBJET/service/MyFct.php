<?php
    require_once("config/parametre.php");
    class MyFct extends Manager {

        public function afficherMenu() { // la fonctionne qui affiche le menu du syte
            $mm = new MenuManager();
            $conditions = [];
            $type = 'object';
            $order = 'order by id asc';
            $menus = $mm->findAll($conditions, $type, $order);
            $menu = $this->getMenu(null, 0, $menus);
            return $menu;
        }

        public function getMenu($parent_id, $niveau, $menus) {
            $html = "";
            $niveau_precedent = 0;
            if ($niveau == 0) {
                $html .= "<ul class='nav navbar-nav'>";
            }
            foreach ($menus as $menu) {
                $menu_id = $menu->getId();
                $menu_parent_id = $menu->getParent_id();
                $menu_libelle = $menu->getLibelle();
                $menu_url = $menu->getUrl();
                $menu_role = $menu->getRole();
                $menu_icone = $menu->getIcone();
                if($parent_id == $menu_parent_id && self::isGranted($menu_role)) {
                    if ($niveau_precedent != $niveau) {
                        $html .= "<ul class='dropdown-menu mx-2 bg-dark border-light'>";
                    }
                    if($niveau == 0) {
                        $text = "text-light fs-4";
                    } else {
                        $text = "text-light fs-4";
                    }
                    if($niveau < 1) {
                        $drop = "dropdown";
                    } else {
                        $drop = "dropend ";
                    }

                    $enfants = $menu->getEnfants();
                    if ($enfants) {
                        $html .= "<li class='nav-item $drop mx-2'><a href='$menu_url' class='nav-link $text dropdown-toggle' data-bs-toggle='dropdown' data-bs-auto-close='outside'><i class='$menu_icone me-2'></i>$menu_libelle</a>";
                    } else {
                        $html .= "<li class='nav-item mx-2'><a href='$menu_url' class='nav-link text-light fs-4'><i class='$menu_icone me-2'></i>$menu_libelle</a>";
                    }
                    $niveau_precedent = $niveau;
                    $html .= $this->getMenu($menu_id, $niveau+1, $menus);
                }
            }
            if ($niveau == 0) {
                $html .= "</ul>";
            } else if ($niveau_precedent == $niveau) {
                $html .= "</ul></li>";
            } else {
                $html .= "</li>";
            }
            return $html;
        }


        // function qui gére la visualisation des blocks du menu en fonction d'une ROLE
        static function isGranted($role){
            $roles=$_SESSION['roles'];
            if(in_array($role,$roles)){
                return true;
            }else{
                return false;
            }
        } 


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
                $content = ob_get_clean(); // Fermeture de la memoire tampon (pour transformer son contenu en texte et le met dans la variable $content)

                ob_start(); // Ouverture de la memoire content (pour y inserer encone la fichier base.html.php)
                require_once($base); // Chargement du fichier representé par la variable $base (son contenu est rempli par $content)
                $page = ob_get_clean(); // Fermeture de la memoire tampn (pour transformer son contenu en texte et le mettre dans la variable $page)

                echo $page; // Afficher le contenu du fichier base.html.php remli par $content

            } else {
                echo "<h1 style='color:red; text-align:center;'>Le fichier $file n'existe pas!</h1>";
                die;
            }
        }

        function accessControl($role) { // regle stricte qui autorise une seule role et bloque toutes les autres
            $roles = $_SESSION['roles']; 
            if(!in_array($role, $roles)) {
                header("location:index.php?url=accueil&page=error");
            }
        }

        function control_role($roles){ // pour pouvoir definir plusieurs roles qui peuvent acceder utiliser un tableau de roles au lieu d'une variable simple
            $session_roles = $_SESSION['roles'];
            $ok = false;
            foreach($roles as $role){
                if(in_array($role, $session_roles)){
                    $ok = true;
                }
            }
            if($ok==false){
                header("location:index.php?url=accueil&page=error");
                exit();
            }
        }

    }

    


