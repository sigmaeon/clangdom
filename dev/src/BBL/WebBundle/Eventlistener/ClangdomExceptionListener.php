<?php
namespace BBL\WebBundle\Eventlistener;

use BBL\WebBundle\Exception\NoAjaxClangdomException;

use BBL\WebBundle\Exception\ClangdomExceptionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use BBL\WebBundle\Exception;

class ClangdomExceptionListener
{
	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		// Get the exception object from the received event
		$exception = $event->getException();
		
		$response = new Response();
		
		
		if($exception instanceof NoAjaxClangdomException) {
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent("<p> OMG </p>");
			$event->setResponse($response);
		}
		
		elseif($exception instanceof ClangdomExceptionInterface) {
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
			$response->setContent("<p> Mamma mia </p>");
			$event->setResponse($response);
		}
		
		
		/*
		// HttpExceptionInterface is a special type of exception that
		// holds status code and header details
		if ($exception instanceof HttpExceptionInterface) {
			$response->setStatusCode($exception->getStatusCode());
			$response->headers->replace($exception->getHeaders());
		} else {
			$response->setStatusCode(500);
		}
		
		// Send the modified response object to the event
		$event->setResponse($response);
		*/
	}
	
}