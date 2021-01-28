<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\PhotoToString;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileService
{
    /**
     * @var PhotoToString
     */
    private $photoToString;

    public function __construct(PhotoToString $photoToString)
    {
        $this->photoToString = $photoToString;
    }

    public function UploadFile($filename, $name, $directory_path): string
    {
        $uploadedFile = new UploadedFile($filename, $name);
        $newFileName = $this->photoToString->PhotoPostToString($uploadedFile);
        $uploadedFile->move($directory_path, $newFileName);

        return $newFileName;
    }

}