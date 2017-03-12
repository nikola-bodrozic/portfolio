<?php

namespace MyCompany\PublishBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * DefaultController for home page
 *
 * @author Nikola Bodrozic
 * @package MyCompany\PublishBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     *
     * @Route("/{_locale}", name="startpage", defaults={"_locale" = "en"}, requirements={"_locale": "en|fr|nl"})
     */
    public function indexAction()
    {
        return $this->render('PublishBundle:Default:index.html.twig');
    }

    /**
     * @Route("/", name="redir2startpage")
     *
     */
    public function indexlocAction()
    {
        return  $this->forward('PublishBundle:Default:index' );
    }
}