<?php

namespace BBL\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BBL\WebBundle\Entity\User;
use BBL\WebBundle\Entity\Konto;
use BBL\WebBundle\Entity\Genre;
use BBL\WebBundle\Entity\Profil;

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
    
    public function signUpAction()
    {
    	//Objects for Doctrine
    	$em = $this->getDoctrine()->getManager(); 
    	$repository = $this->getDoctrine()->getRepository('BBLWebBundle:User');
    	//Fill the DB
    	$genre = new Genre();
    	$genre->setName("RockMetalHardYeah");
    	$profil = new Profil();
    	$profil->setHtml("<h> Ich bin das Profil von Koma</h>");
    	//Does this user have a account yet?
    	$userhere = $user = $repository->findOneByEmail("oma@Koma");
    	if($userhere != null){
    		$user = $userhere;
    	}
    	else{
    		$user = new User();
    		$user->setEmail("oma@Koma");
    		$user->setPassword("ich bin ein gehashtes PW");
    	}
    	$konto = new Konto();
    	$konto->setName("A band Of Komas");
    	$konto->setProfil($profil);
    	$konto->addIduser($user);
    	$konto->addGenregenre($genre);
    	$user->addIdkonto($konto);
    	$em->persist($genre);
    	$em->persist($user);
    	$em->persist($profil);
    	$em->persist($konto);
    	$em->flush();
    	
    	return $this->redirect($this->generateUrl('bbl_web_homepage'));
    }
    
    
}
