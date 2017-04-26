<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * DsSimilarProduct
 *
 * @ORM\Table(name="ds_similar_product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DsSimilarProductRepository")
 */
class DsSimilarProduct
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
     * @ORM\Column(name="producer", type="string", length=100)
     */
    private $producer;

    /**
     *
     * @ORM\ManyToMany(targetEntity="DsProduct", mappedBy="similarProducts", cascade={"persist"})
     **/
    protected $products;


    public function __construct()
    {
        $this->products = new ArrayCollection();
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
     * @return DsSimilarProduct
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
     * Set producer
     *
     * @param string $producer
     *
     * @return DsSimilarProduct
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;

        return $this;
    }

    /**
     * Get producer
     *
     * @return string
     */
    public function getProducer()
    {
        return $this->producer;
    }

    public function __toString()
    {
        return $this->getName();
    }

    ///////////////////////////// PRODUCT
    public function addProduct(\AppBundle\Entity\DsProduct $product)
    {
        if ($this->products->contains($product)) {
            return;
        }

        $this->products->add($product);
        $product->addSimilarProduct($this);
    }

    public function removeProduct(\AppBundle\Entity\DsProduct $product)
    {
        if (!$this->products->contains($product)) {
            return;
        }

        $this->products->removeElement($product);
        $product->removeSimilarProduct($this);
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setProducts($products)
    {
        $this->products->clear();
        $this->products = new ArrayCollection($products);
    }
}

