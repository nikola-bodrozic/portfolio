<?php

namespace MyCompany\PublishBundle\Controller;

use MyCompany\PublishBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Post controller.
 *
 * @author Nikola Bodrozic
 *
 */
class PostController extends Controller
{
    /**
     * Lists all post entities.
     *
     * @Route("/{_locale}/post/list", name="post_index", defaults={"_locale": "en"}, requirements={"_locale": "en|fr|nl" })
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT p FROM PublishBundle:Post p ORDER BY p.id DESC";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate( $query, $request->query->getInt('page', 1), 2 );

        // parameters to template
        return $this->render('PublishBundle:post:index.html.twig', array('pagination' => $pagination));
    }

    /**
     * Creates a new post entity.
     *
     * @Route("/new", name="post_new", defaults={"_locale": "en"}, requirements={"_locale": "en|fr|nl" })
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm('MyCompany\PublishBundle\Form\PostType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush($post);

            return $this->redirectToRoute('post_show', array('slug' => $post->getSlug()));
        }

        return $this->render('PublishBundle:post:new.html.twig', array(
            'post' => $post,
            'new_form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a post entity.
     *
     * @Route("/{_locale}/{slug}/show", name="post_show", defaults={"_locale": "en"}, requirements={"_locale": "en|fr|nl" })
     * @Method("GET")
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository("PublishBundle:Post")
                    ->findOneBy(['slug'=>$slug]);
        return $this->render('PublishBundle:post:show.html.twig', array(
            'post' => $post,
            'slug' => $slug
        ));
    }

    /**
     * Displays a form to edit an existing post entity.
     *
     * @Route("/{_locale}/{slug}/edit", name="post_edit", defaults={"_locale": "en"}, requirements={"_locale": "en|fr|nl" })
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Post $post, $slug)
    {
        $editForm = $this->createForm('MyCompany\PublishBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
//var_dump($post->getSlug());die;
            return $this->redirectToRoute('post_edit', array('slug' => $post->getSlug()));
        }

        return $this->render('PublishBundle:post:edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a post entity.
     *
     * @Route("/{slug}", name="post_delete")
     * @Security("has_role('ROLE_USER')")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Post $post)
    {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();
        }

        return $this->redirectToRoute('post_index');
    }

    /**
     * Creates a form to delete a post entity.
     *
     * @param Post $post The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($slug)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('slug' => $slug)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
