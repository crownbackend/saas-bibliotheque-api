<?php

namespace App\Controller;

use App\Dto\RegisterDto;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/users', name: 'api_users_')]
final class RegisterController extends AbstractController{
    public function __construct(private UserManager $userManager)
    {
    }

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function index(
        #[MapRequestPayload(
            validationFailedStatusCode: Response::HTTP_BAD_REQUEST
        )] RegisterDto $registerDto,
    ): Response
    {
        $user = $this->userManager->register($registerDto);
        return $this->json($user, Response::HTTP_CREATED);
    }
}
