<?php 
require_once("config/parametre.php");
class Manager {
    // Fonctionne de connection pour securisation
    function connexion() {
        // $dns = "mysql:host=127.0.0.1;dbname=dwwm_2024;port=3306;charset=utf8"; ----------pour mariaDB
        // $connexion = new PDO($dns,"root",""); ----------pour mariaDB
        $dsn = "pgsql:host=127.0.0.1;dbname=dwwm_2024;options='--client_encoding=UTF8'";
        try{
            $connexion = new PDO($dsn,"postgres","160717");
            return $connexion;
        } catch(Exception $e) {
            echo "<h1 style='color:red; text-align:center;'>Impossible de se connecter à la base de données!</h1>";
            die;
        } 
    }

    // Fonctionne de connection plus securisée par les constants definis dans config/parametre.php
    function getConnexion($host = HOST, $dbname = DBNAME, $user = USER, $password = PASSWORD) {
        $dsn = "pgsql:host=$host;dbname=$dbname;options='--client_encoding=UTF8'";
        try{
            $connexion = new PDO($dsn, $user, $password);
            return $connexion;
        } catch(Exception $e) {
            echo "<h1 style='color:red; text-align:center;'>Impossible de se connecter à la base de données!</h1>";
            die;
        } 
    }
    // function getConnexion($host = HOST, $dbname = DBNAME, $user = USER, $password = PASSWORD) {
    //     $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    //     try{
    //         $connexion = new PDO($dsn, $user, $password);
    //         return $connexion;
    //     } catch(Exception $e) {
    //         echo "<h1 style='color:red; text-align:center;'>Impossible de se connecter à la base de données!</h1>";
    //         die;
    //     } 
    // }

    // Creation de la fonction saveTable 

    public function findTable($table,$id){
        $connexion=$this->getConnexion();
        $sql="select * from $table where id=?";
        $stmt=$connexion->prepare($sql);
        $stmt->execute([$id]);
        $resultat=$stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }
    //------
    public function findAllTable_old_2($table, $conditions=[],$order=""){
        $connexion=$this->getConnexion();
        $condition="";
        $values=[];
        foreach($conditions as $key=>$value){
            if($condition==""){
                $condition.=" $key=? ";
            }else{
                $condition.=" and $key=? ";
            }
            $values[]=$value;
        }
        $condition=($condition=="")?'true':$condition;
        $sql="select * from $table where $condition $order ";
        $requete=$connexion->prepare($sql);
        $requete->execute($values);
        $resultats=$requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultats;

    }

    public function findAllTable($table, $conditions=[],$order=""){
        $columns=[];
        $values=[];
        foreach($conditions as $key=>$value){
            $columns[]="$key=?";
            $values[]=$value;
        }
        //----transformation $columns en texte
        if($columns){  // $columns !=[]
            $columns=implode(" and ",$columns);
        }else{
            $columns="true";
        }
        $connexion=$this->getConnexion();
        $sql="select * from $table where $columns $order";
        // echo "<h1>$sql</h1>";die;
        // print_r($values) ;die;
        $stmt=$connexion->prepare($sql);
        $stmt->execute($values);
        $resultats=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultats;
    }   
    public function findOneTable($table, $conditions=[],$order=""){
        $columns=[];
        $values=[];
        foreach($conditions as $key=>$value){
            $columns[]="$key=?";
            $values[]=$value;
        }
        //----transformation $columns en texte
        if($columns){  // $columns !=[]
            $columns=implode(" and ",$columns);
        }else{
            $columns="true";
        }
        $connexion=$this->getConnexion();
        $sql="select * from $table where $columns $order";
        $stmt=$connexion->prepare($sql);
        $stmt->execute($values);
        $resultat=$stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }     
    public function searchTableByCondition($table,$columns,$mot,$conditions=[],$orderBy="",$limit=0,$offset=0){
        $condition="";
        $values=[];
        foreach($columns as $value){
            if($condition==""){
                $condition.="$value ilike ?";
            }else{
                $condition.=" or $value ilike ?";
            }
            $values[]="%$mot%";
        }
        $condition=" ($condition) ";
        foreach($conditions as $key=>$value){
            $condition.=" AND $key=?";
            $values[]=$value;
        }
        $condition.=" $orderBy ";
        if($limit){
            $condition.=" limit $limit "; 
        }
        if($offset){
            $condition.=" offset $offset ";
        }
        $connexion=$this->getConnexion();
        $sql="select * from $table where $condition";
        $stmt=$connexion->prepare($sql);
        $stmt->execute($values);
        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;

    } 

    //----Creation de la fonction insertTable
    public function insertTable($table,$data){
        $columns=[]; // initiation d'une variable tableau ou array
        $values=[];
        $pis=[]  ; // Tableau contenant des poin d'iterrogation
        foreach($data as $key=>$value){
            if($key!='id'){
                $columns[]=$key; // rajouter dans la variables $columns le conteny de $key
                $values[]=$value;
                $pis[]="?";
            }
        }
        $columns=implode(",",$columns);
        $pis=implode(",",$pis);
        $connexion=$this->getConnexion();
        $sql="insert into $table ($columns) values ($pis) ";
        $requete=$connexion->prepare($sql);
        $requete->execute($values);
    }
    public function updateTable($table,$data){
        $sets=[];
        $values=[];
        $connexion=$this->getConnexion();
        foreach($data as $key=>$value){
            if($key!='id'){
                $sets[]="$key=?";
                $values[]=$value;
            }
        }
        $values[]=$data['id'];
        $sets=implode(",",$sets);
        $sql="update $table set $sets where id=?";
        $requete=$connexion->prepare($sql);
        $requete->execute($values);
    }

    public function deleteTable($table, $id)
    {
        $connexion = $this->getConnexion();
        $sql = "delete from $table where id = ?";
        $value = [$id];
        $requete = $connexion->prepare($sql);
        $requete->execute($value);
    } 

    public function getColumnsTable($table){
        $connexion=$this->getConnexion();
        $sql="desc $table";
        $stmt=$connexion->query($sql);//   $stmt= $connexion->prepare($sql);  $stmt->execute();
        $resultat=$stmt->fetchAll(PDO::FETCH_COLUMN);
        return $resultat;
    }

}