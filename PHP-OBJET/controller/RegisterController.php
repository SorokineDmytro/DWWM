<?php
    class RegisterController extends MyFct {
        public function __construct() {
            $action = "write";
            extract($_GET);
            $um = new UsersManager();
            $rm = new RoleManager();
            $message = '';
            switch ($action) {
                case "write":
                    if(isset($_POST['username'])) {
                        // verification d'existance de username dans la bdd
                        $username = $_POST['username'];
                        $conditions = ["username"=>$username];
                        $user = $um->findOne($conditions);
                        if($user->getUsername()) {
                            $message = "L'identifiant $username est déjà utilisé!";
                        } else {
                            $password = $_POST['password'];
                            $confirm = $_POST['confirm'];
                            $roles = $_POST['roles'];
                            if($password != $confirm) {
                                $message = "Le mot de passe saisi n'est pas confirmé!";
                            } else {
                                // enlever $_POST['confirm']
                                unset($_POST['confirm']);
                                // crypter le MDP
                                $_POST['password'] = $this->crypter($password);
                                // Transformer $_POST['roles'] en JSON
                                $_POST['roles'] = json_encode($_POST['roles']);
                                // Sauvegarder $_POST dans la bdd 
                                $um->save($_POST);
                                // Modifier le $_SESSION avec le nouveau login
                                // $_SESSION = [
                                //     'username'=>$username,
                                //     'roles'=>$roles,
                                // ];
                                $_SESSION['username'] = $user->getUsername();
                                $_SESSION['roles'] = $user->getRoles();
                                $_SESSION['menu'] = $this->afficherMenu() ;
                                // Redirrection vers l'accueil
                                header("location:index.php");
                                exit;
                                //$this->printr($_POST); die;
                            }
                        }
                    }
                    $file = "view/register/form.html.php";
                    $user = new Users();
                    $user->setRoles('["ROLE_USER"]');
                    $roles = $rm->findAll();
                    $variables = [
                        "title"=> "S'enregister",
                        "user"=> $user,
                        "roles"=> $roles,
                        "disabled"=> "",
                        "message"=> $message,
                    ];
                    $this->generatePage($file, $variables);
                    break;
            }
        }
    }