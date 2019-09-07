<?php

namespace App\Controller;
use App\Entity\Depot;
use App\Entity\Compte;
use App\Form\CompeType;
use App\Form\DepotType;
use App\Controller\CompteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/api",name="_api")
 */
class DepotController extends AbstractController
{
 
    /**
     * @Route("/addDepot", name="add_depot", methods={"POST"})
     */
    public function addDepot(Request $request ,EntityManagerInterface $entityManager)
        {
            //******************************Instanciation de l'objet depot**********************************************/
            $depot = new Depot();
            $form = $this->CreateForm(DepotType::class,$depot);
            $form->handleRequest($request);
            $values = $request->request->all();
            $form->Submit($values);
            $depot->setDateDepot(new \Datetime());
            //******************************Récupération de l'identifiant compte**********************************************/
            $compte = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['numCompte' => $values['compte']]);
            if (!$compte) {
                throw $this->createNotFoundException(
                    'compte not found'
                );
            }
            $compte->setSolde($compte->getSolde() + $values['montant']);
            $depot->setCompte($compte);
            $depot->setMontantdepot($values['montant']);
            //******************************Enregistrement d'un depot**********************************************/
            $entityManager->persist($depot);
            $entityManager->flush();
            return new Response(
                "Le dépot a été bien effectue!"
            );
        }   
}