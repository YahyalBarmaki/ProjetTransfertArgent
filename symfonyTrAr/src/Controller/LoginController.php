<?php
namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException;
/**
 * @Route("/api")
 */
class LoginController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
     /**
     * @Route("/login", name="login", methods={"POST"})
     * @param Request $request
     * @param JWTEncoderInterface $JWTEncoder
     * @return JsonResponse
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
  
    public function token (Request $request,JWTEncoderInterface $JWTEncoder)
    {   
        $values = json_decode($request->getContent());
        $user = $this->getDoctrine()->getRepository(User::class)
                    ->findOneBy(['username'=>$values->username]);

        if (!$user) 
        {
            throw $this->createNotFoundException('Nom d\'Utilisateur incorrect');
        }
        $isValid = $this->passwordEncoder->isPasswordValid($user,$values->password);
        if (!$isValid) 
        {
            throw new BadCredentialsException();
        } 
        if ($user->getStatus()!=1) {
        return new JsonResponse("Vous etes bloqué");
        }
        $token = $JWTEncoder->encode([
            'username' => $user->getUsername(),
            'exp' => time() + 3600 // 1 hour expiration
        ]);

        return new JsonResponse(['token' => $token]);
        } 
    }

