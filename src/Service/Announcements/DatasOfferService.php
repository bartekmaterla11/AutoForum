<?php

declare(strict_types=1);

namespace App\Service\Announcements;

use App\Entity\Attribute;
use App\Entity\AttributeValue;
use App\Entity\MainCategory;
use App\Entity\Offer;
use App\Entity\PhotoFilesForOffer;
use App\Entity\Template;
use App\Service\ConvertStringToSlug;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DatasOfferService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ConvertStringToSlug
     */
    private $stringToSlug;
    /**
     * @var PhotosOfferService
     */
    private PhotosOfferService $offerService;

    public function __construct(EntityManagerInterface $entityManager, ConvertStringToSlug $stringToSlug, PhotosOfferService $offerService)
    {
        $this->entityManager = $entityManager;
        $this->stringToSlug = $stringToSlug;
        $this->offerService = $offerService;
    }

    public function addDatasOffer(array $datas, $user): bool
    {
        $em = $this->entityManager;
        $categoryId = $datas['category'];

        $template = $em->getRepository(Template::class)->find($categoryId);
        $category = $em->getRepository(MainCategory::class)->find($categoryId);

        $attributesList = $em->getRepository(Attribute::class)->findby(['name' => array_keys($datas)]);

        $attrbyName = $this->getAttributeByName($attributesList);

        $newOffer = new Offer();
        $newOffer->setTemplate($template);
        $newOffer->setCategory($category);
        $newOffer->setTitle($datas['title']);
        $newOffer->setSlug($this->stringToSlug->ConversionToSlug($datas['title']));
        $newOffer->setUser($user);
        $newOffer->setUploadedAt(new \DateTime());
        
//        $photos = $this->offerService->takePhotos();
//        \Symfony\Component\VarDumper\VarDumper::dump($photos);
//        die('end');

        foreach ($datas as $key => $data) {
            if (isset($attrbyName[$key])) {
                $attributeValue = new AttributeValue();
                $attributeValue->setAttribute($attrbyName[$key]);
                $attributeValue->setValue($data);

                $em->persist($attributeValue);
                $newOffer->addAttributeValue($attributeValue);
            }
        }

        $em->persist($newOffer);
        $em->flush();

        return true;

    }

    private function getAttributeByName($attributesListIds): array
    {
        $attByName = [] ;
        /**
         * 'mark' => new Attribute()['id =2, name=mark, orginalName=>Marka']
         * 'year' => new Attribute()['id =4, name=yesr, orginalName=>Rok']
         */

        foreach ($attributesListIds as $attributesListId) {
            $attByName[$attributesListId->getName()] = $attributesListId;

        }

        return $attByName;
    }
}
