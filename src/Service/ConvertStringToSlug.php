<?php


namespace App\Service;


class ConvertStringToSlug
{
    public function ConversionToSlug(string $slug): string
    {
        $aa = [" ", "?", "!","ś","ń","ć","ą","ó","ź","ż","ł","ę","Ó"];
        $bb = ["-", " ", " ","s","n","c","a","o","z","z","l","e","O"];
        $newSlug = str_replace($aa, $bb, $slug);


        return strtolower($newSlug);
    }
}
