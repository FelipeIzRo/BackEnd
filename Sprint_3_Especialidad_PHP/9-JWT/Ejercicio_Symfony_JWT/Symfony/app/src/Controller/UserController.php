<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserController extends AbstractController
{
    private $userProvider;
    private $passwordHasher;
    private $entityManager;
    private $JWTTokenManager;

    public function __construct(
        UserProviderInterface $userProvider, 
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        JWTTokenManagerInterface $JWTTokenManager)
    {
        $this->userProvider = $userProvider;
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
        $this->JWTTokenManager = $JWTTokenManager;
    }

    public function register(Request $request)
    {
        $user = new User();

        $user->setEmail($request->get('email'));
        $user->setPassword($this->passwordHasher->hashPassword($user, $request->get('password')));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $token = $this->JWTTokenManager->create($user);

        return $this->json(['message' => 'Usuario creado con exito','token' => $token], Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $user = $this->userProvider->loadUserByIdentifier($request->get('email'));

        if(!$user || !$this->passwordHasher->isPasswordValid($user,$request->get('password')))
        {
            return $this->json(['message' => 'Credenciales incorrectos'],Response::HTTP_BAD_REQUEST);
        }

        $token = $this->JWTTokenManager->create($user);

        return $this->json(['token' => $token]);
    }
}
