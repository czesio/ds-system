<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\DsProduct;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

/**
 * This is an example of how to use a custom controller for a backend entity.
 */
class DsProductController extends BaseAdminController
{
    public function copyProductAction()
    {
        // controllers extending the base AdminController can access to the
        // following variables:
        //   $this->request, stores the current request
        //   $this->em, stores the Entity Manager for this Doctrine entity

        // change the properties of the given entity and save the changes
        $id = $this->request->query->get('id');
        $entity = $this->em->getRepository('AppBundle:DsProduct')->find($id);
        //$entity->setStock(100 + $entity->getStock());
        //$this->em->flush();
        $product = new DsProduct();
        $product->setCategory($entity->getCategory());
        $product->setSerialNo(intval($entity->getSerialNo()) + 1);
        $product->setK1($entity->getK1());
        $product->setK2($entity->getK2());
        $product->setK3($entity->getK3());
        $product->setK4($entity->getK4());
        $product->setV1($entity->getV1());
        $product->setV2($entity->getV2());
        $product->setV3($entity->getV3());
        $product->setV4($entity->getV4());

        $this->em->persist($product);
        $this->em->flush();


        // redirect to the 'list' view of the given entity
        //return $this->redirectToRoute('easyadmin', array(
        //    'action' => 'list',
        //    'entity' => $this->request->query->get('entity'),
        //));
//var_dump($this->request->query->get('entity')); die();
        // redirect to the 'edit' view of the given entity item
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $product->getId(),
            'entity' => $this->request->query->get('entity'),
        ));
    }
}
