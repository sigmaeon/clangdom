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
         return $this->render('BBLWebBundle:Base:main.html.twig');
    }
    
    public function regAction()
    {
    	return $this->render('BBLWebBundle:Base:reg.html.twig');
    }
    
    public function signUpAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$genre = new Genre();
    	$genre->setName("Rockpoppunkmetaljazzclassic");
    	$profil = new Profil();
    	$profil->setHtml("<h> Wooow ich bin ein Profil... blabla</h>");
    	$user = new User();
    	$user->setEmail("oma@Koma");
    	$user->setPassword("ich bin ein gehashtes PW");
    	$konto = new Konto();
    	$konto->setName("A band Of Omas");
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
