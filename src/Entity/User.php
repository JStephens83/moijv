<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable {

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

    //lien entre 2 tables
    //@var User va permettre de faire ce lien
    //@ORM OneToMany() = (N,1)

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="user")
     * @var Collection
     */
    private $products;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $roles;

    public function __construct() {
        $this->products = new ArrayCollection();
    }

    public function eraseCredentials() {
        
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
                $this->id,
                $this->username,
                $this->password,
                ) = unserialize($serialized);
    }

    
    
    
    
    //Getters & Setters
        // clic droit > insert code > getters & setters > clic la box User > et les 2 cases en bas (fluent et public)

    public function setRoles($roles) {
        $this->roles = $roles;
        return $this;
    }

    public function getSalt() {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles() {
        //Nos roles seront stockés sous ce format : ROLE_USER|ROLE_ADMIN
        return explode ('|', $this->roles);
    }

    public function getProducts(): Collection {// Signifie qu'il retournera un tableau, products ci-dessous sera sous forme de collection
        return $this->products;
    }

    public function setProducts(Collection $products) {
        $this->products = $products;
        return $this;
    }


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
