<?php

namespace simplon\dao;
use simplon\entities\Article;
use simplon\dao\Connect;
class DaoArticle {

    private $pdo;

   
    /**
     * @return article[] la liste des article ou une liste vide
     */
    public function getAll():array {
        
        $tab = [];
        
        try {
        
        $query = Connect::getInstance()->prepare('SELECT * FROM article');
        
        $query->execute();
        
        while($row = $query->fetch()) {
           
            $art = new Article($row['theme'], 
                                $row['contenu'],
                        $row['id']);
            //On ajoute la article créée à notre tableau
            $tab[] = $art;
        }
    }catch(\Exception $e) {
        echo $e;
    }
        //On return le tableau
        return $tab;
    }

   
   

    public function getByUserId(int $id){
         $tab=[];    
        try {
        
        
        $query = Connect::getInstance()->prepare('SELECT * FROM article WHERE id_person=:id');
        $query->bindValue(':id',$id, \PDO::PARAM_INT);//la valeur de :id c $id
        $query->execute();
        
        while($row = $query->fetch()) {
           
            $art = new Article($row['theme'], 
                                $row['contenu'],
                        $row['id']);
            //On ajoute la article créée à notre tableau
            $tab[] = $art;
        }
    }catch(\Exception $e) {
        echo $e;
    }
        return $tab;
    }
    public function getById(int $id){
        $tab=[];    
       try {
       
       
       $query = Connect::getInstance()->prepare('SELECT * FROM article WHERE id=:id');
       $query->bindValue(':id',$id, \PDO::PARAM_INT);//la valeur de :id c $id
       $query->execute();
       
       if($row = $query->fetch()) {
          
           $art = new Article($row['theme'], 
                               $row['contenu'],
                       $row['id']);
           //On ajoute la article créée à notre tableau
           return $art;
       }
   }catch(\Exception $e) {
       echo $e;
   }
       return null;
   }


    public function add(Article $art,$id){
             
        try {
        
        
        $query = Connect::getInstance()->prepare('INSERT INTO article (theme,contenu,id_person) VALUES (:theme ,:contenu,:id_person)');
        $query->bindValue(':theme',$art->getTheme(), \PDO::PARAM_STR);
        $query->bindValue(':contenu',$art->getContenu(), \PDO::PARAM_STR);
        $query->bindValue(':id_person',$id, \PDO::PARAM_INT);
      
        
       
        $query->execute();

        $art->setId(Connect::getInstance()->lastInsertId());//pour savoir la valeur d'id ajouté 
        
     //  return $art;
    }catch(\Exception $e) {
        echo $e;
    }
        return null;
    }
    public function update(Article $art){
             
        try {
        
        
        $query = Connect::getInstance()->prepare('UPDATE article SET theme=:theme,contenu=:contenu WHERE id=:id');
        $query->bindValue(':theme',$art->getTheme(), \PDO::PARAM_STR);
        $query->bindValue(':contenu',$art->getContenu(), \PDO::PARAM_STR);//la valeur de :id c $id
        $query->bindValue(':id',$art->getId(), \PDO::PARAM_INT);//la valeur de :id c $id
        
        $query->execute();

    }catch(\Exception $e) {
        echo $e;
    }
        return null;
    }

    public function delete(int $id){
             
        try {
        
        
        $query = Connect::getInstance()->prepare('DELETE FROM article WHERE id=:id');
        $query->bindValue(':id',$id, \PDO::PARAM_INT);
        
        $query->execute();

        
        
     //  return $art;
    }catch(\Exception $e) {
        echo $e;
    }
        return null;
    }

    public function getThemeByID($id){
        $tab=[];   
        try {
        
        
        $query = Connect::getInstance()->prepare('SELECT * FROM article WHERE article.id_person=:id');
        
        $query->bindValue(':id',$id, \PDO::PARAM_INT);
        
        $query->execute();
            while($row = $query->fetch()) {
           
                $art = new Article($row['theme'], 
                                    $row['contenu'],
                            $row['id']);
                //On ajoute la article créée à notre tableau
                $tab[] = $art;
            }
        
       

    }catch(\Exception $e) {
        echo $e;
    }
        return $tab;
    }
    

}
