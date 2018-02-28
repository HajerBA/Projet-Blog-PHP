<?php

namespace simplon\dao;
use simplon\entities\Person;
use simplon\dao\Connect;

class DaoPerson {

       
    public function getAll():array {
        
        $tab = [];
       
        try {
       
        $query = Connect::getInstance()->prepare('SELECT * FROM person');
        
        $query->execute();
        
        while($row = $query->fetch()) {
           
            $pers = new Person($row['name'], 
                               $row['surname'], 
                               $row['mail'],
                               $row['passwd'],
                               $row['gender'],
                               $row['id']);
            //On ajoute la person créée à notre tableau
            $tab[] = $pers;
        }
    }catch(\Exception $e) {
        echo $e;
    }
        //On return le tableau
        return $tab;
    }

    public function getNbarticle(int $id){
             
        try {
        
        
        $query = Connect::getInstance()->prepare('SELECT COUNT(article.id) as nbarticle,person.id   
         FROM person
         INNER JOIN article ON person.id = article.id_person
         WHERE person.id=:id
         GROUP BY person.id');
        $query->bindValue(':id',$id, \PDO::PARAM_INT);//la valeur de :id c $id
        $query->execute();
        While($row = $query->fetch()) {
           
            
            
            $nbarticle = $row['nbarticle'];
            return $nbarticle;
        }
    }catch(\Exception $e) {
        echo $e;
    }
        
        return $nbarticle;
    }
    
   
    public function getById(int $id){
             
        try {
        
        
        $query = Connect::getInstance()->prepare('SELECT * FROM person WHERE id=:id');
        $query->bindValue(':id',$id, \PDO::PARAM_INT);//la valeur de :id c $id
        $query->execute();
        
        if($row = $query->fetch()) {
         
            $pers = new Person($row['name'], 
                               $row['surname'], 
                               $row['mail'],
                               $row['passwd'],
                               $row['gender'],
                               $row['id']);
           return $pers;
        }
    }catch(\Exception $e) {
        echo $e;
    }
        return $pers;
    }
 
    public function add(Person $pers){
             
        try {
        
        $query = Connect::getInstance()->prepare('INSERT INTO person (name, surname, mail, passwd, gender) VALUES ( :name, :surname, :mail, :passwd, :gender)');
        $query->bindValue(':name',$pers->getName(), \PDO::PARAM_STR);
        $query->bindValue(':surname',$pers->getSurname(), \PDO::PARAM_STR);
        $query->bindValue(':mail',$pers->getMail(), \PDO::PARAM_STR);
        $query->bindValue(':passwd',$pers->getPassword(), \PDO::PARAM_STR);
        $query->bindValue(':gender',$pers->getGender(), \PDO::PARAM_STR);//la valeur de :id c $id
       
        $query->execute();

        $pers->setId(Connect::getInstance()->lastInsertId());//pour savoir la valeur d'id ajouté 
        
     //  return $pers;
    }catch(\Exception $e) {
        echo $e;
    }
        return null;
}

    public function update(Person $pers){
             
        try {
        
        
        $query = Connect::getInstance()->prepare('UPDATE person SET name=:name,birth_date=:birth_date,gender=:gender WHERE id=:id');
        $query->bindValue(':name',$pers->getName(), \PDO::PARAM_STR);
       
        $query->bindValue(':id',$pers->getID(), \PDO::PARAM_INT);//la valeur de :id c $id
        
        $query->execute();

    }catch(\Exception $e) {
        echo $e;
    }
        return null;
    }

    public function delete(int $id){
             
        try {
        
        
        $query = Connect::getInstance()->prepare('DELETE FROM person WHERE id=:id');
        $query->bindValue(':id',$id, \PDO::PARAM_INT);
        
        $query->execute();

        
        
     //  return $pers;
    }catch(\Exception $e) {
        echo $e;
    }
        return null;
    }

    public function getMail(string $mail){
             
        try {
        
        
        $query = Connect::getInstance()->prepare('SELECT * FROM person WHERE mail=:mail');
               
        $query->bindValue(':mail',$mail, \PDO::PARAM_STR);
        $query->execute();
        if($row = $query->fetch()) {
         
            $pers = new Person($row['name'], 
                               $row['surname'], 
                               $row['mail'],
                               $row['passwd'],
                               $row['gender'],
                               $row['id']);
           return $pers;
        }
    }catch(\Exception $e) {
        echo $e;
    }
        return null;
    }

}
