<?php
    class Mouvement extends MouvementManager {
        private $id;
        private $numMouvement;
        private $dateMouvement;
        private $typeMouvement_id;
        private $tiers_id;

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

        public function getTypeMouvement()
        {
            $typeMouvement = $this->find($this->typeMouvement_id);
            return $typeMouvement;
        }

        public function getTiers()
        {
            $tiers = $this->find($this->tiers_id);
            return $tiers;
        }

        public function getLigneMouvement() {
            $pm = new LigneMouvementManager();
            return $pm->findAll("object", ["mouvement_id"=>$this->id] );
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
         * Get the value of numMouvement
         */ 
        public function getNumMouvement()
        {
                return $this->numMouvement;
        }

        /**
         * Set the value of numMouvement
         *
         * @return  self
         */ 
        public function setNumMouvement($numMouvement)
        {
                $this->numMouvement = $numMouvement;

                return $this;
        }

        /**
         * Get the value of dateMouvement
         */ 
        public function getDateMouvement()
        {
                return $this->dateMouvement;
        }

        /**
         * Set the value of dateMouvement
         *
         * @return  self
         */ 
        public function setDateMouvement($dateMouvement)
        {
                $this->dateMouvement = $dateMouvement;

                return $this;
        }

        /**
         * Get the value of typeMouvement_id
         */ 
        public function getTypeMouvement_id()
        {
                return $this->typeMouvement_id;
        }

        /**
         * Set the value of typeMouvement_id
         *
         * @return  self
         */ 
        public function setTypeMouvement_id($typeMouvement_id)
        {
                $this->typeMouvement_id = $typeMouvement_id;

                return $this;
        }

        /**
         * Get the value of tiers_id
         */ 
        public function getMouvement_id()
        {
                return $this->tiers_id;
        }

        /**
         * Set the value of tiers_id
         *
         * @return  self
         */ 
        public function setMouvement_id($tiers_id)
        {
                $this->tiers_id = $tiers_id;

                return $this;
        }
    }