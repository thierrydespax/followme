<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FollowMeBundle\Entity\User;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\Criteria;
use FollowMeBundle\Entity\Dating;

class DatingController extends Controller
{
    /**
     * @Route("/dating", name="dating")
     */
    public function indexAction(Request $request)
    { 
        
        $page = (int) $request->get("page") > 1
                ?(int)$request->get("page")
                : 1;
        $maxResults = 5;
        
        $this->get("session")->start();
        if(!$this->get("session")->get("id")) {
          
            return $this->redirectToRoute("main");
        }
        $criteria = new Criteria;
        $criteria
        ->where($criteria->expr()->gt("datEnd", time()))
         ->setMaxResults($maxResults)
//          ->setFirtsResult(2)
         ->orderBy (["datEnd" => Criteria::DESC]);
         
         if ($page) {
             $criteria->setFirstResult(($page -1) * $maxResults);
         }
         
         $dating = $this  
        ->getDoctrine()
        ->getManager()
        ->getRepository(Dating::class)
        ->matching($criteria); 
         
        return $this->render('FollowMeBundle:Dating:index.html.twig', ["dating" => $dating,
            "page" => $page,
            "max" => $maxResults
        ]);
       
    }
}

    