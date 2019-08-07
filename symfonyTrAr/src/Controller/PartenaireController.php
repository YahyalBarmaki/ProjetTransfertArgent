<?php

namespace App\Controller;
use App\Entity\Partenaire;
use App\Entity\User;
use App\Entity\Compte;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
/**
 * @Route("/api",name="_api")
 */

class PartenaireController extends AbstractController
{   
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
        {
            $this->encoder = $encoder;
        }

    /**
     * @Route("/partenaire", name="partenaire")
     */
    public function index()
    {
        return $this->render('partenaire/index.html.twig', [
            'controller_name' => 'PartenaireController',
        ]);
    }
    /**
     * @Route("/addpart", name="addPartenaire")
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function ajoutP(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer,ValidatorInterface $validator)
        {
            $values = json_decode($request->getContent());      
            $partenaire = new Partenaire();
                $partenaire->setNomEntreprise($values->nomEntreprise);
                $entrp=$values->nomEntreprise;
                $partenaire->setNinea($values->ninea);
                $partenaire->setTel($values->tel);
                $partenaire->setAdresse($values->adresse);
                $partenaire->setEmail($values->email);
            $user = new User();
                $user->setUsername($values->username);
                $user->setRoles(["ROLE_PARTENAIRE"]);
                $password = $this->encoder->encodePassword($user,$values->password);
                $user->setPassword($password);
                $user->setNom($values->nom);
                $user->setPrenom($values->prenom);
                $user->setTeluser($values->teluser); 
                $user->setStatus($values->status);
            $cpt = new Compte();
            $recup = substr($entrp,0,2);  
            while (true) {
                if (time() % 1 == 0) {
                    $alea = rand(100,200);
                    break;
                }else {
                    slep(1);
                }
            }
            $concat =$recup.$alea;
            $cpt->setNumCompte($concat);
            $cpt->setPartenaire($partenaire);
               // relates this user to the partenaire   
            $user->getPartenaire($partenaire);
            
            if ($partenaire) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($partenaire);
                $entityManager->persist($user);
                $entityManager->persist($cpt);  
                $entityManager->flush(); 
            }
                      

        return new Response(
            "L'enregistrement a été bien effectue!"
        );     
        }

}
