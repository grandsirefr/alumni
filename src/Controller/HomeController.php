<?php
/**
 * Created by PhpStorm.
 * User: Francois
 * Date: 03/10/2019
 * Time: 11:25
 */

namespace App\Controller;



use App\Repository\DegreeRepository;
use App\Repository\UserRepository;
use App\Repository\YearRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="home.index")
     */
    public function index(DegreeRepository $degreeRepository, YearRepository $yearRepository,Request $request, UserRepository $userRepository,PaginatorInterface $paginator){
        $degree=$request->request->get('degree');
        $year=$request->request->get('year');
        if($request->request->count()){

            //dd($degree,$year);
            $templateData['results']=$userRepository->search($degree,$year);
        }
        $templateData['degrees']=$degreeRepository->findBy([],['name'=>'ASC']);
        $templateData['years']= $yearRepository->findBy([],['title'=>'DESC']);



        $pagination = $paginator->paginate(
            $userRepository->getQueryPaginator($degree,$year), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        //dd($pagination);
        // parameters to template
        return $this->render('home.html.twig', ['pagination' => $pagination, 'templateData'=>$templateData]);
        //$degrees = $degreeRepo->findAll();
        //$years=$yearRepo->findAll();

        //dd($degrees);
        //$result =$userRepository->search($degree,$year);

        //return $this->render('home.html.twig',$templateData);
    }




}