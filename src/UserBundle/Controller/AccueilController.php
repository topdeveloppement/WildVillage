<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AccueilController extends Controller
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function ShowAction()
    {
    	
        return $this->render('accueil/index.html.twig');

    }

}