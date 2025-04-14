<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/users')]
class UserController extends AbstractController
{
    #[Route('/me', name: 'user', methods: ['GET'])]
    public function index(): Response
    {
        return $this->json("me", Response::HTTP_OK);
    }
}
