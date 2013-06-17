<?php

namespace BBL\WebBundle\Controller;

use BBL\WebBundle\Entity\Music;

use BBL\WebBundle\Entity\Post;

use BBL\WebBundle\Exception\WrongParamsClangdomException;

use BBL\WebBundle\Entity\File;
use Symfony\Component\HttpFoundation\Cookie;

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

class FilterNRadioController extends Controller
{
 	public function setFilterAction()
 	{
 		$response = new Response();
 		$filter = json_decode($this->getRequest()->request->get("filter"));
 		
 		foreach($filter as $key => $value)
 		{
 			$i = 0;
 			if($value != null)
 			{
 				foreach($value as $str)
	 			{
	 				$response->headers->setCookie(new Cookie("filter".$key."".$i."", $str));
	 				$i++;
	 			}
 			}
 		}
 		return $response->send();
 	}
 	
 	public function clearFilterAction()
 	{
 		$response = new Response("What");
 		$cookies = $this->getRequest()->cookies;
 		$cookieKeys = $cookies->keys();
 		foreach($cookieKeys as $key)
 		{
 			if(strpos($key, "filter") === 0) $response->headers->clearCookie($key); // ~~~if key starts with "filter"
 		}
 		return $response->send();
 	}
 	
 	public function setRadioMediaAction()
 	{
 		
 	}
 	
}

