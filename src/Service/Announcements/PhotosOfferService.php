<?php

declare(strict_types=1);

namespace App\Service\Announcements;


class PhotosOfferService
{
    public function downloadInfosOfPhotos($photo)
    {
        $name = $photo['name'];

//        $all_files = count($_FILES['files']['tmp_name']);
//        for ($i = 0; $i < $all_files; $i++) {
//            $photo['name'][$i] = $_FILES['files']['name'][$i];
//            $photo['tmp_name'][$i] = $_FILES['files']['tmp_name'][$i];
//            $photo['type'][$i] = $_FILES['files']['type'][$i];
//            $photo['size'][$i] = $_FILES['files']['size'][$i];
//
//        }

       $this->photos = $name;
    }

    private $photos;

    public function takePhotos()
    {
        return $this->photos;
    }
}
