<?php

namespace MyCompany\PublishBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
/**
 * DefaultController for home page
 *
 * @author Nikola Bodrozic
 * @package MyCompany\PublishBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/{_locale}", name="runner", defaults={"_locale" = "en"}, requirements={"_locale": "en|fr|nl"})
     */
    public function run(){
        return $this->render('PublishBundle:Default:index.html.twig');
    }

    /**
     * @Route("/diff/{_locale}/{last}/{slug}", name="startpage", defaults={"_locale" = "en"}, requirements={"_locale": "en|fr|nl"})
     */
    public function indexAction($last, $_locale, $slug = "")
    {
        if($last == "post_show" || $last == "post_edit"){
            return $this->redirect($this->generateUrl($last, array('slug' => $slug)));
        }
        else{
            return $this->redirect($this->generateUrl($last));
        }
    }

    /**
     * @Route("/giff/{_locale}/{term}", name="redir_match_language", defaults={"_locale" = "en"}, requirements={"_locale": "en|fr|nl"})
     */
    public function redirAction($_locale,$term)
    {
        //var_dump($term); die;
        return $this->redirect($this->generateUrl('post_match',['_locale' => $_locale, 'term' => $term]));
    }    
    // $this->generateUrl('my_slug',array('page_slug'=>'my_slug', 'param' => '123'))
    /**
     * @Route("/diff2/{_locale}/ind/", name="startpage3", defaults={"_locale" = "en"}, requirements={"_locale": "en|fr|nl"})
     */
    public function indAction()
    {
        return new Response( '<html><body> preusmerio </body></html>' );
    }

    /**
     * @Route("/{_locale}/logetout", name="logedout", defaults={"_locale" = "en"}, requirements={"_locale": "en|fr|nl"})
     */
    public function logedoutAction()
    {
        return $this->render('PublishBundle:Default:index.html.twig');
    }
}