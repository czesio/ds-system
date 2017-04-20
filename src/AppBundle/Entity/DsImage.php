<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * DsImage
 *
 * @ORM\Table(name="ds_image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DsImageRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @Vich\Uploadable
 */
class DsImage
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
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     *
     * @ORM\ManyToMany(targetEntity="DsProduct", mappedBy="images", cascade={"persist"})
     **/
    protected $products;

    /**
     *
     * @ORM\ManyToMany(targetEntity="DsCategory", mappedBy="images", cascade={"persist"})
     **/
    protected $categories;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $imageName;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->categories = new ArrayCollection();
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
     * @return DsImage
     */
    public function setImageName($name)
    {
        $this->imageName = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set updatedAt
     *
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    ///////////////////////////// PRODUCT
    public function addProduct(\AppBundle\Entity\DsProduct $product)
    {
        if ($this->products->contains($product)) {
            return;
        }

        $this->products->add($product);
        $product->addImage($this);
    }

    public function removeProduct($product)
    {
        if (!$this->products->contains($product)) {
            return;
        }

        $this->products->removeElement($product);
        $product->removeImage($this);
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

    ///////////////////////////// CATEGORY
    public function addCategory(\AppBundle\Entity\DsCategory $category)
    {
        if ($this->categories->contains($category)) {
            return;
        }

        $this->categories->add($category);
        $category->addImage($this);
    }

    public function removeCategory($category)
    {
        if (!$this->categories->contains($category)) {
            return;
        }

        $this->categories->removeElement($category);
        $category->removeImage($this);
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories($categories)
    {
        $this->categories->clear();
        $this->categories = new ArrayCollection($categories);
    }

    /**
     * @param File|UploadedFile $image
     */
    public function setImageFile($image = null)
    {
        $this->imageFile = $image;
        //$this->image = $image;
        //var_dump($image->getClientOriginalName());die();
        //$this->image = ((is_object($image) && method_exists($image, 'getClientOriginalName')) ? $image->getClientOriginalName() : '');
        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            //$this->setImageName($image->getClientOriginalName());die();
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
//        var_dump($this->getImage());die();
        //$this->setImage();
//        if (is_object($this->getImageFile()))
//        {
//            $this->image = ($this->getImageFile()->getClientOriginalName());
//        }
        //$this->setImageName($this->getImage()->getClientOriginalName());
//$this->setImageName($this->getImage()); //->getImageFile()->getClientOriginalName() );
 //die();
//        $this->tempFile = $this->getAbsolutePath();
//
//
//
//        $this->oldFile = $this->getPath();
//        $this->updateAt = new \DateTime();
//
//        if (null !== $this->file) {
//            $this->path = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
//        }
//
//        if(isset($this->file)){
//            $data = getimagesize($this->file);
//            $largeur = $data[0];
//            $hauteur = $data[1];
//            $this->setHauteur($hauteur);
//            $this->setLargeur($largeur);
//            if($largeur<300 || $hauteur<300 || $largeur>2000 || $hauteur>2000){
//                $this->path= "";
//                $this->file= NULL;
//                $this->alt = "Votre image est trop grande ou trop petite veuillez choisir une autre image s.v.p";
//            }
//        }
    }

    public function getCos() {
        return $this->getImageName();
    }
}
