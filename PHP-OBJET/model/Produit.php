<?php
    class Produit extends ProduitManager {
        private $id;
        private $numProduit;
        private $designation;
        private $prixUnitaire;
        private $prixRevient;
        private $categorie_id;
        private $image;

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

        public function getCategorie()
        {
            $categorie = $this->find($this->categorie_id);
            return $categorie;
        }

        public function getLigneMouvement() {
            $pm = new LigneMouvementManager();
            return $pm->findAll("object", ["produit_id"=>$this->id] );
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
         * Get the value of numProduit
         */ 
        public function getNumProduit()
        {
                return $this->numProduit;
        }

        /**
         * Set the value of numProduit
         *
         * @return  self
         */ 
        public function setNumProduit($numProduit)
        {
                $this->numProduit = $numProduit;

                return $this;
        }

        /**
         * Get the value of designation
         */ 
        public function getDesignation()
        {
                return $this->designation;
        }

        /**
         * Set the value of designation
         *
         * @return  self
         */ 
        public function setDesignation($designation)
        {
                $this->designation = $designation;

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

        /**
         * Get the value of prixRevient
         */ 
        public function getPrixRevient()
        {
                return $this->prixRevient;
        }

        /**
         * Set the value of prixRevient
         *
         * @return  self
         */ 
        public function setPrixRevient($prixRevient)
        {
                $this->prixRevient = $prixRevient;

                return $this;
        }

        /**
         * Get the value of categorie_id
         */ 
        public function getCategorie_id()
        {
                return $this->categorie_id;
        }

        /**
         * Set the value of categorie_id
         *
         * @return  self
         */ 
        public function setCategorie_id($categorie_id)
        {
                $this->categorie_id = $categorie_id;

                return $this;
        }

        /**
         * Get the value of image
         */ 
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }
    }