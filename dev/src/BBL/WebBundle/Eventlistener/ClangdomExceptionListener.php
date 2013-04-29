<?php
namespace BBL\WebBundle\Eventlistener;

use Symfony\Component\Routing\Exception\ResourceNotFoundException;

use BBL\WebBundle\Exception\EntityNotFoundClangdomException;

use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;

use BBL\WebBundle\Exception\NoAjaxClangdomException;
use BBL\WebBundle\Exception\ClangdomExceptionInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use BBL\WebBundle\Exception;

class ClangdomExceptionListener
{
	private $engine;
	
	public function __construct(TimedTwigEngine $engine)
	{
		$this->engine = $engine;
	}
	
	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		// Get the exception object from the received event
		$exception = $event->getException();
		
		$response = new Response();
		
		
		
		if($exception instanceof NoAjaxClangdomException) {
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent( $this->engine->render('BBLWebBundle:Exceptions:noAjax.html.twig'));
			$event->setResponse($response);
		}
		
		elseif($exception instanceof EntityNotFoundClangdomException) {
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent($this->engine->render('BBLWebBundle:Exceptions:noEntity.html.twig'));
			$event->setResponse($response);
		}
		elseif($exception instanceof HttpExceptionInterface) {
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent($this->engine->render('BBLWebBundle:Exceptions:notFound.html.twig'));
			$event->setResponse($response);
		}
		else{
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent($this->engine->render('BBLWebBundle:Exceptions:internal.html.twig'));
			$event->setResponse($response);
		}
		
		
		/*
		 * HttpExceptionInterface is a special type of exception that
		 * holds status code and header details
	     */
		/*else{//if ($exception instanceof HttpExceptionInterface) {
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent($this->engine->render('BBLWebBundle:Exceptions:404.html.twig'));
		}// else {*/
		//	$response->setStatusCode(500);
		//}
		
	   // Send the modified response object to the event
		//$event->setResponse($response);
		
	}
	
}