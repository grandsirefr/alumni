<?php


namespace App\Controller;


use App\Entity\Promotion;
use App\Repository\DegreeRepository;
use App\Repository\PromotionRepository;
use App\Repository\UserRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    /**
     * @Route("/promotion/{id}",name="promotion.index")
     */

    public function index(Promotion $promotion){

        return $this->render('promotion/promotion.html.twig',['promotion'=>$promotion]);
    }

    /**
     * @Route("/promotions",name="promotion.all")
     */
    public function all(PromotionRepository $promo,Request $request){
        //dd($promotionRepository);
        $templateData=$promo->getAllOrderByDegreeAndYear();


        return $this->render('promotion/promotions.html.twig',['templateData'=>$templateData]);
    }
}