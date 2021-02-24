<?php

declare(strict_types=1);

namespace App\Service;


class ConvertStringToSlug
{
    public function ConversionToSlug(string $slug): string
    {
        $aa = [" ", "?", "!","ś","ń","ć","ą","ó","ź","ż","ł","ę","Ó","Ł","Ś","Ń","Ą","Ź","Ż"];
        $bb = ["-", "1", "1","s","n","c","a","o","z","z","l","e","o","l","s","n","a","z","z"];
        $newSlug = str_replace($aa, $bb, $slug);

        return strtolower($newSlug);
    }
}
