<?php

namespace App\Controller;
use App\Entity\User;

use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/listeU", name="listeUser", methods={"GET"})
     */
    public function liste(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $listUser = $userRepository->findAll();
        $encoders = [new JsonEncoder()]; // If no need for XmlEncoder
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $jsonObject = $serializer->serialize($listUser, 'json', [
            'circular_reference_handler' => function ($listUser) {
                return $listUser->getId();
            }
        ]);
        return new Response($jsonObject, 200,
        ['Content-Type' => 'application/json']);
    }
    /**
     * @Route("/inscris", name="inscris", methods={"POST","GET"})
     */
    public function addUser(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager): Response
        {
            $user = new User();
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);
            $Values = $request->request->all();
            
            var_dump($Values);
            $form->submit($Values);
            $fileimg = $request->files->all()['imageName'];
            //var_dump($fileimg);die();
            $user->setPassword($passwordEncoder->encodePassword($user,
            $form->get('password')->getData()));
            $user->setImageFile($fileimg);
            $user->setRoles(['ROLE_CAISSIER']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $data = [
                'statut' => 201,
                'massage' => 'L"utilisateur été bien ajouté'
              ];
              return new JsonResponse($data, 201);
          
        }   
    }

