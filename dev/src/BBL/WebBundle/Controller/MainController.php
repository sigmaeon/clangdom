<?php

namespace BBL\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
         return $this->render('BBLWebBundle:Base:main.html.twig', array('sesson' => false));
    }
    
    public function regAction()
    {
    	return $this->render('BBLWebBundle:Base:reg.html.twig', array('sesson' => false));
    }
    
    public function signAction()
    {
    	return;
    }
    
    
}
