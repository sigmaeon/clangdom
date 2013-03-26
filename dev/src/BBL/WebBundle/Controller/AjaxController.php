<?php

namespace BBL\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function regAction($name)
    {
        return $this->render('BBLWebBundle:Base:main.html.twig');
    }
}
