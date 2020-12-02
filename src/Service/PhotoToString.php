<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class PhotoToString
{
    /** @var UploadedFile $pictureFileName */
    public function PhotoPostToString($pictureFileName): string
    {
        $originalfileName = pathinfo($pictureFileName->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFileName = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalfileName);
        $newFileName = $safeFileName . '-' . uniqid() . '.' . $pictureFileName->guessExtension();

        return $newFileName;
    }
}