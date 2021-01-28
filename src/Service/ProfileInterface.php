<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Form\FormInterface;

interface ProfileInterface
{
    public function answeredIntUserPost($userId): int;

    public function commentedIntUserAnswer($userId): int;

    public function answeredUserPost($user): array;

    public function commentedUserAnswer($user): array;

    public function editProfile(FormInterface $form, $user1, $photo): bool;

    public function editPassword(FormInterface $form, $user, $pass): bool;
}