<?php

namespace App\Controller;
use App\Entity\Depot;
use App\Entity\Compte;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * @Route("/api",name="_api")
 */
class DepotController extends AbstractController
{
    /**
     * @Route("/depot", name="depot")
     */
    public function index()
    {
        return $this->render('depot/index.html.twig', [
            'controller_name' => 'DepotController',
        ]);
    }
    /**
     * @Route("/addDepot", name="add_depot", methods={"POST"})
     */
    public function addDepot(Request $request, EntityManagerInterface $entityManager,SerializerInterface $serializer, ValidatorInterface $validator)
        {
            $values = json_decode($request->getContent());
                $depot = new Depot();

                $depot->setDateDepot(new \Datetime());
                $depot->setMontantdepot($values->montantdepot);
                $compte = $this->getDoctrine()->getRepository(Compte::class)->find($values->compte_id);
                $compte->setSolde($compte->getSolde() + $values->montantdepot);
                $depot->setCompte($compte);
                $errors = $validator->validate($depot);
                    if(count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500, [
                'Content-Type' => 'application/json'
                ]);
                }
                $entityManager->persist($depot);
                $entityManager->flush();
                $data = [
                    'status' => 201,
                    'message' => 'Une depot a été faite'
                ];
    
                return new JsonResponse($data, 201);   
        }   
}
