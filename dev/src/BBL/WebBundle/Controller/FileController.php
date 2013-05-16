<?php

namespace BBL\WebBundle\Controller;

use BBL\WebBundle\Entity\Music;

use BBL\WebBundle\Entity\Post;

use BBL\WebBundle\Exception\WrongParamsClangdomException;

use BBL\WebBundle\Entity\File;

use BBL\WebBundle\Entity\Picture;
use BBL\WebBundle\Utilities\ValueCheck;
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
    
    public function picUpAction()
    {
    	$upFile =  $this->getRequest()->files->get("datei");
    	if(!ValueCheck::checkExtension($upFile, array("jpg", "jpeg", "gif", "png"))) throw new WrongParamsClangdomException(); //another exception pls
    	$session = $this->get('session');
    	//if($session->get('state') == 'logged') exception!!!
    	$em = $this->getDoctrine()->getManager();
    	$kontoRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Konto');
    	$konto = $kontoRepo->findOneByIdkonto($session->get('konto'));
    	$profil = $konto->getProfil();
    	if($konto == null) return new Response("Fuck"); //exception instead
    	
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
    	$upFile = $this->getRequest()->files->get("datei");
    	//if(!ValueCheck::checkExtension($upFile, array("mp3"))) throw new WrongParamsClangdomException(); //another exception pls
    	$session = $this->get('session');
    	//if($session->get('state') == 'logged') exception!!!
    	$em = $this->getDoctrine()->getManager();
    	$kontoRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Konto');
    	$konto = $kontoRepo->findOneByIdkonto($session->get('konto'));
    	$post = new Post();
    	$post->setName($this->getRequest()->get("name"));
    	$post->setKonto($konto);
    	$music = new Music();
    	$music->setPost($post);
    	$file = new File();
    	$file->setFile($upFile);
    	$file->upload(microtime().'.'.'mp3'/*$upFile->guessExtension()*/, $session->get('link'));//Landerer fragen ob es nicht anders geht
    	$music->setFile($file);
    	$em->persist($file);
    	$em->persist($music);
    	$em->persist($post);
    	$em->persist($konto);
    	$em->flush();
    	return new Response("Thats just for testing");
    }
   
}
