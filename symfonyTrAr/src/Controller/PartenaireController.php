<?php

namespace App\Controller;
use App\Entity\Partenaire;
use App\Entity\User;
use App\Entity\Compte;

use App\Form\UserType;
use App\Form\DepotType;
use App\Form\PartenaireType;
use App\Form\CompeType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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
     * @Route("/partenaire", name="partenaire", methods={"POST"})
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
    public function ajoutP(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
        {
            //******************************Instanciation de l'objet partenaire**********************************************/
            $partenaire = new Partenaire();
            $form1 = $this->CreateForm(PartenaireType::class,$partenaire);
            $form1->handleRequest($request);
            $values1 = $request->request->all();
            $form1->Submit($values1);
            //******************************Instanciation de l'objet user**********************************************/
            $user = new User();
            $form2 = $this->CreateForm(UserType::class,$user);
            $form2->handleRequest($request);
            $values2 = $request->request->all();
            $form2->Submit($values2);
            $fileimg = $request->files->all()['imageName'];
            
            $user->setRoles(["ROLE_ADMIN_PARTENAIRE"]);
            $user->setImageFile($fileimg);

            $user->setPassword($passwordEncoder->encodePassword($user,$form2->get('password')->getData()));
            //******************************Instanciation de l'objet compte**********************************************/
            $cpt = new Compte();
            $form3 = $this->CreateForm(CompeType::class,$cpt);
            $form3->handleRequest($request);
            $values3 = $request->request->all();
            $form3->Submit($values3);
            $entrp=$partenaire->getNomEntreprise();
            
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
            //******************************Relation entre partenaire et compte**********************************************/
            $cpt->setPartenaire($partenaire);
            //******************************Relation entre partenaire et utilisateur**********************************************/               
            $user->getPartenaire($partenaire);
            //******************************Insertion de partenaire, de compte et d'utilisateur**********************************************/
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
