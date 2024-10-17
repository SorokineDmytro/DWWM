<?php
    class Categorie extends CategorieManager {
        private $id;
        private $prefixe;
        private $libelle;
        private $numeroInitial;
        private $format;

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

        public function getProduits() {
            $pm = new ProduitManager();
            return $pm->findAll("object", ["categorie_id"=>$this->id] );
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
         * Get the value of prefixe
         */ 
        public function getPrefixe()
        {
                return $this->prefixe;
        }

        /**
         * Set the value of prefixe
         *
         * @return  self
         */ 
        public function setPrefixe($prefixe)
        {
                $this->prefixe = $prefixe;

                return $this;
        }

        /**
         * Get the value of prefixe
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
         * Get the value of numeroInitial
         */ 
        public function getNumeroInitial()
        {
                return $this->numeroInitial;
        }

        /**
         * Set the value of numeroInitial
         *
         * @return  self
         */ 
        public function setNumeroInitial($numeroInitial)
        {
                $this->numeroInitial = $numeroInitial;

                return $this;
        }

        /**
         * Get the value of format
         */ 
        public function getFormat()
        {
                return $this->format;
        }

        /**
         * Set the value of format
         *
         * @return  self
         */ 
        public function setFormat($format)
        {
                $this->format = $format;

                return $this;
        }
    }