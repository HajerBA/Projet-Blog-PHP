<?php

namespace simplon\entities;

class Article {
    private $id;
    private $theme;
    private $contenu;
  

    public function __construct(string $theme,
                                string $contenu,
                                int $id=null) {
        $this->id = $id;
        $this->theme = $theme;
        $this->contenu = $contenu;
        
    }
    

    /**
     * Get the value of id
     */ 
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     *
     */ 
    public function getTheme():string
    {
        return $this->theme;
    }

    /**
     * 
     *
     * @return  self
     */ 
    public function setTheme(string $theme)
    {
        $this->theme = $theme;

        return $this;
    }

     
    public function getContenu(): string 
    {
        return $this->contenu;
    }

    /**
     **
     * @return  self
     */ 
    public function setContenu(string $contenu)
    {
        $this->continue = $contenu;

        return $this;
    }

   
   
}