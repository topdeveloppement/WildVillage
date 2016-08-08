<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CommentaireController extends Controller
{
    /**
     * @Route("/commentaire", name="commentaire")
     */
    public function ShowCommentaireAction()
    {
        //je recupere le repository 
    	$post = $em = $this->getDoctrine()->getRepository('UserBundle:Post');

        $posts = $post->findAll();
        $auteurs = $post->getAuteur();
        
        return $this->render('commentaire/index.html.twig', array('posts' => $posts, 'auteurs' => $auteurs));
    }

}