<?php
    class UsersManager extends Manager{

        public function find($id,$type="object"){
            $table="users";
            $resultat=$this->findTable($table,$id);
            if($type=="object"){
                $resultat=new Users($resultat);
            }
            return $resultat;
        }
        public function findAll($conditions=[],$type="object",$order=""){
            $table="users";
            $resultats=$this->findAllTable($table,$conditions,$order);
            if($type=="object"){
                $objects=[];
                foreach($resultats as $resultat){
                    $object=new Users($resultat);
                    $objects[]=$object;
                }
                $resultats=$objects;
            }
            return $resultats;
        } 
        public function findOne($conditions=[],$type="object",$order=""){
            $table="users";
            $resultat=$this->findOneTable($table,$conditions,$order);
            if($type=="object"){
                $object=new Users($resultat);
                $resultat=$object;
            }
            return $resultat;
        }         
        public function searchByCondition($columns,$mot,$conditions=[],$type="object",$orderBy="",$limit=0,$offset=0){
            $table="users";
            $resultats=$this->searchTableByCondition($table,$columns,$mot,$conditions,$orderBy,$limit,$offset);
            if($type=="object"){
                $objects=[];
                foreach($resultats as $resultat){
                    $object=new Users($resultat);
                    $objects[]=$object;
                }
                $resultats=$objects;
            }
            return $resultats;
        }

        public function insert($data){
            $table="users";
            $this->insertTable($table,$data);
        }
        public function update($data){
            $table="users";
            $this->updateTable($table,$data);
        }

        public function save($data){
            $id=(int) $data['id'];
            if($id==0){
                $this->insert($data);
            }else{
                $this->update($data);
            }
        }

        public function delete($id){
            $table="users";
            $this->deleteTable($table,$id);
        }
        
    }