<?php

namespace App\Manager;

use App\Dto\RegisterDto;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager
{
    public function __construct(private readonly EntityManagerInterface $manager, private UserPasswordHasherInterface $passwordHasher)
    {}

    public function register(RegisterDto $registerDto): User
    {
        $user = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user, $registerDto->password);
        $user->setEmail($registerDto->email);
        $user->setLastName($registerDto->lastName);
        $user->setFirstName($registerDto->firstName);
        $user->setPassword($hashedPassword);
        $this->manager->persist($user);
        $this->manager->flush();
        return $user;
    }
}