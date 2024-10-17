<?php
    // require_once('service/myFct.php');
    class ProduitController extends MyFct{
        public function __construct(){
            $pm=new ProduitManager();
            $cm=new CategorieManager();
            $action="list";
            $page=1;
            $categorie_id=0;
            $mot="";
            $nlpp=NLPP;
            extract($_GET);
            switch($action){
                case "list":
                    $file="view/produit/list.html.php";
                    $columns=["numProduit","designation"];
                    $type="object";
                    if($categorie_id==0){
                        $conditions=[];
                    }else{
                        $conditions=['categorie_id'=>$categorie_id];
                    }
                    $orderBy="order by id desc";
                    $limit=$nlpp;
                    $offset=($page-1)*$nlpp;
                    $produit_total=$pm->searchByCondition($columns,$mot,$conditions,$type);
                    $nb_total=count($produit_total);
                    $np=ceil($nb_total/$nlpp);
                    $variables=[
                        'title'=>'Liste des Produits',
                        'produits'=>$pm->searchByCondition($columns,$mot,$conditions,$type,$orderBy,$limit,$offset),
                        'categories'=>$cm->findAll(),
                        'page'=>$page,
                        'categorie_id'=>$categorie_id,
                        'mot'=>$mot,
                        'np'=>$np,
                    ];
                    $this->generatePage($file,$variables);
                    break;
                case "save":
                    if($_FILES['image']['name']){
                        $file=$_FILES['image'];
                        $name=$file['name'];
                        $tmp_name=$file['tmp_name'];
                        $copy=move_uploaded_file($tmp_name,"./public/img/$name");
                        if($copy){
                            $_POST['image']=$name;
                        }
                    }
                    $em=$cm; // EntityManager
                    $entity_id=$_POST['categorie_id'];
                    $id = (int) $_POST['id'];
                    if($id == 0 ) {
                        $numProduit=$this->createNumEntity($em,$entity_id);
                        $_POST['numProduit']=$numProduit;
                    }
                    $pm->save($_POST);
                    header("location:index.php?url=produit");
                    break;
                case "create":
                    $file = "view/produit/form.html.php";
                    $produit = new Produit();
                    $produit -> setImage("aucune_image.jpg");
                    $variables = [
                        "title"=>"Creation Produit",
                        "produit"=>$produit,
                        "disabled"=>"",
                        "categories"=>$cm->findAll(),
                    ];
                    $this->generatePage($file, $variables);
                    break;  
                case "read":
                    $file="view/produit/form.html.php";
                    $produit = $pm->find($id);
                    $variables = [
                        "title"=>"Affichage Produit",
                        "produit"=>$produit,
                        "disabled"=>"disabled",
                        "categories"=>$cm->findAll(),
                    ];
                    $base = "view/base-pop-center.html.php";
                    $this->generatePage($file, $variables, $base); 
                    break;
                case "update":
                    $produit = $pm->find($id);
                    $file="view/produit/form.html.php";
                    $variables = [
                        "title"=>"Modification Produit",
                        "produit"=>$produit,
                        "disabled"=>"",
                        "categories"=>$cm->findAll(),
                    ];
                    $this->generatePage($file, $variables);
                    break;  
                case "delete":
                    $pm->delete($id);
                    header("location:index.php?url=produit");
                    break;  
                case "search":
                    $columns = ["numproduit", "designation"];
                    $produits = $pm->searchByCondition($columns,$mot,"object",[],"order by id");
                    $file = "view/produit/list.html.php";
                    $variables = [
                        "title"=>"Liste produits trouvées",
                        "produits"=>$produits, 
                    ];
                    $this->generatePage($file, $variables);
                    break;
            }
        }
    }


