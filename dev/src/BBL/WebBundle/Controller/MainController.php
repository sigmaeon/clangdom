<?php

namespace BBL\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
         return $this->render('BBLWebBundle:Base:main.html.twig');
    }
    
    public function regAction()
    {
    	return $this->render('BBLWebBundle:Base:reg.html.twig');
    }
    
    
    public function loginAction()
    {
    	return $this->render('BBLWebBundle:Base:login.html.twig');
    }
    
}
