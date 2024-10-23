<?php 
    class Menu extends MenuManager {
        private $id;
        private $parent_id;
        private $libelle;
        private $url;
        private $role;
        private $icone;

        public function __construct($data = []) { // par exemple $data = ['id' => 1, 'numProduit' => 'BB0001' ... ]
            if ($data) { // tester si $data est different de vide '[]'
                foreach ($data as $key => $value) {
                    $setter = "set".ucfirst($key); // par exemple si $key = 'designation' alor $set = 'setDesignation'
                    if (method_exists($this, $setter)) {
                        $this -> $setter($value);
                    }
                }
            }
        }

        public function getParent() { 
            $parent = $this->find($this->parent_id);
            return $parent;
        }

        public function getEnfants() {
            $conditions = ['parent_id'=>$this->id];
            $type = "object";
            $order = "order by parent_id asc";
            $enfants = $this->findAll($conditions,$type,$order);
            return $enfants;
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
         * Get the value of parent_id
         */ 
        public function getParent_id()
        {
                return $this->parent_id;
        }

        /**
         * Set the value of parent_id
         *
         * @return  self
         */ 
        public function setParent_id($parent_id)
        {
                $this->parent_id = $parent_id;

                return $this;
        }

        /**
         * Get the value of libelle
         */ 
        public function getLibelle()
        {
                return $this->libelle;
        }

        /**
         * Set the value of libelle
         *
         * @return  self
         */ 
        public function setLibelle($libelle)
        {
                $this->libelle = $libelle;

                return $this;
        }

        /**
         * Get the value of url
         */ 
        public function getUrl()
        {
                return $this->url;
        }

        /**
         * Set the value of url
         *
         * @return  self
         */ 
        public function setUrl($url)
        {
                $this->url = $url;

                return $this;
        }

        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }

        /**
         * Get the value of icone
         */ 
        public function getIcone()
        {
                return $this->icone;
        }

        /**
         * Set the value of icone
         *
         * @return  self
         */ 
        public function setIcone($icone)
        {
                $this->icone = $icone;

                return $this;
        }
    }