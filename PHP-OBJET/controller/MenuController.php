<?php
    class MenuController extends MyFct {
        public function __construct() {
            $action = "list";
            $mm = new MenuManager();
            $rm = new RoleManager();
            extract($_GET);
            switch ($action) {
                case "list":
                    $file = "view/menu/list.html.php";
                    $rows = $this -> showRowsMenu();
                    // $this->printr($rows); die;
                    $variables = [
                        "title" => "Liste des lignes de menu",
                        "rows" => $rows,
                    ];
                    $this->generatePage($file, $variables);
                    break;
                case "create":
                    $file = "view/menu/form.html.php";
                    $menu = new Menu();
                    $variables = [
                        'title' => 'Modification de menu',
                        'menu' => $menu,
                        'roles' => $rm -> findAll(),
                        'parents' => $mm -> findAll(),
                        'disabled' => '',
                    ];
                    $this->generatePage($file, $variables);
                    break;
                case "read":
                    $file = "view/menu/form.html.php";
                    $menu = new Menu();
                    $variables = [
                        'title' => 'Modification de menu',
                        'menu' => $mm -> find($id),
                        'roles' => $rm -> findAll(),
                        'parents' => $mm -> findAll(),
                        'disabled' => 'disabled',
                    ];
                    $this->generatePage($file, $variables);
                    break;
                case "update":
                    $file = "view/menu/form.html.php";
                    $variables = [
                        'title' => 'Modification de menu',
                        'menu' => $mm -> find($id),
                        'roles' => $rm -> findAll(),
                        'parents' => $mm -> findAll(),
                        'disabled' => '',
                    ];
                    $this->generatePage($file, $variables);
                    break;
                case "delete":
                    // Verifier si le menu a des enfants
                    extract($_POST);
                    $menu = $mm -> find($id);
                    $enfants = $menu -> getEnfants();
                    if($enfants) {
                        header("location:index.php?url=accueil&page=error");
                        exit;
                    } 
                    $mm -> delete($id);
                    header("location:index.php?url=menu");
                    break;
                case "save":
                    extract($_POST);
                    if ($parent_id == '') {
                        $_POST['parent_id'] = null;
                    }
                    $mm -> save($_POST);
                    header("location:index.php?url=menu");
                    break;
                
            }
        }
    }