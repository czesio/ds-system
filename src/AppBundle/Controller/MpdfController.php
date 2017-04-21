<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\DsCategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use mPDF;

class MpdfController extends Controller
{
    public function indexAction(Request $request)
    {
        $mpdf = new mPDF();
        $mpdf->h2toc = array('H1'=>0, 'H2'=>1, 'H3'=>2);
        $mpdf->setFooter('{PAGENO}');

        //echo $this->container->getParameter('kernel.root_dir').'/../web'.$this->container->getParameter('app.mpdf.css');
        //die();
        $stylesheet = file_get_contents($this->container->getParameter('kernel.root_dir').'/../web'.$this->container->getParameter('app.mpdf.css'));

        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->shrink_tables_to_fit = 1;
        //$repository = $this->getDoctrine(); //->getRepository('AppBundle:DsCategory');

        $repository = $this->getDoctrine()->getRepository('AppBundle:DsCategory');
        $productRepository = $this->getDoctrine()->getRepository('AppBundle:DsProduct');
        $query = $repository->createQueryBuilder('c')
            ->where('c.categoryId IS NULL')
//            ->setParameter('catRoot', NULL)
            ->orderBy('c.name', 'ASC')
            ->getQuery();
        $entities = $query->getResult();

        $data = '';
        //$data .= '<style>'.$stylesheet.'</style>';
        $counter = 0;
        foreach ($entities as $entity) {
            $mpdf->TOCpagebreak();
            //$mpdf->Bookmark($entity->getName(), 0);

            // $mpdf->TOC_Entry($entity->getName(), 0);
            if ($counter > 0)
                $data .= '<pagebreak>';

            $data .= '<bookmark content="'.$entity->getName().'" level="0" />';
                //$mpdf->AddPage();
            $data .= '<H1>'.$entity->getName().'</H1>';
            if (strlen(trim($entity->getDescription()))) {
                $data .=  $entity->getDescription() ;
            }
            //$resCat = $repository->getAllChildrenForSelectedParent($entity);
            $query = $repository->createQueryBuilder('c')
                ->where('c.categoryId = :catRoot')
                ->setParameter('catRoot', $entity->getId())
                ->orderBy('c.name', 'ASC')
                ->getQuery();
            $subEntities = $query->getResult();
            foreach ($subEntities AS $subEntity) {
                $data .=  '<div class="wrap_content">
                            <div class="content_side">
                            <H2>'. $subEntity->getName() .'</H2>'
                            .(strlen($subEntity->getDescription()) ? $subEntity->getDescription() : ' ');
                //$mpdf->Bookmark($subEntity->getName(), 1);
                $data .= '<bookmark content="'.$subEntity->getName().'" level="1" />';
                $query = $productRepository->createQueryBuilder('p')
                    ->where('p.category = :cat')
                    ->setParameter('cat', $subEntity->getId())
                    ->orderBy('p.serialNo', 'ASC')
                    ->getQuery();
                $products = $query->getResult();
                if (count($products)) {

                    $data .= '<hr class="content_hr" />
                              <table class="product_data"  style="page-break-inside:avoid;">';
                    $test0 = true;

                    //die();
                    foreach ($products AS $product) {
                        //var_dump($product->getK4()->getName()); die();
                        if ($test0 == true) {
                            $data .= '<thead><tr>';
                            $data .= '<th>serial no.</th>';
                            if (strlen($product->getV1()) || is_object($product->getK1())) {
                                $data .= '<th>' . (is_object($product->getK1())?$product->getK1()->getName():'') . '</th>';
                            }
                            if (strlen($product->getV2()) || is_object($product->getK2())) {
                                $data .= '<th>' . (is_object($product->getK2())?$product->getK2()->getName():'') . '</th>';
                            }
                            if (strlen($product->getV3()) || is_object($product->getK3())) {
                                $data .= '<th>' . (is_object($product->getK3())?$product->getK3()->getName():'') . '</th>';
                            }
                            $data .= '</tr></thead>';
                        }
                        $data .= '<tr>';

                        $data .= '<td><b>'.$product->getSerialNo().'</b></td>';
                        if (strlen($product->getV1()) || is_object($product->getK1())) {
                            $data .= '<td>' . $product->getV1() . '</td>';
                        }
                        if (strlen($product->getV2()) || is_object($product->getK2())) {
                            $data .= '<td>' . $product->getV2() . '</td>';
                        }
                        if (strlen($product->getV3()) || is_object($product->getK3())) {
                            $data .= '<td>' . $product->getV3() . '</td>';
                        }
                        $data .= '</tr>';
                        $test0 = false;
                    }
                    $data .= '</table><hr class="content_hr" /></div>';

                    $images = $subEntity->getImages();
                    if (count($images)) {
                        $data .= '<div class="img_side"><table style="page-break-inside:avoid; width:100%;"><tr><td>';
                        foreach ($images as $image) {
                            $data .= '<img class="img_in" src="/uploads/images/products/' . ($image->getImage()) . '" />';
                        }
                        $data .= '</div></td></tr></table>';
                    }
                } else {
                    $data .= '</div>';
                }
                $data .= '
                                </div>
                                <br class="break_row" />';
            }
            ++$counter;
        }
        //echo $data;
        //die();
        //$data = str_replace('{PAGECNT}', $mpdf->getPageCount(), $data);
        $mpdf->WriteHTML($data);

// Output a PDF file directly to the browser
        $mpdf->Output();
    }
}
