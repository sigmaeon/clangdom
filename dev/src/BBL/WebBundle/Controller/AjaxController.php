<?php

namespace BBL\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BBL\WebBundle\Entity\User;
use BBL\WebBundle\Entity\Konto;

class AjaxController extends Controller
{
 
    public function loginAction()
    {
    	$request = $this->getRequest();
    	//Objects for Doctrine
    	$em = $this->getDoctrine()->getManager();
    	$userRepo = $this->getDoctrine()->getRepository('BBLWebBundle:User');
    	$genreRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Konto');
    	$user = $userRepo->findOneByEmail($request->request->get('Email'));
    	
    	//check if valid
    	if($user == null) {
    		$response = new Response();
    		$response->setStatusCode(400);
    		return $response;
    	}
    	
    	if($user->getPassword() != $request->request->get('Pwd')){
    		$response = new Response();
    		$response->setStatusCode(400);
    		return $response;
    	}
    		
    	$kontos = $user->getIdkonto();
    	if($kontos[1] == null) $konto = $kontos[0];
    	//here goes code for multiple accounts
    	
    	//sessionhandling
    	$session = $this->get('session');
    	$session->set('state','logged');
    	$session->set('user', $user->getIduser());
    	$session->set('name',$konto->getName());
    	$session->set('konto', $konto->getIdkonto());
    	$session->set('link', $konto->getProfil()->getLink());
    	
    	
    	//response
    	$response = new Response();
    	$response->setStatusCode(200);
    	return $response;
    }
    
}
