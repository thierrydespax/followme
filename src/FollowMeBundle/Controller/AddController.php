<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\FormError;
use FollowMeBundle\Form\Add;
use FollowMeBundle\Entity\User;
use FollowMeBundle\Entity\Dating;

class AddController extends Controller
{
    /**
     * @Route("/add", name="add")
     */
    public function indexAction(Request $request)
    {
        
//        var_dump(
            
//             $this->get("security.authorization_checker")
//             ->isGranted("ROLE_ADMIN")
//         );
        try {
            $this->get("session")->start(); 
            if (!$this->get("session")->get("id")) {
                throw new \RuntimeException; 
            } 

        $form = $this->createForm(Add::class);
        $form->handleRequest($request);

        $idsession = $this->get("session")->get("id");
        $user = $this->getDoctrine()
                        ->getManager()
                        ->getRepository(User::class)
                        ->find($idsession);
        
        
        $dating = $this->get("follow_me.dating");
        if (!$form->isSubmitted() && !$form->isValid()) {
            throw new \InvalidArgumentException;
        }
            
        if ($form->isSubmitted() && $form->isValid()) {

            $dating->setUser($user); 

            $dating->setDatTitle(
                $form->getData()["dat_title"]           
            );

            $dating->setDatDescription(
                $form->getData()["dat_desc"]
            );
            
            $actuel = time();
           
            $date = $form->getData()["dat_start"]->getTimestamp(); 
            
            if ($date < $actuel) {
                //throw new \InvalidArgumentException;
                $form->get("dat_start")->addError(new FormError("invalid start date!"));
                throw new \InvalidArgumentException;
            } else {
                $dating->setDatStart($date);
            }     
            
            $end = $form->getData()["dat_end"]->getTimestamp() ;
            
            if ($end <= -3600) {
                $form->get("dat_end")->addError(new FormError("invalid duration!"));
                throw new \InvalidArgumentException;
            } else {
                $dating->setDatEnd($date + 3600 + $form->getData()["dat_end"]->getTimestamp());
            }          
            
            $dating->setDatLat(
                $form->getData()["dat_lat"]
            );
            $dating->setDatLng(
                $form->getData()["dat_lng"]
            );
            $dating->setDatHref(
                $form->getData()["dat_href"]
            );
            $dating->setDatLinkTitle(
                $form->getData()["dat_link_title"]
            );
            
            $this->getDoctrine()->getManager()->persist($dating);
            $this->getDoctrine()->getManager()->flush();

            $this->get("session")->set("id", $user->getUserId()); 
            
            throw new \RuntimeException;                    
        } 

        } catch (\InvalidArgumentException $e){
            //$form->addError(new FormError("date de départ invalide"));  
            
        } catch (\RuntimeException $e){
                
           return $this->redirectToRoute('main_route'); 

        } catch (Throwable $e){
                
            $form->addError(new FormError("Le rendez-vous existe déjà..."));  
        }

    return $this->render('FollowMeBundle:Add:index.html.twig',
        [
            "form" => $form ->createView()
        ]
                );
    }
}

