<?php
/**
 * Created by PhpStorm.
 * User: Francois
 * Date: 03/10/2019
 * Time: 11:25
 */

namespace App\Controller;



use App\Repository\DegreeRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="home.index")
     */
    public function index(DegreeRepository $degreeRepo, YearRepository $yearRepo){

        $degrees = $degreeRepo->findAll();
        $years=$yearRepo->findAll();
        //dd($degrees);
        return $this->render('home.html.twig',['degrees'=>$degrees,'years'=>$years]);
    }



}