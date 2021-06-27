<?php

namespace App\Controller\Announcements;

use App\Entity\Offer;
use App\Entity\PhotoFilesForOffer;
use App\Query\Announcements\ModelsForCarsQuery;
use App\Service\Announcements\DatasOfferService;
use App\Service\Announcements\PhotosOfferService;
use App\Service\UploadFileService;
use App\Writer\Announcements\OffersLikeWriter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JavaScriptAnnouncementController extends AbstractController
{
    /**
     * @var DatasOfferService
     */
    private DatasOfferService $dataService;
    /**
     * @var UploadFileService
     */
    private UploadFileService $fileService;
    /**
     * @var ModelsForCarsQuery
     */
    private ModelsForCarsQuery $modelsForCars;
    /**
     * @var OffersLikeWriter
     */
    private OffersLikeWriter $likeWriter;
    /**
     * @var PhotosOfferService
     */
    private PhotosOfferService $offerService;

    public function __construct(OffersLikeWriter $likeWriter, DatasOfferService $dataService, UploadFileService $fileService,
                                ModelsForCarsQuery $modelsForCars, PhotosOfferService $offerService)
    {
        $this->dataService = $dataService;
        $this->fileService = $fileService;
        $this->modelsForCars = $modelsForCars;
        $this->likeWriter = $likeWriter;
        $this->offerService = $offerService;
    }

    /**
     * @Route("/ajax/set-models", name="set_models")
     */
    public function setModelsOfCars(Request $request)
    {
        $array = $this->modelsForCars->queryForModelOfCars($request->get('id'));

        return $this->json(['array' => $array]);
    }

    /**
     * @Route("/ajax/set-mark-vans-trucks", name="set_mark_vans_trucks")
     */
    public function setMarkOfvansTrucks(Request $request)
    {
        $array = $this->modelsForCars->queryForMarkVanstrucks($request->get('id'));

        return $this->json(['array' => $array]);
    }

    /**
     * @Route("/ajax/set-type-parts", name="set_type_parts")
     */
    public function setTypeParts(Request $request)
    {
        $array = $this->modelsForCars->queryForTypeParts($request->get('id'));

        return $this->json(['array' => $array]);
    }

    /**
     * @Route("/ajax/set-like-offer", name="set_like_offer")
     */
    public function setLikeOffer(Request $request)
    {
        if ($this->likeWriter->addLikeToDataBase($this->getUser()->getId(), (int)$request->get('offerid'))) {
            return $this->json(['Success' => 'OK']);
        }
        return $this->json(['Error' => 'False']);
    }

    /**
     * @Route("/ajax/set-unlike-offer", name="set_unlike_offer")
     */
    public function setUnlikeOffer(Request $request)
    {
        if ($this->likeWriter->removeLikeInDataBase($this->getUser()->getId(), (int)$request->get('offerid'))) {
            return $this->json(['Success' => 'OK']);
        }
        return $this->json(['Error' => 'False']);
    }

    /**
     * @Route("/ajax/photos-offer", name="photos_offer")
     * @param Request $request
     */
    public function photosForOffer(Request $request)
    {
        print_r($_FILES);

        if (isset($_FILES['files'])) {
            $this->offerService->downloadInfosOfPhotos($_FILES['files']);
//            $all_files = count($_FILES['files']['tmp_name']);

//            for ($i = 0; $i < $all_files; $i++) {
//                $file_name = $_FILES['files']['name'][$i];
//                $file_tmp = $_FILES['files']['tmp_name'][$i];
//                $file_type = $_FILES['files']['type'][$i];
//                $file_size = $_FILES['files']['size'][$i];
//
//                $file = $path . $file_name;
//
//                if ($file_size > 2097152) {
//                    $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
//                }
//
//                if (empty($errors)) {
//                    move_uploaded_file($file_tmp, $file);
//                }
//            }

//            if ($errors) print_r($errors);
//        $files = $request->get('photo');
//        \Symfony\Component\VarDumper\VarDumper::dump($files);
//        die('end');
//
//        if ($files) {
//            $photos = new PhotoFilesForOffer();
//            $filename = uniqid().".".$files->getClientOriginalExtension();
//            $path = 'images/offers';
//            $files->move($path,$filename);
//
////                $uploadedFile = new UploadedFile($item, $item);
////                $uploadedFile->move('images/offers', $item);
////                move_uploaded_file($path, "offers/$item");
////                @chmod($item, 0666 & ~umask());
////                \Symfony\Component\VarDumper\VarDumper::dump($path);
////                die('end');
//            $photos->setOffer($newOffer);
//            $photos->setFilename($files->getClientOriginalExtension());
//            $em->persist($photos);
//            $newOffer->addPhotoFilesForOffer($files);
//
//            $em->persist($newOffer);
//            $em->flush();
//
//            return $this->json(['Message1' => 'Galeria została dodana']);
//        }
//        return false;
        }
        return $this->json(['Message1' => 'Galeria została dodana']);
    }

    /**
     * @Route("/data-cars/ajax", name="data_cars")
     * @param Request $request
     */
    public function dataCars(Request $request)
    {
        $datas = [];

        $title = $request->get('title');
        if (empty($title)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać tytułu']);
        }
        $category = $request->get('category');
        $mark = $request->get('mark');
        if ($mark === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać marki pojazdu']);
        }
        $price = $request->get('price');
        if (empty($price)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ceny']);
        }
        $model = $request->get('model');
        if ($model === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać modelu']);
        }
        $year = $request->get('year');
        if (empty($year)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać roku produkcji']);
        }
        $fuel = (int)$request->get('fuel');
        if ($fuel === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać rodzaju paliwa']);
        }
        $mil = $request->get('mileage');
        if (empty($mil)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać przebiegu']);
        }
        $color = (int)$request->get('color');
        if ($color === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać koloru']);
        }
        $body = (int)$request->get('body');
        if ($body === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać typu nadwozia']);
        }
        $con = (int)$request->get('condition');
        if ($con === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu technicznego']);
        }
        $gearbox = (int)$request->get('gearbox');
        if ($gearbox === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać skrzyni biegów']);
        }
        $description = $request->get('description');
        if (empty($description)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
        }
        $location = (int)$request->get('location');
        if ($location === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
        }
        $locationName = $request->get('locationname');
        if (empty($locationName)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
        }
        $number = $request->get('number');
        if (empty($number)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
        }
        $negotiation = $request->get('negotiation');

        $datas['title'] = $title;
        $datas['category'] = $category;
        $tekst_a = explode(' ', $price);
        $price = '';
        if (count($tekst_a) > 0)
        {
            foreach ($tekst_a as $wyraz)
                $price .= trim($wyraz);
            $price = trim($price);
        }
        $datas['price'] = $price;
        $datas['mark'] = (string)$mark;
        $datas['model'] = (string)$model;
        $datas['year'] = $year;
        $cap = $request->get('capacity');
        if (!empty($cap)) {
            $tekst_c = explode(' ', $cap);
            $cap = '';
            if (count($tekst_c) > 0)
            {
                foreach ($tekst_c as $wyraz)
                    $cap .= trim($wyraz);
                $cap = trim($cap);
            }
            $datas['capacity'] = $cap;
        }
        $power = $request->get('power');
        if (!empty($power)) {

            $datas['power'] = $power;
        }
        $datas['fuel'] = (string)$fuel;
        $tekst_d = explode(' ', $mil);
        $mil = '';
        if (count($tekst_d) > 0)
        {
            foreach ($tekst_d as $wyraz)
                $mil .= trim($wyraz);
            $mil = trim($mil);
        }
        $datas['mileage'] = $mil;
        $datas['color'] = (string)$color;
        $datas['body'] = (string)$body;
        $datas['condition'] = (string)$con;
        $datas['gearbox'] = (string)$gearbox;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $tekst_b = explode(' ', $number);
        $number = '';
        if (count($tekst_b) > 0)
        {
            foreach ($tekst_b as $wyraz)
                $number .= trim($wyraz);
            $number = trim($number);
        }
        $datas['number'] = $number;
        $datas['negotiation'] = (string)$negotiation;


        $country = (int)$request->get('country');
        if ($country != 0) {

            $datas['country'] = (string)$country;
        }
        $handlebar = (int)$request->get('handlebar');
        if ($handlebar != 0) {

            $datas['handlebar'] = (string)$handlebar;
        }

        if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

//            $this->addFlash('success_announ','Ogłoszenie zostało dodane');
//            return $this->redirectToRoute('announcement',['page'=>1]);
            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;

    }

    /**
     * @Route("/data-motors/ajax", name="data_motors")
     * @param Request $request
     */
    public function dataMotors(Request $request)
    {
        $title = $request->get('title');
        if (empty($title)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać tytułu']);
        }
        $category = $request->get('category');
        $underCat = $request->get('underCat');
        $price = $request->get('price');
        if (empty($price)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ceny']);
        }
        $mark = (int)$request->get('mark');
        if ($mark === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać marki pojazdu']);
        }
        $year = $request->get('year');
        if (empty($year)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać roku produkcji']);
        }
        $con = (int)$request->get('condition');
        if ($con == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu technicznego']);
        }
        $description = $request->get('description');
        if (empty($description)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
        }
        $location = (int)$request->get('location');
        if ($location == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
        }
        $locationName = $request->get('locationname');
        if (empty($locationName)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
        }
        $number = $request->get('number');
        if (empty($number)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
        }
        $negotiation = $request->get('negotiation');

        $datas['title'] = $title;
        $datas['category'] = $category;
        $tekst_a = explode(' ', $price);
        $price = '';
        if (count($tekst_a) > 0) {
            foreach ($tekst_a as $wyraz)
                $price .= trim($wyraz);
            $price = trim($price);
        }
        $datas['price'] = $price;
        $datas['markMotors'] = (string)$mark;
        $datas['year'] = $year;
        $cap = $request->get('capacity');
        if (!empty($cap)) {
            $tekst_c = explode(' ', $cap);
            $cap = '';
            if (count($tekst_c) > 0)
            {
                foreach ($tekst_c as $wyraz)
                    $cap .= trim($wyraz);
                $cap = trim($cap);
            }
            $datas['capacity'] = $cap;
        }
        $datas['condition'] = (string)$con;
        $country = (int)$request->get('country');
        if ($country == 0) {
            $datas['country'] = (string)$country;
        }
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $tekst_b = explode(' ', $number);
        $number = '';
        if (count($tekst_b) > 0)
        {
            foreach ($tekst_b as $wyraz)
                $number .= trim($wyraz);
            $number = trim($number);
        }
        $datas['number'] = $number;
        $datas['underCategory'] = $underCat;
        $datas['negotiation'] = (string)$negotiation;


        if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;
    }

    /**
     * @Route("/data-vans-and-trucks/ajax", name="data_vans_and_trucks")
     * @param Request $request
     */
    public function dataVansAndTrucks(Request $request)
    {
        $datas = [];

        $title = $request->get('title');
        if (empty($title)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać tytułu']);
        }
        $category = $request->get('category');
        $underCat = $request->get('underCat');
        $mark = $request->get('mark');
        if ($mark === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać marki pojazdu']);
        }
        $price = $request->get('price');
        if (empty($price)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ceny']);
        }
        $year = $request->get('year');
        if (empty($year)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać roku produkcji']);
        }

        $fuel = (int)$request->get('fuel');
        if ($fuel === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać rodzaju paliwa']);
        }
        $power = $request->get('power');
        if (empty($power)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać mocy silnika']);
        }
        $mil = $request->get('mileage');
        if (empty($mil)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać przebiegu']);
        }
        $axis = $request->get('axis');
        if (empty($axis)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać liczby osi pojazdu']);
        }
        $con = (int)$request->get('condition');
        if ($con === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu technicznego']);
        }
        $gearbox = (int)$request->get('gearbox');
        if ($gearbox === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać skrzyni biegów']);
        }
        $description = $request->get('description');
        if (empty($description)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
        }
        $location = (int)$request->get('location');
        if ($location === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
        }
        $locationName = $request->get('locationname');
        if (empty($locationName)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
        }
        $number = $request->get('number');
        if (empty($number)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
        }
        $negotiation = $request->get('negotiation');

        $datas['title'] = $title;
        $datas['category'] = $category;
        $tekst_a = explode(' ', $price);
        $price = '';
        if (count($tekst_a) > 0) {
            foreach ($tekst_a as $wyraz)
                $price .= trim($wyraz);
            $price = trim($price);
        }
        $datas['price'] = $price;
        $datas['year'] = $year;
        $datas['markVans'] = (string)$mark;
        $cap = $request->get('capacity');
        if (!empty($cap)) {
            $tekst_c = explode(' ', $cap);
            $cap = '';
            if (count($tekst_c) > 0)
            {
                foreach ($tekst_c as $wyraz)
                    $cap .= trim($wyraz);
                $cap = trim($cap);
            }
            $datas['capacity'] = $cap;
        }
        $datas['fuel'] = (string)$fuel;
        $datas['power'] = $power;
        $tekst_d = explode(' ', $mil);
        $mil = '';
        if (count($tekst_d) > 0)
        {
            foreach ($tekst_d as $wyraz)
                $mil .= trim($wyraz);
            $mil = trim($mil);
        }
        $datas['mileage'] = $mil;
        $datas['condition'] = $con;
        $datas['gearbox'] = (string)$gearbox;
        $country = (int)$request->get('country');
        if ($country != 0) {
            $datas['country'] = (string)$country;
        }
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $tekst_b = explode(' ', $number);
        $number = '';
        if (count($tekst_b) > 0)
        {
            foreach ($tekst_b as $wyraz)
                $number .= trim($wyraz);
            $number = trim($number);
        }
        $datas['number'] = $number;
        $datas['underCategory'] = (string)$underCat;
        $datas['axis'] = $axis;
        $size = $request->get('size');
        if (!empty($size)) {
            $datas['size'] = $size;
        }
        $datas['negotiation'] = (string)$negotiation;

        if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;
    }

    /**
     * @Route("/data-semitrailer/ajax", name="data_semitrailer")
     * @param Request $request
     */
    public function dataSemitrailer(Request $request)
    {
        $datas = [];
        $title = $request->get('title');
        if (empty($title)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać tytułu']);
        }
        $category = $request->get('category');
        $underCat = $request->get('underCat');
        $price = $request->get('price');
        if (empty($price)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ceny']);
        }
        $year = $request->get('year');
        if (empty($year)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać roku produkcji']);
        }
        $mil = $request->get('mileage');
        if (empty($mil)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać przebiegu']);
        }
        $con = (int)$request->get('condition');
        if ($con === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu technicznego']);
        }
        $description = $request->get('description');
        if (empty($description)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
        }
        $location = (int)$request->get('location');
        if ($location === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
        }
        $locationName = $request->get('locationname');
        if (empty($locationName)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
        }
        $number = $request->get('number');
        if (empty($number)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
        }
        $negotiation = $request->get('negotiation');

        $datas['title'] = $title;
        $datas['category'] = (string)$category;
        $tekst_a = explode(' ', $price);
        $price = '';
        if (count($tekst_a) > 0) {
            foreach ($tekst_a as $wyraz)
                $price .= trim($wyraz);
            $price = trim($price);
        }
        $datas['price'] = $price;
        $datas['year'] = $year;
        $tekst_d = explode(' ', $mil);
        $mil = '';
        if (count($tekst_d) > 0)
        {
            foreach ($tekst_d as $wyraz)
                $mil .= trim($wyraz);
            $mil = trim($mil);
        }
        $datas['mileage'] = $mil;
        $datas['condition'] = (string)$con;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $tekst_b = explode(' ', $number);
        $number = '';
        if (count($tekst_b) > 0)
        {
            foreach ($tekst_b as $wyraz)
                $number .= trim($wyraz);
            $number = trim($number);
        }
        $datas['number'] = $number;
        $datas['underCategory'] = $underCat;
        $datas['negotiation'] = (string)$negotiation;

        if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;
    }

    /**
     * @Route("/data-others-vans-trucks/ajax", name="data_others_vans_trucks")
     * @param Request $request
     */
    public function dataOthersVansTrucks(Request $request)
    {
        $datas = [];
        $title = $request->get('title');
        if (empty($title)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać tytułu']);
        }
        $category = $request->get('category');
        $underCat = $request->get('underCat');
        $price = $request->get('price');
        if (empty($price)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ceny']);
        }
        $year = $request->get('year');
        if (empty($year)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać roku produkcji']);
        }
        $con = (int)$request->get('condition');
        if ($con === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu technicznego']);
        }
        $description = $request->get('description');
        if (empty($description)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
        }
        $location = (int)$request->get('location');
        if ($location === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
        }
        $locationName = $request->get('locationname');
        if (empty($locationName)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
        }
        $number = $request->get('number');
        if (empty($number)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
        }
        $negotiation = $request->get('negotiation');

        $datas['title'] = $title;
        $datas['category'] = (string)$category;
        $tekst_a = explode(' ', $price);
        $price = '';
        if (count($tekst_a) > 0) {
            foreach ($tekst_a as $wyraz)
                $price .= trim($wyraz);
            $price = trim($price);
        }
        $datas['price'] = $price;
        $datas['year'] = $year;
        $datas['condition'] = (string)$con;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $tekst_b = explode(' ', $number);
        $number = '';
        if (count($tekst_b) > 0)
        {
            foreach ($tekst_b as $wyraz)
                $number .= trim($wyraz);
            $number = trim($number);
        }
        $datas['number'] = $number;
        $datas['underCategory'] = $underCat;
        $datas['negotiation'] = (string)$negotiation;

        if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;
    }


    /**
     * @Route("/data-cars-parts/ajax", name="data_cars_parts")
     * @param Request $request
     */
    public function dataCarsParts(Request $request)
    {
        $datas = [];
        $title = $request->get('title');
        if (empty($title)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać tytułu']);
        }
        $category = $request->get('category');
        $vehicle = $request->get('vehicle');
        $price = $request->get('price');
        if (empty($price)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ceny']);
        }

        if ($vehicle == 5) {
            $description = $request->get('description');
            if (empty($description)) {

                return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
            }
            $location = (int)$request->get('location');
            if ($location === 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
            }
            $locationName = $request->get('locationname');
            if (empty($locationName)) {

                return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
            }
            $number = $request->get('number');
            if (empty($number)) {

                return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
            }
            $negotiation = $request->get('negotiation');

            $datas['title'] = $title;
            $datas['category'] = $category;
            $tekst_a = explode(' ', $price);
            $price = '';
            if (count($tekst_a) > 0) {
                foreach ($tekst_a as $wyraz)
                    $price .= trim($wyraz);
                $price = trim($price);
            }
            $datas['price'] = $price;
            $datas['description'] = $description;
            $datas['location'] = (string)$location;
            $datas['locationname'] = $locationName;
            $tekst_b = explode(' ', $number);
            $number = '';
            if (count($tekst_b) > 0)
            {
                foreach ($tekst_b as $wyraz)
                    $number .= trim($wyraz);
                $number = trim($number);
            }
            $datas['number'] = $number;
            $datas['vehicle'] = $vehicle;
            $datas['negotiation'] = (string)$negotiation;

            if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

                return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
            }
            return false;

        } else {
            $type = (int)$request->get('type');
            if ($type == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać rodzaju pojazdu']);
            }
            $state = (int)$request->get('state');
            if ($state == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu części']);
            }
            $description = $request->get('description');
            if (empty($description)) {

                return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
            }
            $location = (int)$request->get('location');
            if ($location == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
            }
            $locationName = $request->get('locationname');
            if (empty($locationName)) {

                return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
            }
            $number = $request->get('number');
            if (empty($number)) {

                return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
            }
            $negotiation = $request->get('negotiation');

            $datas['title'] = $title;
            $datas['category'] = $category;
            $tekst_a = explode(' ', $price);
            $price = '';
            if (count($tekst_a) > 0) {
                foreach ($tekst_a as $wyraz)
                    $price .= trim($wyraz);
                $price = trim($price);
            }
            $datas['price'] = $price;
            $datas['state'] = (string)$state;
            $datas['description'] = $description;
            $datas['location'] = (string)$location;
            $datas['locationname'] = $locationName;
            $tekst_b = explode(' ', $number);
            $number = '';
            if (count($tekst_b) > 0)
            {
                foreach ($tekst_b as $wyraz)
                    $number .= trim($wyraz);
                $number = trim($number);
            }
            $datas['number'] = $number;
            $datas['vehicle'] = $vehicle;
            $datas['type'] = (string)$type;
            $datas['negotiation'] = (string)$negotiation;

            if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

                return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
            }
            return false;
        }
    }

    /**
     * @Route("/data-motors-parts/ajax", name="data_motors_parts")
     * @param Request $request
     */
    public function dataMotorsParts(Request $request)
    {
        $datas = [];
        $title = $request->get('title');
        if (empty($title)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać tytułu']);
        }
        $category = $request->get('category');
        $price = $request->get('price');
        if (empty($price)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ceny']);
        }
        $type = (int)$request->get('type');
        if ($type == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać rodzaju pojazdu']);
        }
        $state = (int)$request->get('state');
        if ($state == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu części']);
        }
        $description = $request->get('description');
        if (empty($description)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
        }
        $location = (int)$request->get('location');
        if ($location == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
        }
        $locationName = $request->get('locationname');
        if (empty($locationName)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
        }
        $number = $request->get('number');
        if (empty($number)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
        }
        $negotiation = $request->get('negotiation');

        $datas['title'] = $title;
        $datas['category'] = $category;
        $tekst_a = explode(' ', $price);
        $price = '';
        if (count($tekst_a) > 0) {
            foreach ($tekst_a as $wyraz)
                $price .= trim($wyraz);
            $price = trim($price);
        }
        $datas['price'] = $price;
        $datas['state'] = (string)$state;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $tekst_b = explode(' ', $number);
        $number = '';
        if (count($tekst_b) > 0)
        {
            foreach ($tekst_b as $wyraz)
                $number .= trim($wyraz);
            $number = trim($number);
        }
        $datas['number'] = $number;
        $datas['type'] = (string)$type;
        $datas['negotiation'] = (string)$negotiation;

        if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;
    }

    /**
     * @Route("/data-tires-rims/ajax", name="data_tires_rims")
     * @param Request $request
     */
    public function dataTiresRims(Request $request)
    {
        $datas = [];
        $title = $request->get('title');
        if (empty($title)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać tytułu']);
        }
        $category = $request->get('category');
        $price = $request->get('price');
        if (empty($price)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ceny']);
        }
        $underCat = $request->get('underCat');
        $state = (int)$request->get('state');
        if ($state == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu części']);
        }
        $description = $request->get('description');
        if (empty($description)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
        }
        $location = (int)$request->get('location');
        if ($location == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
        }
        $locationName = $request->get('locationname');
        if (empty($locationName)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
        }
        $number = $request->get('number');
        if (empty($number)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
        }
        $negotiation = $request->get('negotiation');

        if ($underCat == 6) {
            $typeTires = (int)$request->get('typeTires');
            if ($typeTires == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać typu opony']);
            }
            $vehicleTires = (int)$request->get('vehicleTires');
            if ($vehicleTires == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać pojazdu']);
            }
            $inch = (int)$request->get('inch');
            if ($inch == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać wielkość/cale']);
            }
            $widthTires = (int)$request->get('widthTires');
            if ($widthTires == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać szerokość opony']);
            }
            $profilTires = (int)$request->get('profilTires');
            if ($profilTires == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać profil opony']);
            }

            $datas['typeTires'] = (string)$typeTires;
            $datas['vehicleTires'] = (string)$vehicleTires;
            $datas['inch'] = (string)$inch;
            $datas['widthTires'] = (string)$widthTires;
            $datas['profilTires'] = (string)$profilTires;

        } elseif ($underCat == 7) {
            $vehicleTires = (int)$request->get('vehicleTires');
            if ($vehicleTires == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać pojazdu']);
            }
            $rims = (int)$request->get('rims');
            if ($rims == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać rodzaj felg']);
            }

            $datas['vehicleTires'] = (string)$vehicleTires;
            $datas['rims'] = (string)$rims;

        } elseif ($underCat == 8) {
            $typeTires = (int)$request->get('typeTires');
            if ($typeTires == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać typu opony']);
            }
            $vehicleTires = (int)$request->get('vehicleTires');
            if ($vehicleTires == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać pojazdu']);
            }
            $rims = (int)$request->get('rims');
            if ($rims == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać rodzaj felg']);
            }

            $datas['typeTires'] = (string)$typeTires;
            $datas['vehicleTires'] = (string)$vehicleTires;
            $datas['rims'] = (string)$rims;

        } elseif ($underCat == 9) {
            $vehicleTires = (int)$request->get('vehicleTires');
            if ($vehicleTires == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać pojazdu']);
            }

            $datas['vehicleTires'] = (string)$vehicleTires;
        }

        $datas['title'] = $title;
        $datas['category'] = $category;
        $datas['underCategory'] = $underCat;
        $tekst_a = explode(' ', $price);
        $price = '';
        if (count($tekst_a) > 0) {
            foreach ($tekst_a as $wyraz)
                $price .= trim($wyraz);
            $price = trim($price);
        }
        $datas['price'] = $price;
        $datas['state'] = (string)$state;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $tekst_b = explode(' ', $number);
        $number = '';
        if (count($tekst_b) > 0)
        {
            foreach ($tekst_b as $wyraz)
                $number .= trim($wyraz);
            $number = trim($number);
        }
        $datas['number'] = $number;
        $datas['negotiation'] = (string)$negotiation;

        if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;
    }

    /**
     * @Route("/data-trailer-other-vehicles/ajax", name="data_trailer")
     * @param Request $request
     */
    public function dataTrailer(Request $request)
    {
        $title = $request->get('title');
        if (empty($title)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać tytułu']);
        }
        $category = $request->get('category');
        $underCat = $request->get('underCat');
        $price = $request->get('price');
        if (empty($price)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ceny']);
        }
        $year = $request->get('year');
        if (empty($year)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać roku produkcji']);
        }
        $con = (int)$request->get('condition');
        if ($con == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu technicznego']);
        }
        $description = $request->get('description');
        if (empty($description)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
        }
        $location = (int)$request->get('location');
        if ($location == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
        }
        $locationName = $request->get('locationname');
        if (empty($locationName)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
        }
        $number = $request->get('number');
        if (empty($number)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
        }
        $negotiation = $request->get('negotiation');

        $datas['title'] = $title;
        $datas['category'] = $category;
        $tekst_a = explode(' ', $price);
        $price = '';
        if (count($tekst_a) > 0) {
            foreach ($tekst_a as $wyraz)
                $price .= trim($wyraz);
            $price = trim($price);
        }
        $datas['price'] = $price;
        $datas['year'] = $year;
        $datas['condition'] = (string)$con;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $tekst_b = explode(' ', $number);
        $number = '';
        if (count($tekst_b) > 0)
        {
            foreach ($tekst_b as $wyraz)
                $number .= trim($wyraz);
            $number = trim($number);
        }
        $datas['number'] = $number;
        $datas['underCategory'] = $underCat;
        $datas['negotiation'] = (string)$negotiation;

        if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;
    }

    /**
     * @Route("/data-equipment/ajax", name="data_equipment")
     * @param Request $request
     */
    public function dataEquipment(Request $request)
    {
        $title = $request->get('title');
        if (empty($title)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać tytułu']);
        }
        $category = $request->get('category');
        $price = $request->get('price');
        if (empty($price)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ceny']);
        }
        $state = (int)$request->get('state');
        if ($state == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu pojazdu']);
        }
        $description = $request->get('description');
        if (empty($description)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
        }
        $location = (int)$request->get('location');
        if ($location == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
        }
        $locationName = $request->get('locationname');
        if (empty($locationName)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
        }
        $number = $request->get('number');
        if (empty($number)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
        }
        $negotiation = $request->get('negotiation');

        $datas['title'] = $title;
        $datas['category'] = $category;
        $tekst_a = explode(' ', $price);
        $price = '';
        if (count($tekst_a) > 0) {
            foreach ($tekst_a as $wyraz)
                $price .= trim($wyraz);
            $price = trim($price);
        }
        $datas['price'] = $price;
        $datas['state'] = (string)$state;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $tekst_b = explode(' ', $number);
        $number = '';
        if (count($tekst_b) > 0)
        {
            foreach ($tekst_b as $wyraz)
                $number .= trim($wyraz);
            $number = trim($number);
        }
        $datas['number'] = $number;
        $datas['negotiation'] = (string)$negotiation;

        if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;
    }

    /**
     * @Route("/data-other-automotive/ajax", name="data_other_automotive")
     * @param Request $request
     */
    public function dataOtherAutomotive(Request $request)
    {
        $title = $request->get('title');
        if (empty($title)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać tytułu']);
        }
        $category = $request->get('category');
        $price = $request->get('price');
        if (empty($price)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ceny']);
        }
        $description = $request->get('description');
        if (empty($description)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać ważnego elementu, opisu pojazdu']);
        }
        $location = (int)$request->get('location');
        if ($location == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać Swojego województwa']);
        }
        $locationName = $request->get('locationname');
        if (empty($locationName)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać Swojej miejscowości']);
        }
        $number = $request->get('number');
        if (empty($number)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać numeru telefonu']);
        }
        $negotiation = $request->get('negotiation');

        $datas['title'] = $title;
        $datas['category'] = $category;
        $tekst_a = explode(' ', $price);
        $price = '';
        if (count($tekst_a) > 0) {
            foreach ($tekst_a as $wyraz)
                $price .= trim($wyraz);
            $price = trim($price);
        }
        $datas['price'] = $price;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $tekst_b = explode(' ', $number);
        $number = '';
        if (count($tekst_b) > 0)
        {
            foreach ($tekst_b as $wyraz)
                $number .= trim($wyraz);
            $number = trim($number);
        }
        $datas['number'] = $number;
        $datas['negotiation'] = (string)$negotiation;

        if ($this->dataService->addDatasOffer($datas, $this->getUser())) {

            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;
    }
}