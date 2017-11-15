<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MainController extends Controller
{
    /**
     * @Route("/", name="main_route")
     */
    public function indexAction()
    {

       
        return $this->render('FollowMeBundle:Main:index.html.twig', array(
            
       ));
    }

    /**
     * @Route("/banner", name="banner")
     */
    public function bannerAction()
    {

       
        return $this->render('FollowMeBundle:Main:banner.html.twig', array(
            
       ));
    }
}
    // /**
    //  * @Route(
    //  *     "/foo/{bar}",
    //  *     name="foo",
    //  *     defaults={"bar": "truc"},
    //  *     requirements={
    //  *         "bar":"a|b"
    //  *     }
    //  * )
    //  */
    // public function foo($bar)
    // {
    //     die($bar);
        
    // }

     // $translator = $this->get("translator");                                         // ne pas utiliser cette méthode

        // $url = $this->generateUrl(
        //     "foo",
        //     [
        //         "bar" => "a"
        //     ]
        // );
        // return $this->rediredt($url);

