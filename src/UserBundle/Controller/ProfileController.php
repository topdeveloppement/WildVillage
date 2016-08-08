<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\ProfileUserType;
use UserBundle\Entity\ProfileUser;
use Symfony\Component\HttpFoundation\File\File;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function ShowProfileAction()
    { 
        // On recupere l'id connecter avec la methode getUser disponible dans Controller.
        // $this fait reference au methode disponible dans Controller.
        $id = $this->getUser()->getId();

        $em = $this->getDoctrine();
        
        $repository = $em->getRepository('UserBundle:User');

        $user = $repository->getUserIdentity($id);

        return $this->render('profile/showprofile.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/addprofile", name="addprofile")
     */
    public function AddProfileAction(Request $request)
    {   
        $id = $this->getUser()->getId();

        $em = $this->getDoctrine();
        
        $user = $em->getRepository('UserBundle:User');

        $user = $user->findOneById($id);
    
        $profile = $user->getProfile();

        if($profile == null){

            $profile = new ProfileUser();

            $form = $this->createForm(ProfileUserType::class, $profile);
            
            $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){

                $file = $profile->getPath();
                
                $fileName = $this->get('app.images_uploader')->update($file);
                
                $profile->setPath($fileName);
                  
                $user->setProfile($profile);

                $em = $this->getDoctrine()->getManager();
                
                $em->persist($profile);

                $em->flush();

                return $this->redirect($this->generateUrl("accueil"));

                }

        return $this->render('profile/addprofile.html.twig', array('form' => $form->createView()));

        }else{

            $profileId = $profile->getId();

            $profile = $em->getRepository('UserBundle:ProfileUser');

            $profile = $profile->findOneById($profileId);

            $fileName = $profile->getPath();
            
            $profile->setPath(new File($this->get('app.images_uploader')->getAbsolutePath($fileName)));
            
            $form = $this->createForm(ProfileUserType::class, $profile);
            
            $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){

                $file = $profile->getPath();
                
                $fileName = $this->get('app.images_uploader')->update($file);
                
                $profile->setPath($fileName);
                  
                $user->setProfile($profile);

                $em = $this->getDoctrine()->getManager();
                
                $em->persist($profile);

                $em->flush();

                return $this->redirect($this->generateUrl("accueil"));

                }
            return $this->render('profile/addprofile.html.twig', array('form' => $form->createView()));
        }
    }

    /**
     * @Route("/alterprofile", name="alterprofile")
     */
    public function AlterProfileAction(Request $request)
    {   
        $id = $this->getUser()->getId();

        $em = $this->getDoctrine();
        
        $user = $em->getRepository('UserBundle:User');

        $user = $user->findOneById($id);
        dump($user->getUsername());
        $profileId = $user->getProfile()->getId();

        $profile = $em->getRepository('UserBundle:ProfileUser');

        $profile = $profile->findOneById($profileId);

        $profile->setPath(new File($this->getParameter('upload_directory').$user->getUsername().'_'.$id.'/'.$profile->getPath()));

        $form = $this->createForm(ProfileUserType::class, $profile);

        return $this->render('profile/alterprofile.html.twig', array('form' => $form->createView()));  
    }

}