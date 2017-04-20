<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * DsCategory
 *
 * @ORM\Table(name="ds_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DsCategoryRepository")
 */
class DsCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * One Student has One Student.
     * @ORM\OneToOne(targetEntity="DsCategory")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $categoryId;

    /**
     *
     * @ORM\ManyToMany(targetEntity="DsImage", inversedBy="categories", cascade={"persist"})
     * @ORM\JoinTable(name="ds_category_image")
     */
    private $images;


    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return DsCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return DsCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return DsCategory
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set deep
     *
     * @param integer $deep
     *
     * @return DsCategory
     */
    public function setDeep($deep)
    {
        $this->deep = $deep;

        return $this;
    }

    /**
     * Get deep
     *
     * @return int
     */
    public function getDeep()
    {
        return $this->deep;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function addImage($image)
    {
        if ($this->images->contains($image)) {
            return;
        }

        $this->images->add($image);
        $image->addCategory($this);
    }

    public function removeImage($image)
    {
        if (!$this->images->contains($image)) {
            return;
        }

        $this->images->removeElement($image);
        $image->removeCategory($this);
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setImages($images)
    {
        // This is the owning side, we have to call remove and add to have change in the category side too.
        foreach ($this->getImages() as $image) {
            $this->removeImage($image);
        }
        foreach ($images as $image) {
            $this->addImage($image);
        }
    }


}

