<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Form\FormInterface;

interface RegistrationInterface
{
    public function registerUser(FormInterface $form, User $user): bool;

    public function RegisterError(): string;
}