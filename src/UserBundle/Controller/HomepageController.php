<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\DataUserType;
use UserBundle\Entity\DataUser;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('homepage/index.html.twig');
    }


    // /**
    //  * @Route("/", name="homepage")
    //  */
    // public function ShowFormAction(Request $request)
    // {
        
    //     if(isset($id)){
    //     $datauser = new DataUser();
    //     $id = $this->getUser()->getId();
    //     $em = $this->getDoctrine();
    //     $datauser = $em->getRepository('UserBundle:DataUser')->find($id);
    //     dump($datauser);
    //     $form = $this->createForm(DataUserType::class, $datauser);

    //     return $this->render('homepage/index.html.twig',array('form' => $form->createView()));

    //     }else{
        
    //     $form = $this->createForm(DataUserType::class);
    //     return $this->render('homepage/index.html.twig',array('form' => $form->createView())); 

    //     }
    // }

}
