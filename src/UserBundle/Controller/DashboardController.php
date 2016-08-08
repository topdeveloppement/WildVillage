<?php

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\ProfileUserType;
use UserBundle\Entity\ProfileUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function ShowFormAction(Request $request)
    {
        
        return $this->render('dashboard/index.html.twig');       
    }

}