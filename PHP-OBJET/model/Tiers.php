<?php
    class Tiers extends TiersManager{
        private $id;
        private $numTiers;
        private $nomTiers;
        private $adresseTiers;
        private $typeTiers_id;

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

        public function getTypeTiers()
        {
            $typeTiers = $this->find($this->typeTiers_id);
            return $typeTiers;
        }

        public function getMouvement() {
            $pm = new MouvementManager();
            return $pm->findAll("object", ["tiers_id"=>$this->id] );
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
         * Get the value of numTiers
         */ 
        public function getNumTiers()
        {
                return $this->numTiers;
        }

        /**
         * Set the value of numTiers
         *
         * @return  self
         */ 
        public function setNumTiers($numTiers)
        {
                $this->numTiers = $numTiers;

                return $this;
        }

        /**
         * Get the value of nomTiers
         */ 
        public function getNomTiers()
        {
                return $this->nomTiers;
        }

        /**
         * Set the value of nomTiers
         *
         * @return  self
         */ 
        public function setNomTiers($nomTiers)
        {
                $this->nomTiers = $nomTiers;

                return $this;
        }

        /**
         * Get the value of adresseTiers
         */ 
        public function getAdresseTiers()
        {
                return $this->adresseTiers;
        }

        /**
         * Set the value of adresseTiers
         *
         * @return  self
         */ 
        public function setAdresseTiers($adresseTiers)
        {
                $this->adresseTiers = $adresseTiers;

                return $this;
        }

        /**
         * Get the value of typeTiers_id
         */ 
        public function getTypeTiers_id()
        {
                return $this->typeTiers_id;
        }

        /**
         * Set the value of typeTiers_id
         *
         * @return  self
         */ 
        public function setTypeTiers_id($typeTiers_id)
        {
                $this->typeTiers_id = $typeTiers_id;

                return $this;
        }
    }