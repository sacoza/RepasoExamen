<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Justicia;
use AppBundle\Form\JusticiaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Justicium controller.
 *
 * @Route("justicia")
 */
class JusticiaController extends Controller
{
    /**
     * Lists all justicium entities.
     *
     * @Route("/", name="justicia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $justicias = $em->getRepository(Justicia::class)->findAll();

        return $this->render('justicia/index.html.twig', array(
            'justicias' => $justicias,
        ));
    }

    /**
     * Creates a new justicium entity.
     *
     * @Route("/new", name="justicia_new")
     * @Method({"GET", "POST"})
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new Justicia();
        $form = $this->createForm(JusticiaType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('justicia_index');
        }

        return $this->render(
            'justicia/new.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Finds and displays a justicium entity.
     *
     * @Route("/{id}", name="justicia_show")
     * @Method("GET")
     */
    public function showAction(Justicia $justicium)
    {
        $deleteForm = $this->createDeleteForm($justicium);

        return $this->render('justicia/show.html.twig', array(
            'justicium' => $justicium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing justicium entity.
     *
     * @Route("/{id}/edit", name="justicia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Justicia $justicium)
    {
        $deleteForm = $this->createDeleteForm($justicium);
        $editForm = $this->createForm(JusticiaType::class, $justicium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('justicia_edit', array('id' => $justicium->getId()));
        }

        return $this->render('justicia/edit.html.twig', array(
            'justicium' => $justicium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a justicium entity.
     *
     * @Route("/{id}", name="justicia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Justicia $justicium)
    {
        $form = $this->createDeleteForm($justicium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($justicium);
            $em->flush();
        }

        return $this->redirectToRoute('justicia_index');
    }

    /**
     * Creates a form to delete a justicium entity.
     *
     * @param Justicia $justicium The justicium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Justicia $justicium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('justicia_delete', array('id' => $justicium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
