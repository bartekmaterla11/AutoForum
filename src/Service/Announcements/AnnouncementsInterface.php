<?php

declare(strict_types=1);

namespace App\Service\Announcements;

use App\Entity\Offer;

interface AnnouncementsInterface
{
    public function removeOffer(Offer $offer): bool;
}