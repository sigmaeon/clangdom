<?php
namespace BBL\WebBundle\Eventlistener;

//own Exceptions
use BBL\WebBundle\Exception\UnauthorizedClangdomException;

use BBL\WebBundle\Exception\ClangdomException;
use BBL\WebBundle\Exception\ClangdomExceptionInterface;
use BBL\WebBundle\Exception\EntityNotFoundClangdomException;
use BBL\WebBundle\Exception\NoAjaxClangdomException;
use BBL\WebBundle\Exception\WrongParamsClangdomException;

//Symfony Exceptions
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

//Symfony Libs
use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;




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
		
		
		
		if($exception instanceof NoAjaxClangdomException) 
		{
			$response = new Response();
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent( $this->engine->render('BBLWebBundle:Exceptions:noAjax.html.twig'));
			$event->setResponse($response);
		}
		elseif($exception instanceof EntityNotFoundClangdomException) 
		{
			$response = new Response();
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent($this->engine->render('BBLWebBundle:Exceptions:noEntity.html.twig'));
			$event->setResponse($response);
		}
		elseif($exception instanceof MethodNotAllowedHttpException)
		{
			$response = new Response();
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent($this->engine->render('BBLWebBundle:Exceptions:notAllowed.html.twig'));
			$event->setResponse($response);
		}
		elseif($exception instanceof WrongParamsClangdomException)
		{	
			$response = new Response();
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent($this->engine->render('BBLWebBundle:Exceptions:wrongParams.html.twig'));
			$event->setResponse($response);
		}
		elseif($exception instanceof UnauthorizedClangdomException)
		{
			$response = new Response();
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent($this->engine->render('BBLWebBundle:Exceptions:unauthorized.html.twig'));
			$event->setResponse($response);
		}
		elseif($exception instanceof RouteNotFoundException)
		{
			$response = new Response();
			$response->setStatusCode('404');
			$response->setContent($this->engine->render('BBLWebBundle:Exceptions:notFound.html.twig'));
			$event->setResponse($response);
		}
		/*elseif($exception instanceof HttpExceptionInterface) {
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent($this->engine->render('BBLWebBundle:Exceptions:notFound.html.twig'));
			$event->setResponse($response);
		}
		else{
			$response->setContent($this->engine->render('BBLWebBundle:Exceptions:internal.html.twig'));
			$event->setResponse($response);
		}*/
		
	}
	
}