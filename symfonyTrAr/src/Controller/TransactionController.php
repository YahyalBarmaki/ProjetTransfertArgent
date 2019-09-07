<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Tarif;
use App\Entity\Compte;
use App\Entity\Transaction;
use App\Form\TransactionType;
use App\Repository\UserRepository;
use App\Repository\CompteRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TransactionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api",name="api")
 */

class TransactionController extends AbstractController
{
    /**
     * @Route("/transaction", name="transaction")
     */
    public function index()
    {
        return $this->render('transaction/index.html.twig', [
            'controller_name' => 'TransactionController',
        ]);
    }
    /**
     * @Route("/envoi", name="envoi", methods={"POST"})
     */
    public function envoi(Request $request, EntityManagerInterface $entityManager){
            //******************************Instanciation de l'objet transaction**********************************************/
          $envoi = new Transaction();
          $form = $this->CreateForm(TransactionType::class,$envoi);
          $form-> handleRequest($request);
          $value = $request->request->all();
          $form->Submit($value);
          while(true){
              if (time() % 1 == 0) {
                  $rand = rand(100,100000);
                  break;
              }else
                {
                    slep(1);
                }
          }
          $envoi->setCode($rand);
          $envoi->setType("envoie");
          $envoi->setDateTr(new \Datetime());
          $envoi->setDateEnvoie(new \Datetime());
          //********Appelation d'un partenaire***********/

          $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id'=> $value['id']]);
          $envoi->setUser($user);
          //********Appelation d'un compte***********/
          $compte = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['numCompte'=> $value['compte']]);
          $envoi->setCompte($compte);
          //********Récupération du montant d'envoie *********** */
          $valeur = $form->get('montantTr')->getData();
          $tarif = $this->getDoctrine()->getRepository(Tarif::class)->findAll();

          foreach ($tarif as $value) {
              $value->getBorneInferieure();
              $value->getBorneSuperieure();
              $value->getValeur();

              if ($valeur >= $value->getBorneInferieure() && $valeur >= $value->getBorneSuperieure()) {
                  $com=$value->getValeur();
                  $envoi->setFraits($com);

                  $envoi->setComEtat(($com*30)/100);
                  $envoi->setComSys(($com*40)/100);
                  $envoi->setComEnv(($com*10)/100);
                  $envoi->setComRetr(($com*20)/100);


              }
              if ($compte->getSolde() > $envoi->getMontantTr()) {
                  $montantsold = $compte->getSolde() - ($envoi->getMontantTr() + $envoi->getComEnv());
                  
                  $compte->setSolde($montantsold);

                  $entityManager->persist($compte);
                  $entityManager->persist($envoi);
                  $entityManager->flush();

                  return new Response('Le transfert a été effectué avec succés. Voici le code : '.$envoi->getCode());
              }
              else{
    
                return new Response('Le solde de votre compte ne vous permet d effectuer une transaction');
            }
          }
    }
    /**
     * @Route("/retrait", name="retrait", methods={"POST"})
     */
    public function retrait(Request $request,EntityManagerInterface $entityManager)
        {
            $retrait = new Transaction();
            $form = $this->CreateForm(TransactionType::class,$retrait);
            $form -> handleRequest($request);
            $value = $request->request->all();
            $form->submit($value);
            $code = $form->get('code')->getData();
            $trouvCode = $this->getDoctrine()->getRepository(Transaction::class)->findOneBy(['code'=>$code]);

            if (!$trouvCode) {
                return new Response(
                    'Ce code n existe pas'
                );
            }
            elseif ($trouvCode->getCode() == $value['code']) {
                return new Response('Ce code est déjà retiré');
            }
            else {
                $trouvCode->setDateRetrait(new \Datetime());
                $trouvCode->setType("retrait");
                $entityManager->persist($trouvCode);
                $entityManager->flush();

                return new Response('retrait fait  ' . $trouvCode->getMontant());
            }

        }
}
