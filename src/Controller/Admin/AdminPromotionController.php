<?php


namespace App\Controller\Admin;




use App\Entity\Promotion;
use App\Form\PromotionFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPromotionController extends AbstractController
{
    /**
     * @Route("/admin/promotion/new",name="admin.promotion.new")
     */
    public function new(Request $request){
        $form=$this->createForm(promotionFormType::class);
        $form->handleRequest($request);
        //est ce qu ele formulaire est soumis?
        if($form->isSubmitted()&& $form->isValid()){
            $promotion=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($promotion);
            $em->flush();
            $this->addFlash('success','Promotion ajouté a la base de données!');
            return $this->redirectToRoute('admin.index');

        }
        return $this->render('admin/promotion/new.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/admin/promotion/{id}/edit",name="admin.promotion.edit")
     */
    public function edit(Request $request,Promotion $promo){
        $form=$this->createForm(promotionFormType::class,$promo );
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Promotion modifié dans la base de données!');
            return $this->redirectToRoute('admin.index');
        }

        return $this->render('admin/promotion/edit.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/admin/promotion/{id}/delete",name="admin.promotion.delete")
     */
    public function delete(Promotion $promo){
        $em=$this->getDoctrine()->getManager();
        //dd($promo);
        $em->remove($promo);
        $em->flush();
        $this->addFlash('success','Promotion supprimé dans la base de données!');

        return $this->redirectToRoute('admin.index');
    }




}