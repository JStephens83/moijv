<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Table(indexes={@Index(name="state_index", columns={"state"})})
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    
    /**
     * @ORM\column(type="string", length=100)
     * @var string 
     */
    private $name;
    
    /**
     * @ORM\column(type="text")
     * @var string 
     */
    private $description;
    
    /**
     * @ORM\column(type="string", length=255)
     * 
     */
    //Ici, on ne met pas de var car elle aura 2 types (file coté php / string coté Symfony)
    private $image;
    
    /**
     * @ORM\column(type="string", length=255)
     * @var string 
     */
    private $state;
    
    //lien entre 2 tables
    //@var User va permettre de faire ce lien
    //@ORM ManyToOne() = (1,N)
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="products")
     * @var User
     */
    private $user;
    
    
    // Getters & Setters
    
    public function getUser(): User {
        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

        
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getImage() {
        return $this->image;
    }

    public function getState() {
        return $this->state;
    }

   

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }


}
