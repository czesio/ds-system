<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * DsProduct
 *
 * @ORM\Table(name="ds_product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DsProductRepository")
 */
class DsProduct
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
     * @ORM\Column(name="serial_no", type="string", length=10, unique=true)
     */
    private $serialNo;

    /**
     * @var int
     *
     * @ORM\Column(name="category_id", type="integer")
     */
    private $categoryId;

    /**
     * @var int
     *
     * @ORM\Column(name="k_1", type="integer", nullable=true)
     */
    private $k1;

    /**
     * @var string
     *
     * @ORM\Column(name="v_1", type="string", length=255, nullable=true)
     */
    private $v1;

    /**
     * @var int
     *
     * @ORM\Column(name="k_2", type="integer", nullable=true)
     */
    private $k2;

    /**
     * @var string
     *
     * @ORM\Column(name="v_2", type="string", length=255, nullable=true)
     */
    private $v2;

    /**
     * @var int
     *
     * @ORM\Column(name="k_3", type="integer", nullable=true)
     */
    private $k3;

    /**
     * @var string
     *
     * @ORM\Column(name="v_3", type="string", length=255, nullable=true)
     */
    private $v3;

    /**
     * @var int
     *
     * @ORM\Column(name="k_4", type="integer", nullable=true)
     */
    private $k4;

    /**
     * @var string
     *
     * @ORM\Column(name="v_4", type="string", length=255, nullable=true)
     */
    private $v4;

    /**
     * @var int
     *
     * @ORM\Column(name="k_5", type="integer", nullable=true)
     */
    private $k5;

    /**
     * @var string
     *
     * @ORM\Column(name="v_5", type="string", length=255, nullable=true)
     */
    private $v5;

    /**
     * @var int
     *
     * @ORM\Column(name="k_6", type="integer", nullable=true)
     */
    private $k6;

    /**
     * @var string
     *
     * @ORM\Column(name="v_6", type="string", length=255, nullable=true)
     */
    private $v6;

    /**
     *
     * @ORM\ManyToMany(targetEntity="DsImage", inversedBy="products", cascade={"persist"})
     * @ORM\JoinTable(name="ds_product_image")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getSerialNo();
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
     * Set serialNo
     *
     * @param string $serialNo
     *
     * @return DsProduct
     */
    public function setSerialNo($serialNo)
    {
        $this->serialNo = $serialNo;

        return $this;
    }

    /**
     * Get serialNo
     *
     * @return string
     */
    public function getSerialNo()
    {
        return $this->serialNo;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return DsProduct
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
     * Set k1
     *
     * @param integer $k1
     *
     * @return DsProduct
     */
    public function setK1($k1)
    {
        $this->k1 = $k1;

        return $this;
    }

    /**
     * Get k1
     *
     * @return int
     */
    public function getK1()
    {
        return $this->k1;
    }

    /**
     * Set v1
     *
     * @param string $v1
     *
     * @return DsProduct
     */
    public function setV1($v1)
    {
        $this->v1 = $v1;

        return $this;
    }

    /**
     * Get v1
     *
     * @return string
     */
    public function getV1()
    {
        return $this->v1;
    }

    /**
     * Set k2
     *
     * @param integer $k2
     *
     * @return DsProduct
     */
    public function setK2($k2)
    {
        $this->k2 = $k2;

        return $this;
    }

    /**
     * Get k2
     *
     * @return int
     */
    public function getK2()
    {
        return $this->k2;
    }

    /**
     * Set v2
     *
     * @param string $v2
     *
     * @return DsProduct
     */
    public function setV2($v2)
    {
        $this->v2 = $v2;

        return $this;
    }

    /**
     * Get v2
     *
     * @return string
     */
    public function getV2()
    {
        return $this->v2;
    }

    /**
     * Set k3
     *
     * @param integer $k3
     *
     * @return DsProduct
     */
    public function setK3($k3)
    {
        $this->k3 = $k3;

        return $this;
    }

    /**
     * Get k3
     *
     * @return int
     */
    public function getK3()
    {
        return $this->k3;
    }

    /**
     * Set v3
     *
     * @param string $v3
     *
     * @return DsProduct
     */
    public function setV3($v3)
    {
        $this->v3 = $v3;

        return $this;
    }

    /**
     * Get v3
     *
     * @return string
     */
    public function getV3()
    {
        return $this->v3;
    }

    /**
     * Set k4
     *
     * @param integer $k4
     *
     * @return DsProduct
     */
    public function setK4($k4)
    {
        $this->k4 = $k4;

        return $this;
    }

    /**
     * Get k4
     *
     * @return int
     */
    public function getK4()
    {
        return $this->k4;
    }

    /**
     * Set v4
     *
     * @param string $v4
     *
     * @return DsProduct
     */
    public function setV4($v4)
    {
        $this->v4 = $v4;

        return $this;
    }

    /**
     * Get v4
     *
     * @return string
     */
    public function getV4()
    {
        return $this->v4;
    }

    /**
     * Set k5
     *
     * @param integer $k5
     *
     * @return DsProduct
     */
    public function setK5($k5)
    {
        $this->k5 = $k5;

        return $this;
    }

    /**
     * Get k5
     *
     * @return int
     */
    public function getK5()
    {
        return $this->k5;
    }

    /**
     * Set v5
     *
     * @param string $v5
     *
     * @return DsProduct
     */
    public function setV5($v5)
    {
        $this->v5 = $v5;

        return $this;
    }

    /**
     * Get v5
     *
     * @return string
     */
    public function getV5()
    {
        return $this->v5;
    }

    /**
     * Set k6
     *
     * @param integer $k6
     *
     * @return DsProduct
     */
    public function setK6($k6)
    {
        $this->k6 = $k6;

        return $this;
    }

    /**
     * Get k6
     *
     * @return int
     */
    public function getK6()
    {
        return $this->k6;
    }

    /**
     * Set v6
     *
     * @param string $v6
     *
     * @return DsProduct
     */
    public function setV6($v6)
    {
        $this->v6 = $v6;

        return $this;
    }

    /**
     * Get v6
     *
     * @return string
     */
    public function getV6()
    {
        return $this->v6;
    }

    public function addImage($image)
    {
        if ($this->images->contains($image)) {
            return;
        }

        $this->images->add($image);
        $image->addProduct($this);
    }

    public function removeImage($image)
    {
        if (!$this->images->contains($image)) {
            return;
        }

        $this->images->removeElement($image);
        $image->removeProduct($this);
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

