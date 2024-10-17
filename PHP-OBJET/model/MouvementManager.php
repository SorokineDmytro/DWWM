<?php
    class MouvementManager extends Manager {
        public function find($id,$type="object"){
            $table="mouvement";
            $resultat=$this->findTable($table,$id);
            if($type=="object"){
                $resultat=new Mouvement($resultat);
            }
            return $resultat;
        }
        public function findAll($conditions=[],$type="object",$order=""){
            $table="mouvement";
            $resultats=$this->findAllTable($table,$conditions,$order);
            if($type=="object"){
                $objects=[];
                foreach($resultats as $resultat){
                    $object=new Mouvement($resultat);
                    $objects[]=$object;
                }
                $resultats=$objects;
            }
            return $resultats;
        } 
        public function findOne($conditions=[],$type="object",$order=""){
            $table="mouvement";
            $resultat=$this->findOneTable($table,$conditions,$order);
            if($type=="object"){
                $object=new Mouvement($resultat);
                $resultat=$object;
            }
            return $resultat;
        }         
        public function searchByCondition($columns,$mot,$conditions=[],$type="object",$orderBy="",$limit=0,$offset=0){
            $table="mouvement";
            $resultats=$this->searchTableByCondition($table,$columns,$mot,$conditions,$orderBy,$limit,$offset);
            if($type=="object"){
                $objects=[];
                foreach($resultats as $resultat){
                    $object=new Mouvement($resultat);
                    $objects[]=$object;
                }
                $resultats=$objects;
            }
            return $resultats;
        }

        public function insert($data) {
            $table = "mouvement";
            $this->insertTable($table, $data);
        }

        public function update($data) {
            $table = "mouvement";
            $this->updateTable($table, $data);
        }

        public function save($data) {
            $id = (int) $data['id'];
            if($id == 0) {
                $this->insert($data);
            } else {
                $this->update($data);
            }
        }

        public function delete($id) {
            $table = "mouvement";
            $this->deleteTable($table, $id);

        }
    }