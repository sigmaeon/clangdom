<?php

namespace BBL\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use BBL\WebBundle\Exception\EntityNotFoundClangdomException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use BBL\WebBundle\Entity\User;
use BBL\WebBundle\Entity\Konto;
use BBL\WebBundle\Entity\Genre;
use BBL\WebBundle\Entity\Profil;
use BBL\WebBundle\Entity\Artist;
use BBL\WebBundle\Entity\Source;
use BBL\WebBundle\Entity\Tasks;

class MainController extends Controller
{
	static private $rootDir = null; 
	
	static public function setUploadsDirectory($dir)  // is that secure??
	{
		self::$rootDir = $dir;
	}
	
    public function indexAction()
    {
    	$this->get('session')->start();
    	if($this->get('session')->get('state') != 'logged')
         return $this->render('BBLWebBundle:Base:main.html.twig', array('sesson' => false));
    	else return $this->render('BBLWebBundle:Base:main.html.twig', array('sesson' => true, 
    										'name' => $this->get('session')->get('name')));
    }
    
    public function signupAction()
    {
    	return $this->render('BBLWebBundle:Base:reg.html.twig');
    }
    
    public function regArtAction()
    {
    	return $this->render('BBLWebBundle:Base:regart.html.twig');
    }
    
    public function regSouAction()
    {
    	return $this->render('BBLWebBundle:Base:regsou.html.twig');
    }
    
    
    
    public function profilAction($name)
    {
    	//Objects for handling
    	$session = $this->get('session');
    	$request = $this->getRequest();
    	$em = $this->getDoctrine()->getManager();
    	$kontoRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Konto');
    	$profilRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Profil');
    	
    	$profil = $profilRepo->findOneByLink("/".$name);
    	if($profil == null) throw new RouteNotFoundException();
    	$konto = $kontoRepo->findOneByProfil($profil->getIdprofil());
    	
    	//here goes logic for own profil
    	if($konto->getIdkonto() == $session->get('konto')) return$this->render('BBLWebBundle:User:profil.html.twig',
    				 array('sesson' => true, 'profname' => $konto->getName(), 'pic' => "..", 'name' => $session->get('name')));
    	//Guest or User?
    	if( $session->get('state') == 'logged') return $this->render('BBLWebBundle:User:profil.html.twig',
    				 array('sesson' => true, 'profname' => $konto->getName(), 'pic' => "..", 'name' => $session->get('name')));
    	else return $this->render('BBLWebBundle:User:profil.html.twig',
    				 array('sesson' => false, 'profname' => $konto->getName(), 'pic' => ".."));
    }
    
    public function getOwnAction()
    {
    	
    }
    
//--------------------------------Sign Up---------------------------------------------------

    public function regAction()
    {
    	//Objects for managing
    	$fs = new Filesystem();
    	$request = $this->getRequest();	
    	if(!$request->isXmlHttpRequest()) throw new NoAjaxClangdomException();
    	$em = $this->getDoctrine()->getManager();
    	$userRepo = $this->getDoctrine()->getRepository('BBLWebBundle:User');
    	$profilRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Profil');
    	
    	//------value check---
    	$email = $request->request->get('Email');
    	if(strpos($email, '@') === false) return new Response('mail', 409);
    	$name = $request->request->get('Name');
    //	if(strpos($name, '?') === true || strpos($name, '<') === true, strpos($name, '>') === true || )
    	
    	
    	
       //-----------Fill the DB--------
    	
    	//Konto
    	$konto = new Konto();
    	$konto->setName($request->request->get('Name'));
    	
    	//Profil
    	$profil = new Profil();   
    	
    	$str = ("/".$request->request->get('Name'));
    	$str = mb_strtolower(preg_replace('/\s+/', '', $str), 'UTF-8'); //remove all whitespaces and set to lower case
    	$link = $str;
    	for($i = 1; $profilRepo->findOneByLink($link) != null; $i++)
    	{
    		
    		$link = ($str.$i);
    	}
    	
    	$fs->mkdir(self::$rootDir."/".$link); // make a dir for the User and i want an exception
    	$profil->setLink($link);
    	$konto->setProfil($profil);
    	
    	//User
    	$userhere = $userRepo->findOneByEmail($email); //Does this user have a account yet?
    	if($userhere != null) $user = $userhere;
    	else{
    		$user = new User();
    		$user->setEmail($email);
    		$user->setPassword($request->request->get('Pwd'));
    	}
    	$konto->addIduser($user);
    	
    	//Define Konto
    	if($request->request->get('Type') == "Artist") $this->signArtist($konto);
    	else if($request->request->get('Type') == "Source") $this->signSource($konto);  //wrong-type Exception GOES here
    	$user->addIdkonto($konto);
    	
    	//Tag handling GOES here
    	
    	//Persist
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
    	$session->set('link', $profil->getLink());
    	
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
    	$session->set('link', '');
    	return $this->redirect($this->generateUrl('bbl_web_homepage'));
    }
    
    
    public function signArtist($konto)
    {
    	//Objects for Managing
    	$request = $this->getRequest();
    	$em = $this->getDoctrine()->getManager();
    	$genreRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Genre');
    	
    //artist
    	$artist = new Artist();
    	$artist->setKonto($konto);
    	
    //Genre
    try{
    	$genre = $genreRepo->findOneByName($request->request->get('Genre'));
    	//if($genre == null) throw new EntityNotFoundClangdomException();
    	$artist->addGenregenre($genre);
    	if($request->request->get('Genre2') != '') {
    		$genre2 = $genreRepo->findOneByName($request->request->get('Genre2'));
    	//	if($genre2 == null) throw new EntityNotFoundClangdomException(); 
    		$artist->addGenregenre($genre2);
    	}
    }
    catch(Exception $e)
    {
    	throw new EntityNotFoundClangdomException(); 
    }
        $genre->addArtistartist($artist);
    	
		$em->persist($artist);
	}
	
	public function signSource($konto)
	{
		//Objects for Managing
		$request = $this->getRequest();
		$em = $this->getDoctrine()->getManager();
		$taskRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Tasks');
		 
	//source
		$source = new Source();
		$source->setKonto($konto);
		
	//Task
		if($request->request->get('Tasks') != '')
			$task = $taskRepo->findOneByName($request->request->get('Tasks'));
		else $task = $taskRepo->findOneByName("studio"); // task-not-found exception GOES here
		$task->addSourcesource($source);
		$source->addTaskstask($task);
		 
		$em->persist($source);
		$em->persist($task);
	}

//--------------------------------SIGN UP---------------------------------------
    
}
