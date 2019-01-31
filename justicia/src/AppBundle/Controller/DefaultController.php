<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Villano;

class DefaultController extends Controller
{
    /**
     * Lists all villano entities.
     *
     * @Route("/", name="villano_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villanos = $em->getRepository(Villano::class)->findAll();

        return $this->render('villano/index.html.twig', array(
            'villanos' => $villanos,
        ));
    }
}
