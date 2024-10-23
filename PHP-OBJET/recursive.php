<?php
    $menus = [
        ['id'=> 1, 'parent_id'=> 0, 'libelle'=> 'Accueil'],
        ['id'=> 2, 'parent_id'=> 0, 'libelle'=> 'Article'],
        ['id'=> 3, 'parent_id'=> 0, 'libelle'=> 'Tiers'],
        ['id'=> 4, 'parent_id'=> 0, 'libelle'=> 'Commande'],

        ['id'=> 5, 'parent_id'=> 2, 'libelle'=> 'Liste'],
        ['id'=> 6, 'parent_id'=> 2, 'libelle'=> 'Nouveau article'],

        ['id'=> 7, 'parent_id'=> 3, 'libelle'=> 'Liste'],
        ['id'=> 8, 'parent_id'=> 3, 'libelle'=> 'Nouveau tiers'],
        
        ['id'=> 9, 'parent_id'=> 4, 'libelle'=> 'Appro'],
        ['id'=> 10, 'parent_id'=> 4, 'libelle'=> 'Vente'],
        ['id'=> 11, 'parent_id'=> 4, 'libelle'=> 'Demarque'],
        ['id'=> 12, 'parent_id'=> 4, 'libelle'=> 'Interne'],

        ['id'=> 13, 'parent_id'=> 10, 'libelle'=> 'Au comptant'],
        ['id'=> 14, 'parent_id'=> 10, 'libelle'=> 'À crédit'],
        ['id'=> 15, 'parent_id'=> 10, 'libelle'=> 'Offerte'],

    ];

    // $menu = afficher_menu(0, 0, $menus); 
    // echo $menu;
    $menu = getMenu(0, 0, $menus); 
    echo $menu;

    function getMenu($parent_id, $niveau, $menus) {
        $html = '';
        $niveau_precedent = 0;
        if($niveau == 0) {
            $html .= "<ul>";
        }
        foreach($menus as $menu) {
            $menu_id = $menu['id'];
            $menu_parent_id = $menu['parent_id'];
            $menu_libelle = $menu['libelle'];
            if($parent_id == $menu_parent_id) {
                if($niveau_precedent != $niveau) {
                    $html .= "<ul>";
                }
                $html .= "<li><a href=''>$menu_libelle</a>";
                $niveau_precedent = $niveau;
                $html .= getMenu($menu_id, $niveau+1, $menus);
            }
        }
        if($niveau == 0) {
            $html .= "</ul>";
        } elseif ($niveau_precedent == $niveau) {
            $html .= "</ul></li>";
        } else {
            $html .= "</li>";
        }
        return $html;
    }

    function afficher_menu($parent_id, $niveau, $menus) {
        $html = '';
        foreach ($menus as $menu) {
            $menu_id = $menu['id'];
            $menu_parent_id = $menu['parent_id'];
            $menu_libelle = $menu['libelle'];
            if($parent_id == $menu_parent_id) {
                for ($i = 1; $i <= $niveau; $i++) {
                    $html .= "...";
                }
                $html .= "$menu_libelle<br>";
                $html .= afficher_menu($menu_id, $niveau+1, $menus); // rajouter +1 pour les niveaux d'enfants
            }
        }
        return $html;
    }

