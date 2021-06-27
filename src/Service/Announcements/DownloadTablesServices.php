<?php

declare(strict_types=1);

namespace App\Service\Announcements;

use App\Entity\CheckLikeOffer;
use App\Entity\Color;
use App\Entity\ConditionTechnical;
use App\Entity\Country;
use App\Entity\Fuel;
use App\Entity\Gearbox;
use App\Entity\Handlebar;
use App\Entity\InchTires;
use App\Entity\Location;
use App\Entity\MainCategory;
use App\Entity\MarkOfCars;
use App\Entity\MarkOfMotors;
use App\Entity\ModelOfCars;
use App\Entity\Overbody;
use App\Entity\ProfilTires;
use App\Entity\State;
use App\Entity\Template;
use App\Entity\TypeParts;
use App\Entity\TypeRims;
use App\Entity\TypeTires;
use App\Entity\VehicleType;
use App\Entity\WidthTires;

class DownloadTablesServices
{
    public function downloadTables($em): array
    {
        $datas = [];
        $datas['templates'] = $em->getRepository(Template::class)->findAll();
        $datas['categories'] = $em->getRepository(MainCategory::class)->findAll();
        $datas['categories1'] = $em->getRepository(MainCategory::class)->findAll();
        $datas['location'] = $em->getRepository(Location::class)->findAll();
        $datas['markCars'] = $em->getRepository(MarkOfCars::class)->findAll();
        $datas['markMotors'] = $em->getRepository(MarkOfMotors::class)->findAll();
        $datas['models'] = $em->getRepository(ModelOfCars::class)->findAll();
        $datas['fuel'] = $em->getRepository(Fuel::class)->findAll();
        $datas['color'] = $em->getRepository(Color::class)->findAll();
        $datas['body'] = $em->getRepository(Overbody::class)->findAll();
        $datas['gearbox'] = $em->getRepository(Gearbox::class)->findAll();
        $datas['handlebar'] = $em->getRepository(Handlebar::class)->findAll();
        $datas['condition'] = $em->getRepository(ConditionTechnical::class)->findAll();
        $datas['country'] = $em->getRepository(Country::class)->findAll();
        $datas['type'] = $em->getRepository(TypeParts::class)->findAll();
        $datas['state'] = $em->getRepository(State::class)->findAll();
        $datas['vehicleType'] = $em->getRepository(VehicleType::class)->findAll();
        $datas['inch'] = $em->getRepository(InchTires::class)->findAll();
        $datas['typeTires'] = $em->getRepository(TypeTires::class)->findAll();
        $datas['typeRims'] = $em->getRepository(TypeRims::class)->findAll();
        $datas['profilTires'] = $em->getRepository(ProfilTires::class)->findAll();
        $datas['widthTires'] = $em->getRepository(WidthTires::class)->findAll();
        $datas['check'] = $em->getRepository(CheckLikeOffer::class)->findAll();

        return $datas;
    }

    public function downloadForAddOffer($em): array
    {
        $datas = [];
        $datas['templates'] = $em->getRepository(Template::class)->findAll();
        $datas['categories'] = $em->getRepository(MainCategory::class)->findAll();
        $datas['models'] = $em->getRepository(ModelOfCars::class)->findAll();
        $datas['fuel'] = $em->getRepository(Fuel::class)->findAll();
        $datas['location'] = $em->getRepository(Location::class)->findAll();
        $datas['color'] = $em->getRepository(Color::class)->findAll();
        $datas['body'] = $em->getRepository(Overbody::class)->findAll();
        $datas['gearbox'] = $em->getRepository(Gearbox::class)->findAll();
        $datas['handlebar'] = $em->getRepository(Handlebar::class)->findAll();
        $datas['condition'] = $em->getRepository(ConditionTechnical::class)->findAll();
        $datas['country'] = $em->getRepository(Country::class)->findAll();
        $datas['type'] = $em->getRepository(TypeParts::class)->findAll();
        $datas['state'] = $em->getRepository(State::class)->findAll();
        $datas['vehicleType'] = $em->getRepository(VehicleType::class)->findAll();
        $datas['inch'] = $em->getRepository(InchTires::class)->findAll();
        $datas['typeTires'] = $em->getRepository(TypeTires::class)->findAll();
        $datas['typeRims'] = $em->getRepository(TypeRims::class)->findAll();
        $datas['profilTires'] = $em->getRepository(ProfilTires::class)->findAll();
        $datas['widthTires'] = $em->getRepository(WidthTires::class)->findAll();

        return $datas;
    }
}