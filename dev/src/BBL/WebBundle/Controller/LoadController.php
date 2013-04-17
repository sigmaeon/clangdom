<?php

namespace BBL\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BBL\WebBundle\Entity\User;
use BBL\WebBundle\Entity\Konto;

class LoadController extends Controller
{

    public function loadAction()
    {
    	//Objects for Managing
    	$request = $this->getRequest();
    	$em = $this->getDoctrine()->getManager();
    	$userRepo = $this->getDoctrine()->getRepository('BBLWebBundle:User');
    	
    	switch ($request->request->get('Type')){ 
    	
    		case "bands": return $this->fillBand();
    		case "event": fillEvent();
    	
    	return $this->render('BBLWebBundle:Base:content.html.twig', 
    							array('objects' => $objects, 'title' => "A band of Omas"));
    	}
    }
    
    public function fillBand()
    {
    	$em = $this->getDoctrine()->getManager();
    	$query = $em->createQuery('SELECT k FROM BBL\WebBundle\Entity\Konto k');
    	$kontos = $query->getResult();
    	
    	$i = 0;
    	foreach ($kontos as $konto) {
    		$objects['ob'.$i]['type'] = "simple";
    		$objects['ob'.$i]['picture'] =  $konto->getProfil()->getPic();
    		$objects['ob'.$i]['link'] = $konto->getProfil()->getLink();
    		$objects['ob'.$i]['info'] = "..";
    		$objects['ob'.$i]['name'] = $konto->getName();
    		$i++;
    	}
    	return $this->render('BBLWebBundle:Base:content.html.twig',
    			array('objects' => $objects, 'title' => "Bands"));
    
    }
    
    
    public function fillEvent()
    {
    	 
    
    }
}
