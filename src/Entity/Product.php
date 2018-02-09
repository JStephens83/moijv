<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints as Assert; //Pour la validation de données
use App\Validator\Constraints as CustomAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Table(indexes={@Index(name="state_index", columns={"state"})})
 */
class Product {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\column(type="string", length=100)
     * @Assert\length(min=2, max=100)
     * @var string
     */
    private $name;

    /**
     * @ORM\column(type="text")
     * @Assert\length(min=20, max=6500)
     * @CustomAssert\BadWord(badword={"crotte","zut"})
     * @var string 
     */
    private $description;

    /**
     * @ORM\column(type="string", length=255)
     * @Assert\Image(minWidth=300,
     *      minHeight=300,
     *      maxSize=1024)
     * 
     */
    //Ici, on ne met pas de var car elle aura 2 types (file coté php / string coté Symfony)
    private $image;

    /**
     * @ORM\column(type="string", length=255)
     * @Assert\Choice({"very bad", "bad", "average", "good", "very good"})
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

    /**
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="products")
     * @var Collection
     */
    private $tags;

    public function __construct() {
        $this->tags = new ArrayCollection();
    }

        // Méthode pour les tags
    public function addTag($tag) {
        if ($this->getTags()->contains($tag)) {
            return;
        }

        $this->getTags()->add($tag);
        $tag->getProducts()->add($this);
    }

    // Getters & Setters

    public function getTags(): Collection {
        return $this->tags;
    }

    public function setTags(Collection $tags) {
        $this->tags = $tags;
        return $this;
    }

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
