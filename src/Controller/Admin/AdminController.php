<?php
/**
 * Created by PhpStorm.
 * User: stagiaires
 * Date: 08/11/2019
 * Time: 08:28
 */

namespace App\Controller\Admin;


use App\Repository\DegreeRepository;
use App\Repository\PromotionRepository;
use App\Repository\YearRepository;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin",name="admin.index")
     */
    public function index(DegreeRepository $degreeRepo, YearRepository $yearRepo,PromotionRepository $promotionRepo){


        $templateData=[];
        $templateData['degrees']=$degreeRepo->findBy([],['name'=> 'ASC']);
        $templateData['years'] = $yearRepo->findBy([],['title'=> 'ASC']);
        $templateData['promotions']= $promotionRepo->getAllOrderByDegreeAndYear();

        //dd($templateData);
        return $this->render('admin/index.html.twig',['templateData'=>$templateData]);
    }
}