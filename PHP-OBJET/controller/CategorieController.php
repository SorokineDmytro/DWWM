<?php
    class CategorieController extends MyFct {
        public function __construct() {
            $cm = new CategorieManager(); // declare le variable Categorie Manager 
            $action = "list";
            extract($_GET);
            switch ($action) {
                case "list":
                    $categories = $cm->findAll([], "object", "order by id");
                    $file = "view/categorie/list.html.php";
                    $variables = [
                        "title"=>"Liste de categories",
                        "categories"=>$categories, 
                    ];
                    $this->generatePage($file, $variables);
                    break;
                case "read":
                    $categorie = $cm->find($id);
                    $file="view/categorie/form.html.php";
                    $variables = [
                        "title"=>"Affichage Categorie",
                        "categorie"=>$categorie,
                        "disabled"=>"disabled",
                    ];
                    $base = "view/base-pop-center.html.php";
                    $this->generatePage($file, $variables, $base); 
                    break;
                case "create":
                    $categorie = new Categorie();
                    $file = "view/categorie/form.html.php";
                    $variables = [
                        "title"=>"Creation Categorie",
                        "categorie"=>$categorie,
                        "disabled"=>"",
                    ];
                    $this->generatePage($file, $variables);
                    break;  
                case "update":
                    $categorie = $cm->find($id);
                    $file="view/categorie/form.html.php";
                    $variables = [
                        "title"=>"Modification Categorie",
                        "categorie"=>$categorie,
                        "disabled"=>"",
                    ];
                    $this->generatePage($file, $variables);
                    break;  
                case "save":
                    //$this->printr($_POST); // pour afficheret verifier
                    $cm->save($_POST);
                    header("location:index.php?url=categorie");
                    exit();
                    break;  
                case "delete":
                    $cm->delete($id);
                    header("location:index.php?url=categorie");
                    break;  
                case "search":
                    $columns = ["prefixe", "libelle", "format"];
                    $categories = $cm->searchByCondition($columns,$mot,[],"object","order by id");
                    $file = "view/categorie/list.html.php";
                    $variables = [
                        "title"=>"Liste categories trouvées",
                        "categories"=>$categories, 
                    ];
                    $this->generatePage($file, $variables);
                    break;
            }
        }
    }