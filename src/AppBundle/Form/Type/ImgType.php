<?php
// src/AppBundle/Form/Type/ImageType.php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class ImgType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('imageFile', FileType::class);
        $builder->add('imageFile', VichImageType::class, [
            'required' => false,
            'allow_delete' => true, // optional, default is true
            'download_link' => true, // optional, default is true
        //    //'base_path' => 'uploads/images/products/'
        //    //'download_uri' => 'uploads/images/products/', // optional, if not provided - will automatically resolved using storage
        ]);
//            ->add('product', 'entity',
//                array('class' => 'Aco\InvoiceBundle\Entity\Product',
//                    'required' => true,
//                    'label' => 'Produkt',
//                    'expanded' => false,
//                    'by_reference' => true,
//                    'multiple' => false,
//                    'empty_value' => 0
//                ), array())
//            //->add('invoice','entity',
//            //    array('class' => 'Aco\InvoiceBundle\Entity\Invoice',
//            //        'required' => true,
//            //        'label' => 'Faktura',
//            //        'expanded' => false,
//            //        'by_reference' => true,
//            //        'multiple' => false,
//            //    ), array())
//            ->add('unit_quantity')
//            ->add('price')
//            ->add('netto')
//            ->add('vat')
//        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\DsImage',
        ));
    }
}