<?php


namespace App\Controller\Announcements;


use App\Query\Announcements\ModelsForCarsQuery;
use App\Service\Announcements\DataCarsService;
use App\Service\UploadFileService;
use http\Env\Response;
use phpDocumentor\Reflection\Types\False_;
use phpDocumentor\Reflection\Types\This;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JavaScriptAnnouncementController extends AbstractController
{
    /**
     * @var DataCarsService
     */
    private $dataCarsService;
    /**
     * @var UploadFileService
     */
    private $fileService;
    /**
     * @var ModelsForCarsQuery
     */
    private $modelsForCars;

    public function __construct(DataCarsService $dataCarsService, UploadFileService $fileService, ModelsForCarsQuery $modelsForCars)
    {
        $this->dataCarsService = $dataCarsService;
        $this->fileService = $fileService;
        $this->modelsForCars = $modelsForCars;
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
        $cap = $request->get('capacity');
        if (empty($cap)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać pojemności silnika']);
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
        $country = (int)$request->get('country');
        if ($country === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać kraju pochodzenia']);
        }
        $handlebar = (int)$request->get('handlebar');
        if ($handlebar === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać strony kierownicy']);
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


        $datas['title'] = $title;
        $datas['category'] = $category;
        $datas['price'] = $price;
        $datas['mark'] = (string)$mark;
        $datas['model'] = (string)$model;
        $datas['year'] = $year;
        $datas['capacity'] = $cap;
        $datas['fuel'] = (string)$fuel;
        $datas['power'] = $power;
        $datas['mileage'] = $mil;
        $datas['color'] = (string)$color;
        $datas['body'] = (string)$body;
        $datas['condition'] = (string)$con;
        $datas['gearbox'] = (string)$gearbox;
        $datas['country'] = (string)$country;
        $datas['handlebar'] = (string)$handlebar;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $datas['number'] = $number;

        if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

//            $this->addFlash('success_announ','Ogłoszenie zostało dodane');
//            return $this->redirectToRoute('announcement',['page'=>1]);
            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;

//        $tab = $request->get('photos');
//        $tab0 = $tab[0];
//        $this->fileService->UploadFile($tab0,'Photo','/images/offer');
//        \Symfony\Component\VarDumper\VarDumper::dump($tab[0]);
//        die('end');
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
        $cap = $request->get('capacity');
        if (empty($cap)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać pojemności silnika']);
        }
        $con = (int)$request->get('condition');
        if ($con == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu technicznego']);
        }
        $country = (int)$request->get('country');
        if ($country == 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać kraju pochodzenia']);
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

        $datas['title'] = $title;
        $datas['category'] = $category;
        $datas['price'] = $price;
        $datas['markMotors'] = (string)$mark;
        $datas['year'] = $year;
        $datas['capacity'] = $cap;
        $datas['condition'] = (string)$con;
        $datas['country'] = (string)$country;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $datas['number'] = $number;
        $datas['underCategory'] = $underCat;

        if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

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

        $cap = $request->get('capacity');
        if (empty($cap)) {

            return $this->json(['Error' => 'Zapomniałeś/aś dodać pojemności silnika']);
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
        $size = $request->get('size');
        if (empty($size)) {

            return $this->json(['Error' => 'Zapomniałeś/aś podać ładowności']);
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
        $country = (int)$request->get('country');
        if ($country === 0) {

            return $this->json(['Error' => 'Zapomniałeś/aś wybrać kraju pochodzenia']);
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

        $datas['title'] = $title;
        $datas['category'] = $category;
        $datas['price'] = $price;
        $datas['year'] = $year;
        $datas['markVans'] = (string)$mark;
        $datas['fuel'] = (string)$fuel;
        $datas['power'] = $power;
        $datas['mileage'] = $mil;
        $datas['condition'] = $con;
        $datas['gearbox'] = (string)$gearbox;
        $datas['country'] = (string)$country;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $datas['number'] = $number;
        $datas['underCategory'] = (string)$underCat;
        $datas['axis'] = $axis;
        $datas['size'] = $size;

        if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

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

        $datas['title'] = $title;
        $datas['category'] = (string)$category;
        $datas['price'] = $price;
        $datas['year'] = $year;
        $datas['mileage'] = $mil;
        $datas['condition'] = (string)$con;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $datas['number'] = $number;
        $datas['underCategory'] = $underCat;

        if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

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

        $datas['title'] = $title;
        $datas['category'] = (string)$category;
        $datas['price'] = $price;
        $datas['year'] = $year;
        $datas['condition'] = (string)$con;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $datas['number'] = $number;
        $datas['underCategory'] = $underCat;


        if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

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
            $datas['title'] = $title;
            $datas['category'] = $category;
            $datas['price'] = $price;
            $datas['description'] = $description;
            $datas['location'] = (string)$location;
            $datas['locationname'] = $locationName;
            $datas['number'] = $number;
            $datas['vehicle'] = $vehicle;

            if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

                return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
            }
            return false;

        } else {
            $type = (int)$request->get('type');
            if ($type == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać rodzaju pojazdu']);
            }
            $con = (int)$request->get('condition');
            if ($con == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać stanu technicznego']);
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

            $datas['title'] = $title;
            $datas['category'] = $category;
            $datas['price'] = $price;
            $datas['condition'] = (string)$con;
            $datas['state'] = (string)$state;
            $datas['description'] = $description;
            $datas['location'] = (string)$location;
            $datas['locationname'] = $locationName;
            $datas['number'] = $number;
            $datas['vehicle'] = $vehicle;
            $datas['type'] = (string)$type;

            if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

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

        $datas['title'] = $title;
        $datas['category'] = $category;
        $datas['price'] = $price;
        $datas['state'] = (string)$state;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $datas['number'] = $number;
        $datas['type'] = (string)$type;

        if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

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

        }elseif ($underCat == 8) {
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

        }elseif ($underCat == 9) {
            $vehicleTires = (int)$request->get('vehicleTires');
            if ($vehicleTires == 0) {

                return $this->json(['Error' => 'Zapomniałeś/aś wybrać pojazdu']);
            }

            $datas['vehicleTires'] = (string)$vehicleTires;
        }

        $datas['title'] = $title;
        $datas['category'] = $category;
        $datas['price'] = $price;
        $datas['state'] = (string)$state;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $datas['number'] = $number;

        if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

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
        $state = (int)$request->get('state');
        if ($state == 0){

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

        $datas['title'] = $title;
        $datas['category'] = $category;
        $datas['price'] = $price;
        $datas['year'] = $year;
        $datas['state'] = (string)$state;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $datas['number'] = $number;
        $datas['underCategory'] = $underCat;

        if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

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
        if ($state == 0){

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

        $datas['title'] = $title;
        $datas['category'] = $category;
        $datas['price'] = $price;
        $datas['state'] = (string)$state;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $datas['number'] = $number;

        if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

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

        $datas['title'] = $title;
        $datas['category'] = $category;
        $datas['price'] = $price;
        $datas['description'] = $description;
        $datas['location'] = (string)$location;
        $datas['locationname'] = $locationName;
        $datas['number'] = $number;

        if ($this->dataCarsService->addDatasCars($datas, $this->getUser())) {

            return $this->json(['Message' => 'Ogłoszenie zostało dodane']);
        }
        return false;
    }
}