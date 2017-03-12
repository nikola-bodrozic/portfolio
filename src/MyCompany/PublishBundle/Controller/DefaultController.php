<?php

namespace MyCompany\PublishBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     *
     * @Route("/", name="startpage")
     * @Route("/{_locale}", name="startpage2")
     */
    public function indexAction()
    {
        return $this->render('PublishBundle:Default:index.html.twig');
    }
}