<?php


namespace App\Service;


class ConvertStringToSlug
{
    public function ConversionToSlug(string $slug): string
    {
        $lowerSlug = strtolower($slug);
        $aa = [" ", "?", "!","ś","ń","ć","ą","ó","ź","ż","ł","ę"];
        $bb = ["-", " ", " ","s","n","c","a","o","z","z","l","e"];
        $newSlug = str_replace($aa, $bb, $lowerSlug);

        return $newSlug;
    }

}