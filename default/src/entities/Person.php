<?php

namespace simplon\entities;

class Person {
    private $id;
    private $name;
    private $surname;
    private $mail;
    private $passwd;
    private $gender;

    public function __construct(string $name,
                                string $surname,
                                string $mail,
                                string $passwd,
                                string $gender,
                                int $id=null) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->mail = $mail;
        $this->passwd= $passwd;    
        $this->gender = $gender;
    }
    

    /**
     * Get the value of id
     */ 
    public function getId():int
    {
        return $this->id;
    }
     
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName():string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of surname
     */ 
    public function getSurname(): string 
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     *
     * @return  self
     */ 
    public function setSurname(string  $surname)
    {
        $this->surname = $surname;

        return $this;
    }
    
    public function getMail(): string 
    {
        return $this->mail;
    }

    /**
     * Set the value of surname
     *
     * @return  self
     */ 
    public function setMail(string  $mail)
    {
        $this->mail = $mail;

        return $this;
    }
    public function getPassword(): string 
    {
        return $this->passwd;
    }

    /**
     * Set the value of surname
     *
     * @return  self
     */ 
    public function setPassword(string  $passwd)
    {
        $this->passwd = $passwd;

        return $this;
    }
    /**
     * Get the value of gender
     */ 
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender(string $gender)
    {
        $this->gender = $gender;

        return $this;
    }

   
}