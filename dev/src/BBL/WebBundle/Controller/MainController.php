<?php

namespace BBL\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BBL\WebBundle\Entity\User;
use BBL\WebBundle\Entity\Konto;
use BBL\WebBundle\Entity\Genre;
use BBL\WebBundle\Entity\Profil;

class MainController extends Controller
{
    public function indexAction()
    {
    	$this->get('session')->start();
    	if($this->get('session')->get('state') != 'logged')
         return $this->render('BBLWebBundle:Base:main.html.twig', array('sesson' => false));
    	else return $this->render('BBLWebBundle:Base:main.html.twig', array('sesson' => true, 
    										'name' => $this->get('session')->get('name')));
    }
    
    public function regAction()
    {
    	return $this->render('BBLWebBundle:Base:reg.html.twig', array('sesson' => false));
    }
    
    public function signUpAction()
    {
    	$request = $this->getRequest();	
    	//Objects for Doctrine
    	$em = $this->getDoctrine()->getManager(); 
    	$userRepo = $this->getDoctrine()->getRepository('BBLWebBundle:User');
    	$genreRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Genre');
    	
    	//Fill the DB
    	$profil = new Profil();
    	//Logic to avoid multiple links goes here
    	$profil->setLink("/".$request->request->get('Name'));
    	//Does this user have a account yet?
    	$userhere = $userRepo->findOneByEmail($request->request->get('Email'));
    	if($userhere != null){
    		$user = $userhere;
    	}
    	else{
    		$user = new User();
    		$user->setEmail($request->request->get('Email'));
    		$user->setPassword($request->request->get('Pwd'));
    	}
    	if($request->request->get('Genre') != null)
    	$genre = $genreRepo->findOneByName($request->request->get('Genre'));
    	else $genre = $genreRepo->findOneByName("Classic");
    	$konto = new Konto();
    	$konto->setName($request->request->get('Name'));
    	$konto->setProfil($profil);
    	$konto->addIduser($user);
    	$konto->addGenregenre($genre);
    	$user->addIdkonto($konto);
    	$em->persist($genre);
    	$em->persist($user);
    	$em->persist($profil);
    	$em->persist($konto);
    	$em->flush();
    	
    	//session-handling
    	$session = $this->get('session');
    	$session->set('state','logged');
    	$session->set('user', $user->getIduser());
    	$session->set('name',$konto->getName());
    	$session->set('konto', $konto->getIdkonto());
    	
    	//return
    	$response = new Response();
    	$response->setStatusCode(200);
    	return $response;
    }
    
    public function logoutAction()
    {
    	$session = $this->get('session');
    	$session->set('state','');
    	$session->set('user', '');
    	$session->set('name','');
    	$session->set('konto','');
    	return $this->redirect($this->generateUrl('bbl_web_homepage'));
    }
    
}
