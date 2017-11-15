<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SignOutController extends Controller
{
    /**
     * @Route("/signout", name="signout")
     */
    public function indexAction()
    {
        try {
            $this->get("session")->start(); 
            $this->get("session")->invalidate();
        } catch (\Throwable $e) {

        }finally {
            return $this->redirectToRoute('main_route'); 
        }    
                
    }

}

// if ($this->get("session")->get("id")) {
//     $this->get("session")->invalidate();
   
// }    