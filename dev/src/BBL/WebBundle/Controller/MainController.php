<?php

namespace BBL\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BBL\WebBundle\Entity\User;
use BBL\WebBundle\Entity\Konto;
use BBL\WebBundle\Entity\Genre;
use BBL\WebBundle\Entity\Profil;
use BBL\WebBundle\Entity\Artist;
use BBL\WebBundle\Entity\Source;
use BBL\WebBundle\Entity\Tasks;


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
    	return $this->render('BBLWebBundle:Base:reg.html.twig', array('sesson' => false, 'type' => "no"));
    }
    
    public function regArtAction()
    {
    	return $this->render('BBLWebBundle:Base:reg.html.twig', array('sesson' => false, 'type' => "art"));
    }
    
    public function regSouAction()
    {
    	return $this->render('BBLWebBundle:Base:reg.html.twig', array('sesson' => false, 'type' => "sou"));
    }
    
    
    
    public function profilAction($name)
    {
    	return $this->render('BBLWebBundle:User:profil.html.twig', array('sesson' => false, 'profname' => $name, 'pic' => ".."));
    }
    
    
    
//--------------------------------Sign Up---------------------------------------------------

    public function signUpAction()
    {
    	//check if != xmlhttprequest_header --> exception GOES here
    	
    	//Objects for managing
    	$request = $this->getRequest();	
    	$em = $this->getDoctrine()->getManager();
    	$userRepo = $this->getDoctrine()->getRepository('BBLWebBundle:User');
    	
    	
       //-----------Fill the DB--------
    	
    	//Konto
    	$konto = new Konto();
    	$konto->setName($request->request->get('Name'));
    	
    	//Profil
    	$profil = new Profil();   //Logic to avoid multiple links GOES here
    	$str = ("/".$request->request->get('Name'));
    	$profil->setLink(preg_replace('/\s+/', '', $str));
    	$konto->setProfil($profil);
    	
    	//User
    	$userhere = $userRepo->findOneByEmail($request->request->get('Email')); //Does this user have a account yet?
    	if($userhere != null) $user = $userhere;
    	else{
    		$user = new User();
    		$user->setEmail($request->request->get('Email'));
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
    	if($request->request->get('Genre') != '')
    		$genre = $genreRepo->findOneByName($request->request->get('Genre'));
    	else $genre = $genreRepo->findOneByName("Classic"); // genre-not-found exception GOES here
    	$genre->addArtistartist($artist);
    	$artist->addGenregenre($genre);
    	
		$em->persist($artist);
    	$em->persist($genre);
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
