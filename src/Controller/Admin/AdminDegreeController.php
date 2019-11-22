<?php
/**
 * Created by PhpStorm.
 * User: stagiaires
 * Date: 08/11/2019
 * Time: 14:36
 */

namespace App\Controller\Admin;


use App\Entity\Degree;
use App\Form\DegreeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminDegreeController extends AbstractController
{
    /**
     * @Route("/admin/degree/new",name="admin.degree.new")
     */
    public function new(Request $request){
        $form=$this->createForm(degreeFormType::class);
        $form->handleRequest($request);
        //est ce qu ele formulaire est soumis?
        if($form->isSubmitted()&& $form->isValid()){
            $degree=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($degree);
            $em->flush();
            $this->addFlash('success','Formation ajouté a la base de données!');
            return $this->redirectToRoute('admin.index',['_fragment'=>'degree']);

        }
        return $this->render('admin/degree/new.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/admin/degree/{id}/edit",name="admin.degree.edit")
     */
    public function edit(Request $request,Degree $degree){
        $form=$this->createForm(degreeFormType::class,$degree );
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Formation modifié dans la base de données!');
            return $this->redirectToRoute('admin.index',['_fragment'=>'degree']);
        }

        return $this->render('admin/degree/edit.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/admin/degree/{id}/delete",name="admin.degree.delete")
     */
    public function delete(Degree $degree){
        $id='degree-' .$degree->getId();
        $em=$this->getDoctrine()->getManager();
        //dd($degree);
        $em->remove($degree);
        $em->flush();
        $this->addFlash('success','Formation supprimé dans la base de données!');

        return $this->json($id);
    }
}