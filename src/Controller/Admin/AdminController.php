<?php
/**
 * Created by PhpStorm.
 * User: stagiaires
 * Date: 08/11/2019
 * Time: 08:28
 */

namespace App\Controller\Admin;


use App\Repository\DegreeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{

    /**
     * @Route('/admin',name="admin.index")
     */
    public function index(DegreeRepository $degreeRepo){
        $degrees=$degreeRepo->findAll();
        return $this->render('admin/index.html.twig',['degrees'=>$degrees]);
    }
}