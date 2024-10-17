<?php
    class TypeTiersManager extends Manager {

        public function find($id,$type="object"){
            $table="typetiers";
            $resultat=$this->findTable($table,$id);
            if($type=="object"){
                $resultat=new TypeTiers($resultat);
            }
            return $resultat;
        }
        public function findAll($conditions=[],$type="object",$order=""){
            $table="typetiers";
            $resultats=$this->findAllTable($table,$conditions,$order);
            if($type=="object"){
                $objects=[];
                foreach($resultats as $resultat){
                    $object=new TypeTiers($resultat);
                    $objects[]=$object;
                }
                $resultats=$objects;
            }
            return $resultats;
        } 
        public function findOne($conditions=[],$type="object",$order=""){
            $table="typetiers";
            $resultat=$this->findOneTable($table,$conditions,$order);
            if($type=="object"){
                $object=new TypeTiers($resultat);
                $resultat=$object;
            }
            return $resultat;
        }         
        public function searchByCondition($columns,$mot,$conditions=[],$type="object",$orderBy="",$limit=0,$offset=0){
            $table="typetiers";
            $resultats=$this->searchTableByCondition($table,$columns,$mot,$conditions,$orderBy,$limit,$offset);
            if($type=="object"){
                $objects=[];
                foreach($resultats as $resultat){
                    $object=new TypeTiers($resultat);
                    $objects[]=$object;
                }
                $resultats=$objects;
            }
            return $resultats;
        }

        public function insert($data) {
            $table = "typetiers";
            $this->insertTable($table, $data);
        }

        public function update($data) {
            $table = "typetiers";
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
            $table = "typetiers";
            $this->deleteTable($table, $id);

        }
    }