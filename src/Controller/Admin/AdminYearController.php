<?php


namespace App\Controller\Admin;



use App\Entity\Year;
use App\Form\YearFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminYearController extends AbstractController
{
    /**
     * @Route("/admin/year/new",name="admin.year.new")
     */
    public function new(Request $request){
        $form=$this->createForm(yearFormType::class);
        $form->handleRequest($request);
        //est ce qu ele formulaire est soumis?
        if($form->isSubmitted()&& $form->isValid()){
            $year=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($year);
            $em->flush();
            $this->addFlash('success','Années ajouté a la base de données!');
            return $this->redirectToRoute('admin.index');

        }
        return $this->render('admin/year/new.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/admin/year/{id}/edit",name="admin.year.edit")
     */
    public function edit(Request $request,Year $year){
        $form=$this->createForm(yearFormType::class,$year );
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Années modifié dans la base de données!');
            return $this->redirectToRoute('admin.index');
        }

        return $this->render('admin/year/edit.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/admin/year/{id}/delete",name="admin.year.delete")
     */
    public function delete(Year $year){
        $em=$this->getDoctrine()->getManager();
        //dd($degree);
        $em->remove($year);
        $em->flush();
        $this->addFlash('success','Années supprimé dans la base de données!');

        return $this->redirectToRoute('admin.index');
    }
}