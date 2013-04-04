<?php

namespace BBL\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller
{
    public function regAction($name)
    {
        return $this->render('BBLWebBundle:Base:main.html.twig');
    }
    
    public function loadAction()
    {
    	return $this->render('BBLWebBundle:Base:content.html.twig', 
    							array('name' => "Oma", 'title' => "the Oma show", 'info' => "Hey this is a oma"));
    }
}
