<?php

namespace BBL\WebBundle\Controller;

use BBL\WebBundle\Exception\EntityNotFoundClangdomException;

use BBL\WebBundle\Exception\UnauthorizedClangdomException;

use BBL\WebBundle\Entity\Video;

use BBL\WebBundle\Entity\Music;

use BBL\WebBundle\Entity\Post;

use BBL\WebBundle\Exception\WrongParamsClangdomException;

use BBL\WebBundle\Entity\File;

use BBL\WebBundle\Entity\Picture;
use BBL\WebBundle\Utilities\Helper;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BBL\WebBundle\Entity\User;
use BBL\WebBundle\Entity\Konto;

class FileController extends Controller
{
	public function createEventAction()
	{
		$session = $this->get('session');
		if($session->get('state') == 'logged') throw new UnauthorizedClangdomException();
		$name = $this->getRequest()->get("name");
		$info = $this->getRequest()->get("info");
		
		
	}
 
    public function testAction()
    {
    	$session = $this->get('session');
    	if($session->get('state') == 'logged') return $this->render('BBLWebBundle:User:test.html.twig');
    	else return new Response('<html> <body>Not checked in </body> </html>');
    }
    
    public function musicTestAction()
    {
    	$session = $this->get('session');
    	if($session->get('state') == 'logged') return $this->render('BBLWebBundle:User:testM.html.twig');
    	else return new Response('<html> <body>Not checked in </body> </html>');
    }
    
	public function videoTestAction()
    {
    	$session = $this->get('session');
    	if($session->get('state') == 'logged') return $this->render('BBLWebBundle:User:testV.html.twig');
    	else return new Response('<html> <body>Not checked in </body> </html>');
    } 
    
    public function picUpAction()
    {
    	$upFile =  $this->getRequest()->files->get("datei");
    	if(!ValueCheck::checkExtension($upFile, array("jpg", "jpeg", "gif", "png"))) throw new WrongParamsClangdomException(); //another exception pls
    	$session = $this->get('session');
    	if($session->get('state') == 'logged') throw new UnauthorizedClangdomException();
    	$em = $this->getDoctrine()->getManager();
    	$kontoRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Konto');
    	$konto = $kontoRepo->findOneByIdkonto($session->get('konto'));
    	$profil = $konto->getProfil();
    	if($konto == null) throw new EntityNotFoundClangdomException();
    	
    	$oldPic = $konto->getProfil()->getPicture();
    	if($oldPic == null){
    		$fileEntity = new File();
    		$fileEntity->setFile($upFile);
    		$fileEntity->upload('picture'.'.'.$upFile->guessExtension(), $profil->getLink());
    		$newPic = new Picture();
    		$newPic->setFile($fileEntity);
    		$profil->setPicture($newPic);
    		
    		$em->persist($fileEntity);
    		$em->persist($newPic);
    		$em->persist($profil);
    		$em->flush();
    	}
    	else {
    		$fileEntity = $oldPic->getFile();
    		$fileEntity->setPath('');
    		$fileEntity->setFile($upFile);
    		$fileEntity->upload('picture'.'.'.$upFile->guessExtension(), $profil->getLink());
    		$em->persist($fileEntity);
    		$em->flush();
    	}
    	return new Response("Thats just for testing");
    	
    }
    
    public function musicUpAction()
    {
    	$name = $this->getRequest()->get("name");
    	if(trim($name) == "") throw new WrongParamsClangdomException();
    	$upFile = $this->getRequest()->files->get("datei");
    	//if(!Helper::checkExtension($upFile, array("mp3"))) throw new WrongParamsClangdomException(); //another exception pls
    	$session = $this->get('session');
    	if($session->get('state') == 'logged') throw new UnauthorizedClangdomException();
    	$em = $this->getDoctrine()->getManager();
    	$kontoRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Konto');
    	$konto = $kontoRepo->findOneByIdkonto($session->get('konto'));
    	$post = new Post();
    	$post->setName($name);
    	$post->setKonto($konto);
    	$music = new Music();
    	$music->setPost($post);
    	$file = new File();
    	$file->setFile($upFile);
    	$file->upload(microtime().'.'.'mp3' /*$upFile->guessExtension()*/, $session->get('link'));
    	$music->setFile($file);
    	$em->persist($file);
    	$em->persist($music);
    	$em->persist($post);
    	$em->persist($konto);
    	$em->flush();
    	return new Response("Thats just for testing");
    }
   
    
    public function videoUpAction()
    {
    	$session = $this->get('session');
    	//if session not allowed
    	$name = $this->getRequest()->get("name");
    	if(trim($name) == "") throw new WrongParamsClangdomException();
    	$link = $this->getRequest()->get("link");
    	if(trim($link) == "") throw new WrongParamsClangdomException();
    	
    	$em = $this->getDoctrine()->getManager();
    	$kontoRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Konto');
    	$konto = $kontoRepo->findOneByIdkonto($session->get('konto'));
    	//Taghandling
    	$tag = $tagRepo->findOneByName(mb_strtolower($konto->getName()));
    	$tag2 = $tagRepo->findOneByName(mb_strtolower($name));
    	if($tag2 == null){
    		$tag2 = new Tags();
    		$tag2->setName(mb_strtolower($name));
    		$em->persist($tag2);
    	}
    	
    	$post = new Post();
    	$post->setName($name);
    	$post->setKonto($konto);
    	$post->addTagstag($tag);
    	$post->addTagstag($tag2);
    	$video = new Video();
    	$video->setUrl($link);
    	$video->setPost($post);
    	$em->persist($video);
    	$em->persist($post);
    	$em->persist($konto);
    	$em->flush();
    	return new Response("Thats just for testing");
    }
}
