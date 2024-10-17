<?php
    class RoleManager extends Manager{

        public function find($id,$type="object"){
            $table="role";
            $resultat=$this->findTable($table,$id);
            if($type=="object"){
                $resultat=new Role($resultat);
            }
            return $resultat;
        }
        public function findAll($conditions=[],$type="object",$order=""){
            $table="role";
            $resultats=$this->findAllTable($table,$conditions,$order);
            if($type=="object"){
                $objects=[];
                foreach($resultats as $resultat){
                    $object=new Role($resultat);
                    $objects[]=$object;
                }
                $resultats=$objects;
            }
            return $resultats;
        } 
        public function findOne($conditions=[],$type="object",$order=""){
            $table="role";
            $resultat=$this->findOneTable($table,$conditions,$order);
            if($type=="object"){
                $object=new Role($resultat);
                $resultat=$object;
            }
            return $resultat;
        }         
        public function searchByCondition($columns,$mot,$conditions=[],$type="object",$orderBy="",$limit=0,$offset=0){
            $table="role";
            $resultats=$this->searchTableByCondition($table,$columns,$mot,$conditions,$orderBy,$limit,$offset);
            if($type=="object"){
                $objects=[];
                foreach($resultats as $resultat){
                    $object=new Role($resultat);
                    $objects[]=$object;
                }
                $resultats=$objects;
            }
            return $resultats;
        }

        public function insert($data){
            $table="role";
            $this->insertTable($table,$data);
        }
        public function update($data){
            $table="role";
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
            $table="role";
            $this->deleteTable($table,$id);
        }
        
    }