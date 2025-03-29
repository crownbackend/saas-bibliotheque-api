<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController
{
    public function __construct(private UserRepository $userRepository, private UserPasswordHasherInterface $passwordHasher,
                                private JWTTokenManagerInterface $JWTTokenManager)
    {
    }

    #[Route('/api/login', name: 'api_security_login', methods: 'POST')]
    public function login(Request $request): JsonResponse
    {
        $data = $request->request->all();
        $user = $this->userRepository->findOneBy(['email' => $data['username']]);
        if (!$user) {
            return $this->json('error not user', 400);
        }
        $passwordCheck = $this->passwordHasher->isPasswordValid($user, $data['password']);
        if (!$passwordCheck) {
            return $this->json('error not user', 400);
        }
        if (!$user->isIsActif()) {
            return $this->json('error account not valid', 400);
        }
        $token = $this->JWTTokenManager->create($user);
        $response = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'token' => $token,
        ];

        return $this->json($response, 201);
    }
}