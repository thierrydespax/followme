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
use Symfony\Component\Form\FormError;
use FollowMeBundle\Form\SignUp;
use FollowMeBundle\Entity\User;


class SignUpController extends Controller
{
	/**
	 * @Route("/signup", name="signup")
	 */
    public function indexAction(Request $request)
    {
        try {
            $this->get("session")->start(); 
            if ($this->get("session")->get("id")) {
                throw new \RuntimeException; 
            }                  
            // obtenir une session
            $form = $this->createForm(SignUp::class);
                
            $form->handleRequest($request);

            $user = $this->get("follow_me.user");
            
            if ($form->isSubmitted() && $form->isValid()) {
                    if ($form->getData()["user_pswd"] !== $form->getData()["confirm"]) {
                        $form->get("confirm")->addError(new FormError("Confirmation invalide"));
                        throw new \InvalidArgumentException;
                    }               
                    $user->setUserMail(
                        $form->getData()["user_mail"]           // récupère l input mail pour créer le compte
                    );
                    $user->setUserPswd(
                        password_hash(
                            $form->getData()["user_pswd"],     // récupère l' input pswd pour le compte
                            PASSWORD_DEFAULT
                        )
                    );
                    $this->getDoctrine()->getManager()->persist($user);
                    $this->getDoctrine()->getManager()->flush();

                    $this->get("session")->set("id", $user->getUserId());       // fermer la session
                    throw new \RuntimeException;                    
                } 
            
            } catch (\InvalidArgumentException $e){

                dump($e);
            } catch (\RuntimeException $e){
                        // redirection
                    return $this->redirectToRoute('main_route'); 

            } catch (Throwable $e){
                    
                    $form->addError(new FormError("L'utilisateur existe déjà..."));  
            }
    
        return $this->render(
            'FollowMeBundle:SignUp:index.html.twig', 
            [
                "form" => $form ->createView()
            ]            
        );
    }
}

    //     protected function getSignUpForm()
//     {
//         return $this->createFormBuilder()
// //          ajout des champs
//         ->add("user_mail",
//               EmailType::class,
//               [
//             "label" => "Adresse Email",
//             "constraints" => [
//                 new Email([
//                     "message" => "Veuillez saisir une adresse de type blabla@foo.com"
//                 ]),
//                 new NotBlank([
//                     "message" => "Adresse mail obligatoire"
//                 ])
//                             ],
//             "attr" => [
//                 "class" => "form-control",
//                 "placeholder" => "Adresse Email",
//                 ]
//             ])
//         ->add("user_pswd",
//             TextType::class,
//             [
//             "label" => "Mot de Passe",
//             "constraints" => [
//                 new Regex([
//                     "pattern" => "/^[\w]{8,32}$/",
//                     "message" => "Entrez un mot de passe d'au moins 8 caractères"

//                 ]),
//                 new NotBlank([
//                     "message" => "Entrez un mot de passe"
//                 ])
//                             ],
//             "attr" => [
//                 "class" => "form-control",
//                 "placeholder" => "Mot de Passe",
//                 ]
//             ])
//         ->add("confirm",
//             TextType::class,
//             [
//             "label" => "Confirmation",
//             "constraints" => [
//                 new Regex([
//                     "pattern" => "/^[\w]{8,32}$/",
//                     "message" => "Entrez un mot de passe d'au moins 8 caractères"

//                 ]),
//                 new NotBlank([
//                     "message" => "Confimer votre mot de passe"
//                 ])
//                             ],
//             "attr" => [
//                 "class" => "form-control",
//                 ]
//             ])
//         ->getForm();
//     }



    


