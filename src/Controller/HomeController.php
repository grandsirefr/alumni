<?php
/**
 * Created by PhpStorm.
 * User: Francois
 * Date: 03/10/2019
 * Time: 11:25
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index(){
        return new Response('Hello world Acceuil');
    }
}