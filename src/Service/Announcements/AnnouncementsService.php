<?php

declare(strict_types=1);

namespace App\Service\Announcements;

use App\Entity\Offer;
use App\Query\Announcements\AnnouncementsQuery;

class AnnouncementsService implements AnnouncementsInterface
{
    /**
     * @var AnnouncementsQuery
     */
    private $announcementsQuery;

    public function __construct(AnnouncementsQuery $announcementsQuery)
    {
        $this->announcementsQuery = $announcementsQuery;
    }

    public function removeOffer(Offer $offer): bool
    {
        try{
            if($this->announcementsQuery->removeOfferInDataBase($offer)){
                return true;
            }
            return false;
        }catch (\Exception $exception){

            return false;
        }
    }
}