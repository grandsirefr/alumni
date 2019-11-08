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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin",name="admin.index")
     */
    public function index(DegreeRepository $degreeRepo, YearRepository $yearRepo,PromotionRepository $promotionRepo){
        $degrees=$degreeRepo->findAll();
        $years=$yearRepo->findAll();
        $promotions=$promotionRepo->findAll();
        //dd($promotions,$years);
        return $this->render('admin/index.html.twig',['degrees'=>$degrees,'years'=>$years,'promotions'=>$promotions]);
    }
}