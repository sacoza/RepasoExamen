<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\usuarios;
use AppBundle\Entity\Citas;
use AppBundle\Entity\users;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\usuariosType;
use AppBundle\Form\citasType;
use AppBundle\Form\loginType;
use AppBundle\Form\usersType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/index/", name="index")
     */
    public function index(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('index.html.twig');
    }
        /**
     * @Route("/horario/", name="horario")
     */
    public function horario(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('horario.html.twig');
    }
        /**
     * @Route("/galeria/", name="galeria")
     */
    public function galeria(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('galeria.html.twig');
    }


    /**
     * @Route("/info/", name="info")
     */
    public function info(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('info.html.twig');
    }

    /**
     * @Route("/signin/", name="signin")
     */
    public function signin(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('signin.html.twig');
    }

    /**
     * @Route("/login/", name="login")
     */
    public function login(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('login.html.twig');
    }


    /**
     * @Route("/usulista/", name="usulista")
     */
    public function usualista(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('usulista.html.twig');
    }


/**
*@Route("/nuevo/", name="Form")
*/

public function newAction(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $usuario = new usuarios();
        $form = $this->createForm(usuariosType::class, $usuario);
        $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $usuario = $form->getData();

                     $entityManager = $this->getDoctrine()->getManager();
                     $entityManager->persist($usuario);
                     $entityManager->flush();

                }

        return $this->render('nuevo.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/buscar/{id}", name="buscar")
     */

    public function buscarId(Request $request, $id){
    $repository = $this->getDoctrine()->getRepository(usuarios::class);
      $usuarios = $repository->findOneById($id);
      return $this->render('buscar.html.twig',array('usuarios' => $usuarios));
    }


    /**
    *@Route("/lista/", name="lista")
    */
    public function usuAction(Request $request){
    $repository = $this->getDoctrine()->getRepository(usuarios::class);
      $usuarios = $repository->findAll();
      return $this->render('usulista.html.twig',array('usuarios' => $usuarios));
    }

    /**
    *@Route("/actua/{id}", name="actua")
    */

    public function ActuaAction(Request $request,$id)
        {
          if ($id) {
            $repository = $this->getDoctrine()->getRepository(usuarios::class);
              $usuario = $repository->find($id);
          }else {
            $usuario = new usuarios();
          }
            // creates a task and gives it some dummy data for this example

            $form = $this->createForm(usuariosType::class, $usuario);
            $form->handleRequest($request);

                    if ($form->isSubmitted() && $form->isValid()) {
                        $usuario = $form->getData();

                         $entityManager = $this->getDoctrine()->getManager();
                         $entityManager->persist($usuario);
                         $entityManager->flush();

                    }

            return $this->render('nuevo.html.twig', array(
                'form' => $form->createView(),
            ));
        }

        /**
        *@Route("/cita", name="cita")
        */

        public function newCita(Request $request)
            {
                // creates a task and gives it some dummy data for this example
                $usuario = new Citas();
                $citas = $this->createForm(citasType::class, $usuario);
                $citas->handleRequest($request);

                        if ($citas->isSubmitted() && $citas->isValid()) {
                            $usuario = $citas->getData();

                             $entityManager = $this->getDoctrine()->getManager();
                             $entityManager->persist($usuario);
                             $entityManager =  $entityManager->flush();

                        }

                return $this->render('cita.html.twig', array(
                    'citas' => $citas->createView(),
                ));
            }
            /**
            *@Route("/login/", name="login")
            */

            public function logAction(Request $request)
                {
                    // creates a task and gives it some dummy data for this example
                    $login = new usuarios();
                    $log = $this->createForm(loginType::class, $login);
                    $log->handleRequest($request);

                            if ($log->isSubmitted() && $log->isValid()) {
                                $login = $log->getData();

                                 $entityManager = $this->getDoctrine()->getManager();
                                 $entityManager->persist($login);
                                 $entityManager->flush();

                            }

                    return $this->render('login.html.twig', array(
                        'log' => $log->createView(),
                    ));
                }
                /**
                 * @Route("/register", name="register")
                 */
                    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
                    {
                        // 1) build the form
                        $user = new users();
                        $form = $this->createForm(usersType::class, $user);

                        // 2) handle the submit (will only happen on POST)
                        $form->handleRequest($request);
                        if ($form->isSubmitted() && $form->isValid()) {

                            // 3) Encode the password (you could also do this via Doctrine listener)
                            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                            $user->setPassword($password);
                            $user=$form->getData();
                            // 4) save the User!
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->persist($user);
                            $entityManager->flush();

                            // ... do any other work - like sending them an email, etc
                            // maybe set a "flash" success message for the user

                            return new Response("usuario Registrado");
                        }

                        return $this->render('register.html.twig', array(
                            'form' => $form->createView(),
                        ));
                    }
                }
