<?php

declare(strict_types=1);

namespace App\Service\Announcements;

use App\Entity\TypeParts;

class SelectByTypeParts
{
    public function findTypePartsByCategory($categoria, $em): array
    {
        if ($categoria->getId() == 4) {
            $belong = 1;
            return $em->getRepository(TypeParts::class)->findByBelong($belong);
        }
        if ($categoria->getId() == 5) {
            $belong = 2;
            return $em->getRepository(TypeParts::class)->findByBelong($belong);
        }
        return array();
    }
}