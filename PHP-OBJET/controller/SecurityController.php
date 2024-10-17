<?php
    class SecurityController extends MyFct{

        public function __construct(){
            $um = new UsersManager();
            $rm = new RoleManager();
            $action="list";
            $mot='';
            extract($_GET);
            switch($action){
                case 'list':
                    $file="view/security/list.html.php";
                    $columns=['username'];
                    $users=$um->searchByCondition($columns,$mot,[],'object','order by id');
                    $variables=[
                        'title'=>'Liste des utilisateurs',
                        'users'=>$users,
                    ];
                    $this->generatePage($file,$variables);
                    break;
                case 'create':
                    $file="view/security/form.html.php";
                    $user=new Users();
                    $user->setRoles('["ROLE_USER"]');
                    $roles=$rm->findAll();
                    $variables=[
                        'title'=>'Creation utilisateur',
                        'user'=>$user,
                        'roles'=>$roles,
                        'disabled'=>'',
                    ];
                    $this->generatePage($file,$variables);                    
                    break; 
                case 'read':
                    $file = "view/security/form.html.php";
                    $user = $um->find($id);
                    $roles = $rm->findAll();
                    $variables=[
                        "title"=>"Affichage utilisateur",
                        "user"=>$user,
                        "roles"=>$roles,
                        "disabled"=>"disabled",
                    ];
                    $this->generatePage($file,$variables);
                    break;
                case 'update':
                    $file = "view/security/form.html.php";
                    $user = $um->find($id);
                    $roles = $rm->findAll();
                    $variables=[
                        "title"=>"Modification utilisateur",
                        "user"=>$user,
                        "roles"=>$roles,
                        "disabled"=>"",
                    ];
                    $this->generatePage($file,$variables);
                    break;
                case 'delete':
                    $um->delete($id);
                    header('location:index.php?url=security');
                    break;
                case 'save':
                    // $this->printr($_POST);
                    if(!$_POST['password']){
                        unset($_POST["password"]); // Enlever dans le tableau $8POST l'indice 'password'
                    }else{
                        $password=$_POST['password'];
                        $password=$this->crypter($password);
                        $_POST['password']=$password;
                    }
                    $_POST['roles'] = json_encode($_POST['roles']);
                    $um->save($_POST);
                    header('location:index.php?url=security');
                    break; 
                case 'login':
                    break;
                case 'logout':
                    break;
                case 'register':
                    break;
            }

        }




    }

