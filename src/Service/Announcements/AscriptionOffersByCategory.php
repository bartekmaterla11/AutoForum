<?php

declare(strict_types=1);

namespace App\Service\Announcements;

use App\Entity\MainCategory;
use App\Entity\Offer;

class AscriptionOffersByCategory
{
    public function assigningOffersByCategory(MainCategory $categoria, $em, $filters): array
    {
        $repo = $em->getRepository(Offer::class);
        if ($categoria->getId() == 1 || $categoria->getId() == 2) {
            return $repo->findByCriteria($categoria->getId(), $filters);
        }
        if ($categoria->getId() == 3) {
            return $repo->findByChildVansTrucksCriteria1($categoria->getId(), $filters);
        }
        if ($categoria->getId() == 4) {
            return $repo->findByChildPartsCarsCriteria1($categoria->getId(), $filters);
        }
        if ($categoria->getId() == 5) {
            return $repo->findByChildPartsMotorsCriteria($categoria->getId(), $filters);
        }
        if ($categoria->getId() == 6) {
            return $repo->findByChildTiresCriteria1($categoria->getId(), $filters);
        }
        if ($categoria->getId() == 7) {
            return $repo->findByChildTrailersCriteria1($categoria->getId(), $filters);
        }
        if ($categoria->getId() == 8 || $categoria->getId() == 9) {
            return $repo->findByLatestCategories($categoria->getId(), $filters);
        }
        return array();
    }

    public function assigningOffersByCategoryChild($categoria, $childCat, $em, $filters): array
    {
        $repo = $em->getRepository(Offer::class);
        if ($categoria->getId() == 3) {
            return $repo->findByChildVansTrucksCriteria($childCat->getId(), $filters);
        }
        if ($categoria->getId() == 4) {
            return $repo->findByChildPartsCarsCriteria($childCat->getId(), $filters);
        }
        if ($categoria->getId() == 6) {
            return $repo->findByChildTiresCriteria($childCat->getId(), $filters);
        }
        if ($categoria->getId() == 7) {
            return $repo->findByChildTrailersCriteria($childCat->getId(), $filters);
        }
        return array();
    }
}
