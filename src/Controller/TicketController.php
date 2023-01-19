<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\TicketType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/ticket", name="ticket-")
*/
class TicketController extends AbstractController
{
    /**
     * @Route("/", name="list", methods={ "GET" })
     */
    public function list(): Response
    {
        return $this->render('ticket/list.html.twig', [
            'controller_name' => 'TicketController',
        ]);
    }

    /**
     * @Route("/add", name="add", methods={ "GET", "POST" })
     */
    public function add(Request $request): Response
    {
        $customer = new Customer();

        $form = $this->createForm(TicketType::class, $customer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('ticket-list');
        }

        return $this->render('ticket/add.html.twig', [
            'customer' => $customer,
            'form'     => $form->createView(),
        ]);
    }
}
