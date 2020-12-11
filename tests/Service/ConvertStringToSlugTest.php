<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\ConvertStringToSlug;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ConvertStringToSlugTest extends TestCase
{

    public function testCreateSlugWhenPolishLetter()
    {
        $service = new ConvertStringToSlug();

        $result = $service->ConversionToSlug('płyn chłodniczy');

        $this->assertEquals('plyn-chlodniczy',$result);
    }

    public function testCreateSlugWhenUpperTLetter()
    {
        $service = new ConvertStringToSlug();
        $result = $service->ConversionToSlug('SKrzynia BIEGÓW');

        $this->assertEquals('skrzynia-biegow',$result);
        $this->assertContains('nia', $result);
        $this->assertContains('sk', $result);
    }
}