<?php
/**
 * Created by PhpStorm.
 * User: stagiaires
 * Date: 18/10/2019
 * Time: 15:36
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/account/create",name="account.createAccount")
     */
    public function createAccount(){
        return $this->render('createaccount.html.twig');
    }


}