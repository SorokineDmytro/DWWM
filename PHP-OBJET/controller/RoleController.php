<?php
    class RoleController extends MyFct {
        public function __construct() {
            $action = "list";
            $rm = new RoleManager();
            extract($_GET);

            switch ($action) {
                case "list":
                    $file="view/role/list.html.php";
                    $variables=[
                        "title"=>"LISTE DE ROLES",
                        "roles"=>$rm->findAll([],"object",  "order by id"), // pour un order by id asc faut passer les autres parametres de function findAll
                    ];
                    $this->generatePage($file,$variables);
                    break; 
                case "create":
                    $file="view/role/form.html.php";
                    $role=new Role();
                    $variables=[
                        "title"=>"Creation d'un role",
                        "role"=>$role,
                        "disabled"=>"",
                    ];
                    $this->generatePage($file,$variables);
                    break; 
                case "read":
                    $file="view/role/form.html.php";
                    $role=$rm->find($id); // RoleManager va chercher un ID
                    $variables=[
                        "title"=>"Affichage d'un role",
                        "role"=>$role,
                        "disabled"=>"disabled",
                    ];
                    $base = "view/base-pop-center.html.php";
                    $this->generatePage($file, $variables, $base);
                    break;
                case "update":
                    $file= "view/role/form.html.php";
                    $role=$rm->find($id); // RoleManager va chercher un ID
                    $variables=[
                        "title"=>"Modification d'un role",
                        "role"=>$role,
                        "disabled"=>"",
                    ];
                    $this->generatePage($file,$variables);
                    break;
                case "delete":
                    $rm->delete($id);
                    header("location:index.php?url=role");
                    break; 
                case "save":
                    $rm->save($_POST);
                    header("location:index.php?url=role");
                    break;
            }
        }
    }