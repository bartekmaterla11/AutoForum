<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Writer\RegistrationWriter;
use Symfony\Component\Form\FormInterface;

class RegistrationService implements RegistrationInterface
{
    /**
     * @var RegistrationWriter
     */
    private $registrationWriter;

    public function __construct(RegistrationWriter $registrationWriter)
    {
        $this->registrationWriter = $registrationWriter;
    }

    public function registerUser(FormInterface $form, User $user): bool
    {
        try {
            $this->registrationWriter->addUserToDataBase($form,$user);
            return true;
        }catch (\Exception $exception){
            return false;
        }
    }
}
