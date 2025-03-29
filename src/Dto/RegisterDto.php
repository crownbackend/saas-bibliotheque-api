<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'L\'email est obligatoire')]
        #[Assert\Email(message: 'L\'email n\'est pas valide')]
        public string $email,
        #[Assert\NotBlank(message: 'Le mot de passe est obligatoire')]
        #[Assert\Length(min: 4, minMessage: 'Mot de passe trop court')]
        public string $password,
        #[Assert\NotBlank(message: 'Le prénom est obligatoire')]
        #[Assert\Length(
            min: 2,
            max: 50,
            minMessage: 'Le nom doit faire au moins 2 caractères',
            maxMessage: 'Le nom ne peut pas dépasser 50 caractères'
        )]
        public string $firstName,
        #[Assert\NotBlank(message: 'Le prénom est obligatoire')]
        #[Assert\Length(
            min: 2,
            max: 50,
            minMessage: 'Le prénom doit faire au moins 2 caractères',
            maxMessage: 'Le prénom ne peut pas dépasser 50 caractères'
        )]
        public string $lastName,
    )
    {}
}