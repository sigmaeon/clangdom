<?php

namespace BBL\WebBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;

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
    	else return Response('<html> <body>Not checked in </body> </html>');
    }
    
    public function picUpAction()
    {
    	$upFile =  $this->getRequest()->files->get("datei");
    	$request = $this->getRequest();
    	return new Response($this->get('kernel')->getRootDir().'/../web'.'||'.__DIR__.'/../../../../web/');
    	
    }
   
}
