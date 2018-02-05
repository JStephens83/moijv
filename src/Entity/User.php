<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\column(type="string", length=100, nullable=true)
     * @var string
     */
    private $lastname;
    
    /**
     * @ORM\column(type="string", length=100, nullable=true)
     * @var string
     */
    private $firstname;
    
    /**
     * @ORM\column(type="string", length=255)
     * @var string
     */
    private $email;
    
    /**
     * @ORM\column(type="string", length=255)
     * @var string
     */
    private $password;
   
    /**
     * @ORM\column(type="string", length=100)
     * @var string
     */
    private $username;
    
    // Datetime fait appel à un objet raacine (date) et fais donc appel à une fonction native PHP et donc à un autre namespace, Il faut donc indiquer un "\" pour éviter qu'il cherche dans le mapping d'ORM (en haut: use Doctrine\ORM\Mapping as ORM;)
     /**
     * @ORM\column(type="date", length=255)
     * @var \datetime
     */
    private $birthdate;
    
    // clic droit > insert code > getters & setters > clic la box User > et les 2 cases en bas (fluent et public)
    public function getId() {
        return $this->id;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getBirthdate(): \datetime {
        return $this->birthdate;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function setBirthdate(\datetime $birthdate) {
        $this->birthdate = $birthdate;
        return $this;
    }


    
    
    
}
