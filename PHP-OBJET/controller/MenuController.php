<?php
    class MenuController extends MyFct {
        public function __construct() {
            $action = "list";
            $mm = new MenuManager();
            extract($_GET);
            switch ($action) {
                case "list":
                    $file = "view/menu/list.html.php";
                    $variables = [
                        "title"=> "Liste des lignes de menu",
                    ];
                    $this->generatePage($file, $variables);
                    break;
            }
        }
    }