<?php

namespace MyCompany\PublishBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends BaseController
{
    public function registerAction()
    {
		$isRoleAdmin = $this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
		
		if( $isRoleAdmin ){
	        $response = parent::registerAction();
	        return $response;       
		} else {
			// we don`t extend Symfony controller so we must use service container
			$content = $this->container->get('templating')->render('PublishBundle:info:forbidden.html.twig');
			return new Response($content);
		}
    }
}