<?php

declare(strict_types=1);

namespace App\Service\Announcements;

use Symfony\Component\HttpFoundation\Request;

class ReceivFilteringDataService
{
    public function receivingFilteringData(Request $request): array
    {
        $filters = [];

        $location1 = 0;
        if ($request->get('location')) {
            $location1 = $request->get('location');
        }
        $filters['location'] = $location1;

        $mark1 = 0;
        if ($request->get('mark')) {
            $mark1 = (int)$request->get('mark');
        }
        $filters['mark'] = $mark1;

        $model1 = 0;
        if ($request->get('model')) {
            $model1 = (int)$request->get('model');
        }
        $filters['model'] = $model1;

        $priceF = 0;
        if($request->get('price_from')){
            $priceF = $request->get('price_from');
            $tekst_a = explode(' ', $priceF);
            $priceF = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $priceF .= trim($wyraz);
                $priceF = (int)trim($priceF);
            }
        }
        $filters['priceF'] = $priceF;

        $priceT = 99999999;
        if($request->get('price_to')){
            $priceT = $request->get('price_to');
            $tekst_a = explode(' ', $priceT);
            $priceT = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $priceT .= trim($wyraz);
                $priceT = (int)trim($priceT);
            }
        }
        $filters['priceT'] = $priceT;

        $yearF = 0;
        if($request->get('year_from')){
            $yearF = (int)$request->get('year_from');
        }
        $filters['yearF'] = $yearF;

        $yearT = 9999;
        if($request->get('year_to')){
            $yearT = (int)$request->get('year_to');
        }
        $filters['yearT'] = $yearT;

        $capF = 0;
        if($request->get('capacity_from')){
            $capF = $request->get('capacity_from');
            $tekst_a = explode(' ', $capF);
            $capF = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $capF .= trim($wyraz);
                $capF = (int)trim($capF);
            }
        }
        $filters['capF'] = $capF;

        $capT = 999999;
        if($request->get('capacity_to')){
            $capT = $request->get('capacity_to');
            $tekst_a = explode(' ', $capT);
            $capT = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $capT .= trim($wyraz);
                $capT = (int)trim($capT);
            }
        }
        $filters['capT'] = $capT;

        $milF = 0;
        if($request->get('mileage_from')){
            $milF = $request->get('mileage_from');
            $tekst_a = explode(' ', $milF);
            $milF = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $milF .= trim($wyraz);
                $milF = (int)trim($milF);
            }
        }
        $filters['milF'] = $milF;

        $milT = 99999999;
        if($request->get('mileage_to')){
            $milT = $request->get('mileage_to');
            $tekst_a = explode(' ', $milT);
            $milT = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $milT .= trim($wyraz);
                $milT = (int)trim($milT);
            }
        }
        $filters['milT'] = $milT;

        $powF = 0;
        if($request->get('power_from')){
            $powF = (int)$request->get('power_from');
        }
        $filters['powF'] = $powF;

        $powT = 99999;
        if($request->get('power_to')){
            $powT = (int)$request->get('power_to');
        }
        $filters['powT'] = $powT;

        $fuel = 0;
        if ($request->get('fuel')) {
            $fuel = (int)$request->get('fuel');
        }
        $filters['fuel'] = $fuel;

        $gearbox = 0;
        if ($request->get('gearbox')) {
            $gearbox = (int)$request->get('gearbox');
        }
        $filters['gearbox'] = $gearbox;

        $body = 0;
        if ($request->get('body')) {
            $body = (int)$request->get('body');
        }
        $filters['body'] = $body;

        $country = 0;
        if ($request->get('country')) {
            $country = (int)$request->get('country');
        }
        $filters['country'] = $country;

        $handlebar = 0;
        if ($request->get('handlebar')) {
            $handlebar = (int)$request->get('handlebar');
        }
        $filters['handlebar'] = $handlebar;

        $color = 0;
        if ($request->get('color')) {
            $color = (int)$request->get('color');
        }
        $filters['color'] = $color;

        $condition = 0;
        if ($request->get('condition')) {
            $condition = (int)$request->get('condition');
        }
        $filters['condition'] = $condition;

        $childCat = 0;
        if($request->get('category')){
            $childCat = (int)$request->get('category');
        }
        $filters['childCat'] = $childCat;

        $markMotors = 0;
        if($request->get('mark_motors')){
            $markMotors = (int)$request->get('mark_motors');
        }
        $filters['markMotors'] = $markMotors;

        $typeParts = 0;
        if ($request->get('type')) {
            $typeParts = (int)$request->get('type');
        }
        $filters['typeParts'] = $typeParts;

        $state = 0;
        if ($request->get('state')) {
            $state = (int)$request->get('state');
        }
        $filters['state'] = $state;

        $vehicleType = 0;
        if ($request->get('vehicle')) {
            $vehicleType = $request->get('vehicle');
        }
        $filters['vehicleType'] = $vehicleType;

        $typeTires = 0;
        if ($request->get('type-tires')) {
            $typeTires = $request->get('type-tires');
        }
        $filters['typeTires'] = $typeTires;

        $inch = 0;
        if ($request->get('inch')) {
            $inch = $request->get('inch');
        }
        $filters['inch'] = $inch;

        $widthTires = 0;
        if ($request->get('width-tires')) {
            $widthTires = $request->get('width-tires');
        }
        $filters['widthTires'] = $widthTires;

        $profilTires = 0;
        if ($request->get('profil-tires')) {
            $profilTires = $request->get('profil-tires');
        }
        $filters['profilTires'] = $profilTires;

        $typeRims = 0;
        if ($request->get('type-rims')) {
            $typeTires = $request->get('type-rims');
        }
        $filters['typeRims'] = $typeTires;

        return $filters;
    }

    public function receivingFilteringChildData(Request $request): array
    {
        $filters = [];

        $location1 = 0;
        if ($request->get('location')) {
            $location1 = $request->get('location');
        }
        $filters['location'] = $location1;

        $mark1 = 0;
        if ($request->get('mark')) {
            $mark1 = (int)$request->get('mark');
        }
        $filters['markVT'] = $mark1;

        $priceF = 0;
        if($request->get('price_from')){
            $priceF = $request->get('price_from');
            $tekst_a = explode(' ', $priceF);
            $priceF = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $priceF .= trim($wyraz);
                $priceF = (int)trim($priceF);
            }
        }
        $filters['priceF'] = $priceF;

        $priceT = 99999999;
        if($request->get('price_to')){
            $priceT = $request->get('price_to');
            $tekst_a = explode(' ', $priceT);
            $priceT = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $priceT .= trim($wyraz);
                $priceT = (int)trim($priceT);
            }
        }
        $filters['priceT'] = $priceT;

        $yearF = 0;
        if($request->get('year_from')){
            $yearF = (int)$request->get('year_from');
        }
        $filters['yearF'] = $yearF;

        $yearT = 9999;
        if($request->get('year_to')){
            $yearT = (int)$request->get('year_to');
        }
        $filters['yearT'] = $yearT;

        $capF = 0;
        if($request->get('capacity_from')){
            $capF = $request->get('capacity_from');
            $tekst_a = explode(' ', $capF);
            $capF = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $capF .= trim($wyraz);
                $capF = (int)trim($capF);
            }
        }
        $filters['capF'] = $capF;

        $capT = 999999;
        if($request->get('capacity_to')){
            $capT = $request->get('capacity_to');
            $tekst_a = explode(' ', $capT);
            $capT = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $capT .= trim($wyraz);
                $capT = (int)trim($capT);
            }
        }
        $filters['capT'] = $capT;

        $milF = 0;
        if($request->get('mileage_from')){
            $milF = $request->get('mileage_from');
            $tekst_a = explode(' ', $milF);
            $milF = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $milF .= trim($wyraz);
                $milF = (int)trim($milF);
            }
        }
        $filters['milF'] = $milF;

        $milT = 99999999;
        if($request->get('mileage_to')){
            $milT = $request->get('mileage_to');
            $tekst_a = explode(' ', $milT);
            $milT = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $milT .= trim($wyraz);
                $milT = (int)trim($milT);
            }
        }
        $filters['milT'] = $milT;

        $powF = 0;
        if($request->get('power_from')){
            $powF = (int)$request->get('power_from');
        }
        $filters['powF'] = $powF;

        $powT = 99999;
        if($request->get('power_to')){
            $powT = (int)$request->get('power_to');
        }
        $filters['powT'] = $powT;

        $fuel = 0;
        if ($request->get('fuel')) {
            $fuel = (int)$request->get('fuel');
        }
        $filters['fuel'] = $fuel;

        $sizeF = 0;
        if($request->get('size_from')){
            $sizeF = $request->get('size_from');
            $tekst_a = explode(' ', $sizeF);
            $sizeF = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $sizeF .= trim($wyraz);
                $sizeF = (int)trim($sizeF);
            }
        }
        $filters['sizeF'] = $sizeF;

        $sizeT = 9999999;
        if($request->get('size_to')){
            $sizeT = $request->get('size_to');
            $tekst_a = explode(' ', $sizeT);
            $sizeT = '';
            if (count($tekst_a) > 0)
            {
                foreach ($tekst_a as $wyraz)
                    $sizeT .= trim($wyraz);
                $sizeT = (int)trim($sizeT);
            }
        }
        $filters['sizeT'] = $sizeT;

        $axisF = 0;
        if($request->get('axis_from')){
            $axisF = (int)$request->get('axis_from');
        }
        $filters['axisF'] = $axisF;

        $axisT = 999;
        if($request->get('axis_to')){
            $axisT = (int)$request->get('axis_to');
        }
        $filters['axisT'] = $axisT;

        $gearbox = 0;
        if ($request->get('gearbox')) {
            $gearbox = (int)$request->get('gearbox');
        }
        $filters['gearbox'] = $gearbox;

        $country = 0;
        if ($request->get('country')) {
            $country = (int)$request->get('country');
        }
        $filters['country'] = $country;

        $condition = 0;
        if ($request->get('condition')) {
            $condition = (int)$request->get('condition');
        }
        $filters['condition'] = $condition;

        $typeParts = 0;
        if ($request->get('type')) {
            $typeParts = (int)$request->get('type');
        }
        $filters['typeParts'] = $typeParts;

        $state = 0;
        if ($request->get('state')) {
            $state = (int)$request->get('state');
        }
        $filters['state'] = $state;

        $vehicleType = 0;
        if ($request->get('vehicle')) {
            $vehicleType = $request->get('vehicle');
        }
        $filters['vehicleType'] = $vehicleType;

        $typeTires = 0;
        if ($request->get('type-tires')) {
            $typeTires = $request->get('type-tires');
        }
        $filters['typeTires'] = $typeTires;

        $inch = 0;
        if ($request->get('inch')) {
            $inch = $request->get('inch');
        }
        $filters['inch'] = $inch;

        $widthTires = 0;
        if ($request->get('width-tires')) {
            $widthTires = $request->get('width-tires');
        }
        $filters['widthTires'] = $widthTires;

        $profilTires = 0;
        if ($request->get('profil-tires')) {
            $profilTires = $request->get('profil-tires');
        }
        $filters['profilTires'] = $profilTires;

        $typeRims = 0;
        if ($request->get('type-rims')) {
            $typeTires = $request->get('type-rims');
        }
        $filters['typeRims'] = $typeTires;

        return $filters;
    }
}