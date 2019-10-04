<?php
/**
 * Created by PhpStorm.
 * User: Francois
 * Date: 03/10/2019
 * Time: 11:25
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="home.index")
     */
    public function index(){
        return $this->render('home.html.twig');
    }

}