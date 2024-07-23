<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Form\EventoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EventosController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $eventos = $this->entityManager->getRepository(Evento::class)->FindAll();
        return $this->render('eventos/eventos.html.twig',[
            'eventos' => $eventos,
        ]);
    }

    //esto se puede hacer importando use Symfony\Component\Routing\Annotation\Route;
    //Pero tambien se puede hacer añadiendo en routes.yaml
        //eventos_show:
        //path: /eventos/{id}
        //controller: App\Controller\EventosController::show
    /**
     * @Route("/eventos/{id}", name="eventos_show")
     */
    public function show($id): Response
    {
        $eventoId = (int)$id;
        $evento = $this->entityManager->getRepository(Evento::class)->find($eventoId);

        if (!$evento) {
            throw $this->createNotFoundException('La publicación no se encontró');
        }
        return $this->render('eventos/show.html.twig', ['evento' => $evento]);
    }
    /**
    * @Route("/eventos/create", name="eventos_create")
    */
    public function create(Request $request): Response
    {
        $evento = new Evento();
        $form = $this->createForm(EventoType::class, $evento);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {   
            $evento->setFecha($evento->combinarFechaYHora());         
            $this->entityManager->persist($evento);
            $this->entityManager->flush();

            $this->addFlash('success', 'El evento se ha creado correctamente.');

            return $this->redirectToRoute('index');
        }

        return $this->render('eventos/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
