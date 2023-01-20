<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\TicketType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/", name="index", methods={ "GET" })
     */
    public function index(CustomerRepository $customerRepository): Response
    {
        $customers = $customerRepository->findAll();

        return $this->render('ticket/index.html.twig', [
            'customers' => $customers
        ]);
    }

    /**
     * @Route("/add", name="create", methods={ "GET", "POST" })
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $customer = new Customer();

        $form = $this->createForm(TicketType::class, $customer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($customer);
            $em->flush();

            $this->addFlash('sucess', 'Votre ticket a été envoyé avec succès');

            return $this->redirectToRoute('ticket-index');
        }

        return $this->render('ticket/create.html.twig', [
            'customer' => $customer,
            'form'     => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={ "GET" }, requirements={"id":"\d+"})
     */
    public function read(Customer $customer): Response
    {
        if(!$customer) {
            return $this->redirectToRoute('ticket-index');
        }

        return $this->render('ticket/read.html.twig', [
            'customer' => $customer
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", requirements={"id":"\d+"})
     */
    public function edit(EntityManagerInterface $em, Request $request, Customer $customer): Response
    {   
        $form = $this->createForm(TicketType::class, $customer);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $customer->setUpdatedAt(new \Datetime());

            $em->flush();

            $this->addFlash('info', "Le ticket a été mis à jour !");

            return $this->redirectToRoute('ticket-read', ['id' => $customer->getId()]);
        }

        return $this->render('/ticket/edit.html.twig', [
            'form'     => $form->createView(),
            'customer' => $customer
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", requirements={"id":"\d+"})
     */
    public function delete(Customer $customer, EntityManagerInterface $em): Response
    {
        $em->persist($customer);
        $em->remove($customer);
        $em->flush();

        $this->addFlash('info', 'Votre ticket a été supprimé');

        return $this->redirectToRoute('ticket-index');
    }
}
