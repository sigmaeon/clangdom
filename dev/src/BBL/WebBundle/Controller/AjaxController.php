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
    	$objects['ob1']['picture'] = "oma whaaaa";
    	$objects['ob1']['link'] = "here is a link to oma";
    	$objects['ob1']['info'] = "hell yeah this is oma";
    	$objects['ob1']['name'] = "OMA";
    	
    	$objects['ob2']['picture'] = "koma whaaaa";
    	$objects['ob2']['link'] = "here is a link to koma";
    	$objects['ob2']['info'] = "hell yeah this is koma";
    	$objects['ob2']['name'] = "KOMA";
    	return $this->render('BBLWebBundle:Base:content.html.twig', 
    							array('objects' => $objects, 'title' => "A band of Omas"));
    }
    
    
    public function loginAction()
    {
    	return $this->render('BBLWebBundle:Base:login.html.twig');
    }
}
