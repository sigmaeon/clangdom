<?php

namespace BBL\WebBundle\Controller;

use BBL\WebBundle\Exception\WrongParamsClangdomException;
use BBL\WebBundle\Exception\NoAjaxClangdomException;
use BBL\WebBundle\Exception\EntityNotFoundClangdomException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BBL\WebBundle\Utilities\Helper;
use BBL\WebBundle\Entity\User;
use BBL\WebBundle\Entity\Konto;
use BBL\WebBundle\Entity\Music;

class LoadController extends Controller
{
	
//--------------Load Tabs---------------	
   public function loadAction()
    {
    	//Objects for Managing
    	$request = $this->getRequest();
    	if(!$request->isXmlHttpRequest()) throw new NoAjaxClangdomException();
    	$em = $this->getDoctrine()->getManager();
    	$userRepo = $this->getDoctrine()->getRepository('BBLWebBundle:User');
    	$type = $request->request->get('Type');
    	if($type == null) throw new WrongParamsClangdomException();
    	switch ($type){ 
    	
    		case "hot":   return $this->fillHot(); //return $this->fillHot();
    		case "bands": return $this->fillBand();
    		case "event": return $this->fillEvent();
    		case "music": return $this->fillMusic();
    		case "dash":  return $this->fillDash();
    		default: throw new WrongParamsClangdomException();
    	}
    }
    
    public function fillHot()
    {
    	$em = $this->getDoctrine()->getManager();
    	$musicRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Music');
    	$vidRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Video');
    	$eventRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Event');
    	
    	$query = $em->createQuery('SELECT p FROM BBL\WebBundle\Entity\Post p ORDER BY p.date DESC');
    	$posts = $query->getResult();
    	if($posts == null) throw new EntityNotFoundClangdomException();
    	
    	$i = 0;
    	foreach ($posts as $post) {
    		if($musicRepo->findOneByPost($post->getIdpost()) != null)
    		{
    			$music = $musicRepo->findOneByPost($post->getIdpost());
    			$objects['ob'.$i]['type'] = "mp3";
    			$konto = $music->getPost()->getKonto();
    			$pic = $konto->getProfil()->getPicture();
    			if($pic != null) $objects['ob'.$i]['picture'] =  $pic->getFile()->getWebPath();
    			else $objects['ob'.$i]['picture'] =  ".."; //default pic link goes here
    			$objects['ob'.$i]['link'] = $konto->getProfil()->getLink();
    			$objects['ob'.$i]['info'] = "..";
    			$objects['ob'.$i]['name'] = $konto->getName();
    			$objects['ob'.$i]['song'] = $music->getPost()->getName();
    			$objects['ob'.$i]['songlink'] = $music->getFile()->getWebPath();
    		}
    		else if($vidRepo->findOneByPost($post->getIdpost()) != null)
    		{
    			$video = $vidRepo->findOneByPost($post->getIdpost());
    			$objects['ob'.$i]['type'] = "video";
    			$konto = $video->getPost()->getKonto();
    			$pic = $konto->getProfil()->getPicture();
    			if($pic != null) $objects['ob'.$i]['picture'] =  $pic->getFile()->getWebPath();
    			else $objects['ob'.$i]['picture'] =  ".."; //default pic link goes here
    			$objects['ob'.$i]['link'] = $konto->getProfil()->getLink();
    			$objects['ob'.$i]['info'] = "..";
    			$objects['ob'.$i]['name'] = $konto->getName();
    			$objects['ob'.$i]['song'] = $video->getPost()->getName();
    			$objects['ob'.$i]['youtube'] = $video->getUrl();
    		}
    		else if($eventRepo->findOneByPost($post->getIdpost()) != null)
    		{
    			 
    		}
    		$i++;
    		
    	}
    	
    	return $this->render('BBLWebBundle:Base:content.html.twig',
    			array('objects' => $objects));
    }
    
