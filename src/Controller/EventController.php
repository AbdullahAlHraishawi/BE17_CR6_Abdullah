<?php

namespace App\Controller;

use App\Entity\Events;
use App\Form\EventsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $events = $doctrine->getRepository(Events::class)->findAll();
        // dd($events);
        return $this->render('event/index.html.twig', [
            "events" => $events,
        ]);
    }

    #[Route('/create', name: 'create-event')]
    public function createAction(Request $request, ManagerRegistry $doctrine): Response
    {
        $events = new Events();
        $form = $this->createForm(EventsType::class, $events);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $events = $form->getData();

            $createEvent = $doctrine->getManager();

            $createEvent->persist($events);
            $createEvent->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('event/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'edit-event')]
    public function editeAction($id, Request $request, ManagerRegistry $doctrine): Response
    {
        $events = $doctrine->getRepository(Events::class)->find($id);
        $form = $this->createForm(EventsType::class, $events);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $events = $form->getData();

            $createEvent = $doctrine->getManager();

            $createEvent->persist($events);
            $createEvent->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('event/edit.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/details/{id}', name: 'details-event')]
    public function detailsAction($id, ManagerRegistry $doctrine): Response
    {
        $events = $doctrine->getRepository(Events::class)->find($id);
        return $this->render('event/details.html.twig', [
            "events" => $events,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete-event')]
    public function deleteAction($id, ManagerRegistry $doctrine): Response
    {
        $deleteEvent = $doctrine->getManager();
        $events = $doctrine->getRepository(Events::class)->find($id);
        $deleteEvent ->remove($events);
        $deleteEvent ->flush();
        
        return $this -> redirectToRoute('index');
    }
}
