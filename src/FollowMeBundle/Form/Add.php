<?php
namespace FollowMeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;

class Add extends AbstractType
{
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add("dat_title",
				TextType::class,
				[
						"label" => "dat.titre",
						'attr' => array(
							'class' => 'form-control'
						),						
						"constraints" => [
								new NotBlank([
										"message" => "mess.titre"
								]),
						]
				])	
				->add("dat_desc",
				TextType::class,
				[
						"label" => "dat.desc",
						'attr' => array(
							'class' => 'form-control'
						),	
						"constraints" => [
							new NotBlank([
									"message" => "mess.desc"
							])
					]
				])
				->add("dat_start",
				DateTimeType::class,
				[
						"label" => "dat.start",
						'attr' => array(
							
						),
						'format' => 'yyyy-MM-dd HH:mm',	
						"constraints" => [
							new NotBlank([
									"message" => "mess.start"
							])
					]
				])	
				->add("dat_end",
				TimeType::class,
				[
						"label" => "dat.end",
						'attr' => array(
							
						),	
						"constraints" => [
							new NotBlank([
									"message" => "mess.end"
							])
					]
				])
				->add("dat_lat",
				TextType::class,
				[
						"label" => "dat.lat",
						'attr' => array(
							'class' => 'form-control'
						)
							
				])
				->add("dat_lng",
				TextType::class,
				[
						"label" => "dat.lng",
						'attr' => array(
							'class' => 'form-control'
						)	
						
				])
				->add("dat_href",
				TextType::class,
				[
						"label" => "site du lieu ( si possible )",
						'attr' => array(
							'class' => 'form-control'
						)	
						
				])
				->add("dat_link_title",
				TextType::class,
				[
						"label" => "nom du site",
						'attr' => array(
							'class' => 'form-control col-sm-10'
						)
						
				]);			
	}
}

   
     /**
     * @Route("/datingttt", name="dating")
     */
    
    // public function indexAction(Request $request)
    // {   
        
        
    //     $clientGmt = $request->headers->get("if-modified-since");
    //     $gmt =gmdate('D, d M Y H:i:s T', time()); 
    //     if($clientGmt && time() - (new \DateTime($clientGmt))->getTimestamp() < 5 ) {
    //         $response = new Response();
    //         $response-> setStatusCode(304);
    //     } else {
    //         $response = $this->render('FollowMeBundle:Dating:index.html.twig');
    //         $response->setLastModified(new \DateTime());
    //     }  
        
    //     $response->setPublic();
    //     return $response;
    // }

//     /* /* /**
//      * @Route("/ETag", name="ETag")
//      */
//     public function indexAction(Request $request)
//     {   
//                     // le cache client
//         $ETag = md5($request->getRequestUri());
        
//         // if not match === ETag alors réponse vide
//         if ('"' . $ETag . '"' === current($request->getETags())) {
//             $response = new Response();
//             $response-> setStatusCode(304);

//         // sinon réponse avec rendu    
//         } else {
//             $response = $this->render('FollowMeBundle:Dating:index.html.twig');
//         }
//         $response->setEtag($ETag);
//         $response->setPublic();
        
//         //dump($request->getETags());
//         return $response;
        
        
//     }
// $cachedCategories = $this->get('cache.app')->getItem('categories');
//         if (!$cachedCategories->isHit()) {
//             $categories = ... // fetch categories from the database
//             $cachedCategories->set($categories);
//             $this->get('cache.app')->save($cachedCategories);
//         } else {
//             $categories = $cachedCategories->get();
//         }
//     /**
//      * @Route("/psr6", name="psr6")
//      */
//     public function indexAction()
//     {           //mise en cache pour données 
//         // $pool = $this->get('cache.app');
//         // $item = $pool->getItem('followme.users.custom');   
//         $pool = new FilesystemAdapter(                                          // la bonne méthode
//             "",
//              0,
//               __DIR__ . "/../../../var/cache/pools");                           // à stocker dans services
                      
//         $item = $pool->getItem('followme.users.custom');                        //devrait créer un dossier users mais en réalité non. 3eme mot est un argument d'expiration
        
//         $item->expiresAfter(3);                                             // temsp d'expiration 
//         if (!$item->isHit()) {    
//             var_dump("refresh");                                          // isHit() a t il été trouvé ? + regarde la date d expiration
//             $users = $this->getDoctrine()
//                           ->getManager()
//                           ->getRepository(User::class)
//                           ->findAll();
//             $item->set($users);                                             // si $item est vide on le remplit                                 
//             $pool->save($item);                                             // sauvegarde
//         }
//         $users = $item->get();

//         var_dump($users);

//         return $this->render('FollowMeBundle:Dating:index.html.twig');
//     }

//     $response = $this->render('FollowMeBundle:Dating:index.html.twig');

//     (md5($response->getContent()));
    /* make sure the response is public/cacheable//
     $response->isNotModified($request); */    