    public function fillBand()
    {
    	$em = $this->getDoctrine()->getManager();
    	$query = $em->createQuery('SELECT k FROM BBL\WebBundle\Entity\Konto k');
    	$kontos = $query->getResult();
    	if($kontos == null) throw new EntityNotFoundClangdomException();
    	
    	$i = 0;
    	foreach ($kontos as $konto) {
    		$objects['ob'.$i]['type'] = "simple";
    		$pic = $konto->getProfil()->getPicture();
    		if($pic != null) $objects['ob'.$i]['picture'] =  $pic->getFile()->getWebPath();
    		else $objects['ob'.$i]['picture'] =  "..";
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
    
    public function fillMusic()
    {
    	$em = $this->getDoctrine()->getManager();
    	$query = $em->createQuery('SELECT m FROM BBL\WebBundle\Entity\Music m JOIN m.post p ORDER BY p.date DESC');
    	$musics = $query->getResult();
    	if($musics == null) throw new EntityNotFoundClangdomException();
    	 
    	$i = 0;
    	foreach ($musics as $music) {
    		$objects['ob'.$i]['type'] = "mp3";
    		$konto = $music->getPost()->getKonto();
    		$pic = $konto->getProfil()->getPicture();
    		if($pic != null) $objects['ob'.$i]['picture'] =  $pic->getFile()->getWebPath();
    		else $objects['ob'.$i]['picture'] =  ".."; //default pic link goes here
    		$objects['ob'.$i]['link'] = $konto->getProfil()->getLink();
    		$objects['ob'.$i]['info'] = "..";
    		$objects['ob'.$i]['name'] = $konto->getName();
    		$objects['ob'.$i]['song'] = $music->getPost()->getName();
    		$objects['ob'.$i]['songlink'] = $music->getFile()->getWebPath();
    		$i++;
    	}
    	return $this->render('BBLWebBundle:Base:content.html.twig',
    			array('objects' => $objects, 'title' => "Bands"));
    }
    
    
    public function fillProfMusic()
    {
    	$em = $this->getDoctrine()->getManager();
    	$query = $em->createQuery('SELECT k FROM BBL\WebBundle\Entity\Konto k');
    	$kontos = $query->getResult();
    	if($kontos == null) throw new EntityNotFoundClangdomException();
    	 
    	$i = 0;
    	foreach ($kontos as $konto) {
    		$objects['ob'.$i]['type'] = "simple";
    		$pic = $konto->getProfil()->getPicture();
    		if($pic != null) $objects['ob'.$i]['picture'] =  $pic->getFile()->getWebPath();
    		else $objects['ob'.$i]['picture'] =  "..";
    		$objects['ob'.$i]['link'] = $konto->getProfil()->getLink();
    		$objects['ob'.$i]['info'] = "..";
    		$objects['ob'.$i]['name'] = $konto->getName();
    		$i++;
    	}
    	return $this->render('BBLWebBundle:Base:content.html.twig',
    			array('objects' => $objects, 'title' => "Bands"));
    }
    
    public function fillDash()
    {
    	$em = $this->getDoctrine()->getManager();
    	$musicRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Music');
    	$vidRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Video');
    	$eventRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Event');
    	$link = $this->getRequest()->request->get('Link');
    	if(trim($link) == "") throw new WrongParamsClangdomException();
    	
    	$query = $em->createQuery(
    			"SELECT p FROM BBL\WebBundle\Entity\Post p JOIN p.konto k JOIN k.profil pr WHERE pr.link = '". $link .
    			 "' ORDER BY p.date DESC");
    	$posts = $query->getResult();
    	if($posts == null) throw new EntityNotFoundClangdomException();
    	
    	$i = 0;
    	foreach ($posts as $post) {
    		if($musicRepo->findOneByPost($post->getIdpost()) != null)
    		{
    			$music = $musicRepo->findOneByPost($post->getIdpost());
    			if($link == $this->get('session')->get("link")) $objects['ob'.$i]['type'] = "ownmp3";
    			else $objects['ob'.$i]['type'] = "mp3";
    			$konto = $music->getPost()->getKonto();
    			$pic = $konto->getProfil()->getPicture();
    			if($pic != null) $objects['ob'.$i]['picture'] =  $pic->getFile()->getWebPath();
    			else $objects['ob'.$i]['picture'] =  ".."; //default pic link goes here
    			$objects['ob'.$i]['link'] = $konto->getProfil()->getLink();
    			$objects['ob'.$i]['info'] = "..";
    			$objects['ob'.$i]['name'] = $konto->getName();
    			$objects['ob'.$i]['song'] = $music->getPost()->getName();
    			$objects['ob'.$i]['songlink'] = $music->getFile()->getWebPath();
    		}
    		else if($vidRepo->findOneByPost($post->getIdpost()) != null)
    		{
    			$video = $vidRepo->findOneByPost($post->getIdpost());
    			if($link == $this->get('session')->get("link")) $objects['ob'.$i]['type'] = "video";
    			else $objects['ob'.$i]['type'] = "video";
    			$konto = $video->getPost()->getKonto();
    			$pic = $konto->getProfil()->getPicture();
    			if($pic != null) $objects['ob'.$i]['picture'] =  $pic->getFile()->getWebPath();
    			else $objects['ob'.$i]['picture'] =  ".."; //default pic link goes here
    			$objects['ob'.$i]['link'] = $konto->getProfil()->getLink();
    			$objects['ob'.$i]['info'] = "..";
    			$objects['ob'.$i]['name'] = $konto->getName();
    			$objects['ob'.$i]['song'] = $video->getPost()->getName();
    			$objects['ob'.$i]['youtube'] = $video->getUrl();
    		}
    		else if($eventRepo->findOneByPost($post->getIdpost()) != null)
    		{
    			
    		}
    		$i++;
    	
    	}
    				
   		return $this->render('BBLWebBundle:Base:content.html.twig',
    			array('objects' => $objects));
    	 
    	
    	
    }
    
    
//----------------- Response Form Data----------
    public function fillArtistAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$genRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Genre');
    	$gensOjs = $genRepo->findAll();
    	$gens = array();
    	$return = array();
    	foreach($gensOjs as $gen)
    	{
    		$gens[] = $gen->getName();
    	}
    	$return = array("Genre" => $gens, "Locations" => $this->getLocations());
    	//$return = $this->getLocations();
    	$return = json_encode($return);
    	return new Response($return,200,array('Content-Type'=>'application/json'));
    }
    
    public function fillSourceAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$taskRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Tasks');
    	$tasksOjs = $taskRepo->findAll();
    	$tasks = array();
    	$return = array();
    	foreach($tasksOjs as $task)
    	{
    		$tasks[] = $task->getName();
    	}
    	$return = array("Tasks" => $tasks, "Locations" => $this->getLocations());
    	$return = json_encode($return);
    	return new Response($return,200,array('Content-Type'=>'application/json'));
    }
    
    public function getLocations()
    {
    	$return = array();
    	$em = $this->getDoctrine()->getManager();
    	$locRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Location');
    	$locs = $locRepo->findAll();
    	foreach($locs as $loc)
    	{
    		$return = $this->toArray($loc, $return);
    	}
    	return $return;
    }
    
    private function toArray($loc, $return)
    {
    	if(array_key_exists($loc->getCountry(), $return))
    	{
    		if(array_key_exists($loc->getFederalState(), $return[$loc->getCountry()]))
    		{
    			$return[$loc->getCountry()][$loc->getFederalState()][] = $loc->getRegion();
    		}
    		else{
    			$return[$loc->getCountry()][$loc->getFederalState()][] =  $loc->getRegion();
    		}
    	}
    	else{
    		$return[$loc->getCountry()] = array($loc->getFederalState() => array($loc->getRegion()));
    	}
    	
    	return $return;
    }
}
