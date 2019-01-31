<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Villano;
use AppBundle\Form\VillanoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Villano controller.
 *
 * @Route("villano")
 */
class VillanoController extends Controller
{
    /**
     * Creates a new villano entity.
     *
     * @Route("/new", name="villano_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $villano = new Villano();
        $form = $this->createForm(VillanoType::class, $villano);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villano);
            $em->flush();

            return $this->redirectToRoute('villano_show', array('id' => $villano->getId()));
        }

        return $this->render('villano/new.html.twig', array(
            'villano' => $villano,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a villano entity.
     *
     * @Route("/{id}", name="villano_show")
     * @Method("GET")
     */
    public function showAction(Villano $villano)
    {
        $deleteForm = $this->createDeleteForm($villano);

        return $this->render('villano/show.html.twig', array(
            'villano' => $villano,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing villano entity.
     *
     * @Route("/{id}/edit", name="villano_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Villano $villano)
    {
        $deleteForm = $this->createDeleteForm($villano);
        $editForm = $this->createForm(VillanoType::class, $villano);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('villano_edit', array('id' => $villano->getId()));
        }

        return $this->render('villano/edit.html.twig', array(
            'villano' => $villano,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a villano entity.
     *
     * @Route("/{id}", name="villano_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Villano $villano)
    {
        $form = $this->createDeleteForm($villano);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($villano);
            $em->flush();
        }

        return $this->redirectToRoute('villano_index');
    }

    /**
     * Creates a form to delete a villano entity.
     *
     * @param Villano $villano The villano entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Villano $villano)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('villano_delete', array('id' => $villano->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
