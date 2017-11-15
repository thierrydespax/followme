<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\Common\Collections\Criteria;
use FollowMeBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class GestionController extends Controller
{
    /**
     * @Route("/gestion", name="gestion")
     */
    public function indexAction(Request $request)
    {
        $page = (int) $request->get("page") > 1
        ?(int)$request->get("page")
        : 1;
        $maxResults = 5;
        $this->get("session")->start();
        $users = $this->get("session")->start();
        $criteria = new Criteria;
        $criteria
        ->setMaxResults($maxResults);
        //          ->setFirtsResult(2)
     
        if ($page) {
            $criteria->setFirstResult(($page -1) * $maxResults);
        }
        
        $users = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository(User::class)
        ->matching($criteria); 
        
        return $this->render('FollowMeBundle:Gestion:index.html.twig', array(  
            "users"->$users,
            "page"-> $page,
            "max"-> $maxResults
        ));
    }
    
    /**
     * @Route("/gestion/user(id)", name="gestion_user")
     */
    public function removeUserAction (Request $request)
    {
        $user = $this->getDoctrine->getManager()->find();   
    
}
}
