<?php
/**
 * Created by PhpStorm.
 * User: stagiaires
 * Date: 07/11/2019
 * Time: 09:27
 */

namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AlumniController extends AbstractController
{
    /**
     * @Route("/alumni/{id}/{slug}",name="alumni.index")
     */
    function index(User $user,$slug){
        //dd($user);
        return $this->render('alumni/index.html.twig',['user'=>$user]);
    }
}