<?php

namespace BBL\WebBundle;

use BBL\WebBundle\Controller\MainController;

use BBL\WebBundle\Entity\File;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BBLWebBundle extends Bundle
{
	public function boot()
	{
		$this->setFilesystem();
	}
	
	private function setFilesystem()
	{
		$fs = new Filesystem();
		$rootDir = $this->container->getParameter('uploads_directory');
		
		if(!$fs->exists($rootDir))
			try {
			$fs->mkdir($rootDir);
		}
		catch (IOException $e) {
			echo "An error occurred while creating your directory";
		}
		//File::setUploadsDirectory($rootDir);
		MainController::setUploadsDirectory($rootDir);
	}
}