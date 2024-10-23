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
                    $this->accessControl("ROLE_ADMIN");
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
                    $this->accessControl("ROLE_ADMIN");
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
                    $this->accessControl("ROLE_ADMIN");
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
                    $this->accessControl("ROLE_ADMIN");
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
                    $this->accessControl("ROLE_ADMIN");
                    $um->delete($id);
                    header('location:index.php?url=security');
                    break;
                case 'save':
                    $this->accessControl("ROLE_ADMIN");
                    // $this->printr($_POST);die;
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
                    $message = "";
                    if($_POST['username']) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $password = $this->crypter($password);
                        $conditions = [
                            'username'=> $username,
                            'password'=> $password,
                        ];
                        $user = $um->findOne($conditions);
                        if($user->getUsername()) {
                            // $_SESSION = [
                            //     'username'=> $user->getUsername(),
                            //     'roles'=> $user->getRoles(),
                            // ];
                            $_SESSION['username'] = $user->getUsername();
                            $_SESSION['roles'] = $user->getRoles();
                            $_SESSION['menu'] = $this->afficherMenu() ;
                            header('location:index.php');
                        } else {
                            $message = 'Identifiant ou mot de passe est incorrect!';
                        }
                    }
                    $file = "view/security/login.html.php";
                    $variables=[
                        "title"=>"Connexion",
                        "message"=>$message,
                        "disabled"=>"",
                    ];
                    $this->generatePage($file,$variables);
                    break;
                case 'logout':
                    session_destroy();
                    header('location:index.php');
                    break;
            }

        }




    }

