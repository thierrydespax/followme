<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use FollowMeBundle\Form\SignIn;
use FollowMeBundle\Entity\User;

class SignInController extends Controller
{
    /**
     * @Route("/signin", name="signin")
     */
    public function indexAction(Request $request)
    {
    	
    	try {
    		$this->get("session")->start();
    		if ($this->get("session")->get("id")) {
    			throw new \RuntimeException;
    		}
    		// obtenir une session
    		$form = $this->createForm(SignIn::class);
    		
    		$form->handleRequest($request);

			if (!$form->isSubmitted() 
				&& !$form->isValid()) {

					throw new \InvalidArgumentException;

				}
			if ($user = $this->getDoctrine()
								->getManager()
								->getRepository(User::class)
								->findOneBy(["userMail" => $form->getData()["user_mail"]])){
					
					if (!password_verify(
						$form->getData()["user_pswd"],
						$user->getUserPswd())) {
							throw new \Throwable;
							
						}  
				$this->get("session")->set("id", $user->getUserId()); 
				throw new \RuntimeException;
				} else {
					throw new \Throwable;
				}
				
				
				 			    			
    		      // fermer la session
    		//throw new \RuntimeException;
			
			//throw new \InvalidArgumentException;
		} catch (\InvalidArgumentException $e) {			// si 1 de 3 arguements du if manquants...levée d'exception
		
		} catch (\RuntimeException $e){
			// redirection

    		return $this->redirectToRoute('main_route');
    		
    	} catch (\Throwable $e){
    
    		$form->addError(new FormError("Mauvais identifiants"));
		
		}
		return $this->render('FollowMeBundle:signin:index.html.twig', 
			[
				"form"=>$form->createView()

			]            
        );
    }

}
