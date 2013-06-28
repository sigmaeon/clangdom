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
 		$response->send();
 		$response->sendHeaders();
 		return $response;
 	}
 	
 	public function clearFilterAction()
 	{
 		$response = new Response();
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
 		$em = $this->getDoctrine()->getManager();
 		$artistRepo = $this->getDoctrine()->getRepository('BBLWebBundle:Artist');
 		$query = $artistRepo->createQueryBuilder('a')
 				->innerJoin('a.konto', 'k')
 				->innerJoin('k.location', 'l')
 				->innerJoin('a.genregenre', 'g');
 		
 		$cookies = $this->getRequest()->cookies;
 		$cookieKeys = $cookies->keys(); 		
 		$favs = null;
 		$gens = null;
 		$locs = null;
 		foreach($cookieKeys as $key)
 		{
 			if(strpos($key, "filter") === 0)
 			{
 				
 				if(strpos($key, "Rad") !== false)  // ~~~ if key contains "Rad"
 				{
 					if(strpos($key, "fav") !== false)
 					{
 						$favs[] = $cookies->get($key);
 					}
 					if(strpos($key, "gen") !== false)
 					{
 						$gens[] = $cookies->get($key);
 					}
 					if(strpos($key, "loc") !== false)
 					{
 						$locs[] = $cookies->get($key);
 					}
 				}
 			}
 		}
 		if($gens != null)
 		{
 			$query->where('g.name IN (:gens)')
 				  ->setParameter('gens', $gens);
 		}
 		if($locs != null)
 		{
 			if($gens == null) 
 			{
 				$query->where('l.region IN (:locs)');
 				$first = false;
 			}
 			else $query->andWhere('l.region IN (:locs)');
 			$query->setParameter('locs', $locs);
 			
 		}
 		if($favs != null && ($locs != null || $gens != null))
 		{
 			$query->orWhere('k.name IN (:favs)');
 			$query->setParameter('favs', $favs);
 		}
 			
 		$result = $query->getQuery()->getResult();
 		$mp3s = null;
 		foreach($result as $artist)
 		{
 			$mq = $em->createQuery("SELECT m FROM BBL\WebBundle\Entity\Music m JOIN m.post p JOIN p.konto k 
 									WHERE k.idkonto = '" .$artist->getKonto()->getIdkonto() . "'");
 			$musics = $mq->getResult();
 			foreach($musics as $music)
 			{
 				$mp3s[] = array($music->getFile()->getWebPath(), $music->getPost()->getName(),
 								 $artist->getKonto()->getName(), $artist->getKonto()->getProfil()->getLink());
 			}
 		}
 		if($mp3s == null) return new Response();
 		shuffle($mp3s);
 		$mp3s = array_slice($mp3s, 0, 20);
 		return new Response(json_encode($mp3s),200,array('Content-Type'=>'application/json'));
 	}
 	
}

