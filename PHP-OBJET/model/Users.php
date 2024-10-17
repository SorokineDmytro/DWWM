<?php
    class Users extends UsersManager {
        private $id;
        private $username;
        private $password;
        private $roles;

        public function __construct($data = []) { // par exemple $data = ['id' => 1, 'numProduit' => 'BB0001' ... ]
            if ($data) { // tester si $data est different de vide '[]'
                foreach ($data as $key => $value) {
                    $setter = "set".ucfirst($key); // par exemple si $key = 'designation' alors $set = 'setDesignation'
                    if (method_exists($this, $setter)) {
                        $this -> $setter($value);
                    }
                }
            }
        }
        
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of username
         */ 
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of roles
         */ 
        public function getRoles()
        {
                $roles = json_decode($this->roles); // transformer le roles en json en roles de types tableau (array) 
                return $roles;
        }

        public function getJsonRoles()
        {
                return $this->roles;
        }

        /**
         * Set the value of roles
         *
         * @return  self
         */ 
        public function setRoles($roles)
        {
                $this->roles = $roles;

                return $this;
        }
    }