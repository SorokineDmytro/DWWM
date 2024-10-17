<?php
    class LigneMouvement extends LigneMouvementManager{
        private $id;
        private $mouvement_id;
        private $produit_id;
        private $quantite;
        private $prixUnitaire;

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

        public function getMouvement()
        {
            $mouvement = $this->find($this->mouvement_id);
            return $mouvement;
        }

        public function getProduit()
        {
            $produit = $this->find($this->produit_id);
            return $produit;
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
         * Get the value of mouvement_id
         */ 
        public function getMouvement_id()
        {
                return $this->mouvement_id;
        }

        /**
         * Set the value of mouvement_id
         *
         * @return  self
         */ 
        public function setMouvement_id($mouvement_id)
        {
                $this->mouvement_id = $mouvement_id;

                return $this;
        }

        /**
         * Get the value of produit_id
         */ 
        public function getProduit_id()
        {
                return $this->produit_id;
        }

        /**
         * Set the value of produit_id
         *
         * @return  self
         */ 
        public function setProduit_id($produit_id)
        {
                $this->produit_id = $produit_id;

                return $this;
        }

        /**
         * Get the value of quantite
         */ 
        public function getQuantite()
        {
                return $this->quantite;
        }

        /**
         * Set the value of quantite
         *
         * @return  self
         */ 
        public function setQuantite($quantite)
        {
                $this->quantite = $quantite;

                return $this;
        }

        /**
         * Get the value of prixUnitaire
         */ 
        public function getPrixUnitaire()
        {
                return $this->prixUnitaire;
        }

        /**
         * Set the value of prixUnitaire
         *
         * @return  self
         */ 
        public function setPrixUnitaire($prixUnitaire)
        {
                $this->prixUnitaire = $prixUnitaire;

                return $this;
        }
    }