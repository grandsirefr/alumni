<?php
/**
 * Created by PhpStorm.
 * User: stagiaires
 * Date: 08/11/2019
 * Time: 14:36
 */

namespace App\Controller\Admin;


use App\Form\DegreeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDegreeController extends AbstractController
{
    /**
     * @Route("/admin/degree/new",name="admin.degree.new")
     */
    public function new(){
        $form=$this->createForm(degreeFormType::class);
        return $this->render('admin/degree/new.html.twig',['form'=>$form->createView()]);
    }
}