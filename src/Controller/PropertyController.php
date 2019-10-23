<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Entity\Contact;
use App\Form\PropertySearchType;
use App\Form\ContactType;
use App\Repository\PropertyRepository;
use App\Notification\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;

use Knp\Component\Pager\PaginatorInterface;

class PropertyController extends AbstractController {

    public function __construct(PropertyRepository $repository, ObjectManager $em) {
            $this->repository = $repository;
            $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response {

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);



        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties'   => $this->repository->paginateAllVisible($search, $request->query->getInt('page', 1)),
            'form'         => $form->createView()
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show($slug, $id, Property $property, Request $request, ContactNotification $notification): Response {

        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', 'Votre email est bien envoyé');
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ]);
        }

        $property = $this->repository->find($id);


        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties',
            'form' => $form->createView()
        ]);

    }
};