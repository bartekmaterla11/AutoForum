<?php

namespace App\Controller\Announcements;

use App\Entity\Color;
use App\Entity\ConditionTechnical;
use App\Entity\Country;
use App\Entity\Fuel;
use App\Entity\Gearbox;
use App\Entity\Handlebar;
use App\Entity\InchTires;
use App\Entity\Location;
use App\Entity\MainCategory;
use App\Entity\MarkOfCars;
use App\Entity\MarkOfMotors;
use App\Entity\MarkOfVansAndTrucks;
use App\Entity\ModelOfCars;
use App\Entity\Offer;
use App\Entity\Overbody;
use App\Entity\ProfilTires;
use App\Entity\State;
use App\Entity\Template;
use App\Entity\TypeParts;
use App\Entity\TypeRims;
use App\Entity\TypeTires;
use App\Entity\VehicleType;
use App\Entity\WidthTires;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\s;

class AnnouncementController extends AbstractController
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @Route("/dodaj/category", name="add_category_ajax")
     */
    public function categoryChange(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categoryId = (int)$request->get('value');

        if ($categoryId < 10) {

            return $this->json(['categoryId' => $categoryId]);
        } else {
            return $this->json(['categorySlug' => ' ']);
        }

    }

    /**
     * @Route ("/ogloszenia/dodaj-oferte", name="add_offer")
     */
    public function addOffer(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categoryId = (int)$request->get('value1');

        $templates = $em->getRepository(Template::class)->findAll();
        $categories = $em->getRepository(MainCategory::class)->findAll();
        $models = $em->getRepository(ModelOfCars::class)->findAll();
        $fuel = $em->getRepository(Fuel::class)->findAll();
        $location = $em->getRepository(Location::class)->findAll();
        $color = $em->getRepository(Color::class)->findAll();
        $body = $em->getRepository(Overbody::class)->findAll();
        $gearbox = $em->getRepository(Gearbox::class)->findAll();
        $handlebar = $em->getRepository(Handlebar::class)->findAll();
        $condition = $em->getRepository(ConditionTechnical::class)->findAll();
        $country = $em->getRepository(Country::class)->findAll();
        $type = $em->getRepository(TypeParts::class)->findAll();
        $state = $em->getRepository(State::class)->findAll();
        $vehicleType = $em->getRepository(VehicleType::class)->findAll();
        $inch = $em->getRepository(InchTires::class)->findAll();
        $typeTires = $em->getRepository(TypeTires::class)->findAll();
        $typeRims = $em->getRepository(TypeRims::class)->findAll();
        $profilTires = $em->getRepository(ProfilTires::class)->findAll();
        $widthTires = $em->getRepository(WidthTires::class)->findAll();

        return $this->render('announcement/add/add_announcement.html.twig', [
            'models' => $models,
            'templates' => $templates,
            'fuel' => $fuel,
            'categories' => $categories,
            'location' => $location,
            'color' => $color,
            'gearbox' => $gearbox,
            'handlebar' => $handlebar,
            'condition' => $condition,
            'country' => $country,
            'body' => $body,
            'type' => $type,
            'state' =>$state,
            'vehicle' => $vehicleType,
            'inch' => $inch,
            'typeTires' => $typeTires,
            'typeRims' => $typeRims,
            'profilTires' => $profilTires,
            'widthTires' => $widthTires,
        ]);
    }

    /**
     * @Route("/ogloszenia/ajax", name="category_change_announ")
     */
    public function changeCategoryAnnoun(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categoryId = (int)$request->get('value');
        

        if ($categoryId < 10) {
            $category = $em->getRepository(MainCategory::class)->find(['id' => $categoryId]);

            return $this->json(['categorySlug' => $category->getSlug()]);
        } else {
            return $this->json(['categorySlug' => ' ']);
        }

    }

    /**
     * @param Request $request
     * @param int $page
     * @Route("/ogloszenia/{page}", name="announcement")
     */
    public function homepage(Request $request, int $page): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(MainCategory::class)->findAll();
        $offers = $em->getRepository(Offer::class)->findByAll();
        $offers = $this->paginator->paginate($offers, $page, 5);

        return $this->render('announcement/index/index_announcements.html.twig', [
            'cat' => $categories,
            'offers' => $offers,
        ]);
    }

    /**
     * @Route("/ogloszenia/1/{categorySlug}", name="announcement_filters")
     * @param string $categorySlug
     */
    public function announcementsFilters(Request $request, string $categorySlug): Response
    {
        $page = 1;
        if ($request->get('page')) {
            $page = $request->get('page');
        }
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository(MainCategory::class)->findOneBy(['slug' => $categorySlug]);
        $categories1 = $em->getRepository(MainCategory::class)->findAll();
        $location = $em->getRepository(Location::class)->findAll();
        $markCars = $em->getRepository(MarkOfCars::class)->findAll();
        $markMotors = $em->getRepository(MarkOfMotors::class)->findAll();
        $fuel = $em->getRepository(Fuel::class)->findAll();
        $color = $em->getRepository(Color::class)->findAll();
        $body = $em->getRepository(Overbody::class)->findAll();
        $gearbox = $em->getRepository(Gearbox::class)->findAll();
        $handlebar = $em->getRepository(Handlebar::class)->findAll();
        $condition = $em->getRepository(ConditionTechnical::class)->findAll();
        $country = $em->getRepository(Country::class)->findAll();
        $type = $em->getRepository(TypeParts::class)->findAll();
        $state = $em->getRepository(State::class)->findAll();
        $vehicleType = $em->getRepository(VehicleType::class)->findAll();
        $inch = $em->getRepository(InchTires::class)->findAll();
        $typeTires = $em->getRepository(TypeTires::class)->findAll();
        $typeRims = $em->getRepository(TypeRims::class)->findAll();
        $profilTires = $em->getRepository(ProfilTires::class)->findAll();
        $widthTires = $em->getRepository(WidthTires::class)->findAll();


        $offers = $em->getRepository(Offer::class)->findByCategoryOffers($categoria->getId());
        $offers = $this->paginator->paginate($offers, $page, 5);

        return $this->render('announcement/view/category_view_announcement.html.twig', [
            'cat' => $categoria,
            'cat1' => $categories1,
            'slug' => $categorySlug,
            'offers' => $offers,
            'location' => $location,
            'mark' => $markCars,
            'markMotors' => $markMotors,
            'fuel' => $fuel,
            'color' => $color,
            'gearbox' => $gearbox,
            'handlebar' => $handlebar,
            'condition' => $condition,
            'country' => $country,
            'body' => $body,
            'type' => $type,
            'state' => $state,
            'vehicleTires' => $vehicleType,
            'inch' => $inch,
            'typeTires' => $typeTires,
            'typeRims' => $typeRims,
            'profilTires' => $profilTires,
            'widthTires' => $widthTires,
        ]);
    }

    /**
     * @Route("/ogloszenia/{categorySlug}/{slug}", name="view_announ")
     * @param Request $request
     * @param string $categorySlug
     * @param string $slug
     * @return Response
     */
    public function viewAnnouncement(Request $request, string $categorySlug, string $slug): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository(MainCategory::class)->findOneBy(['slug' => $categorySlug]);
        $offer = $em->getRepository(Offer::class)->findOneBy(['slug' => $slug]);
        $fuel = $em->getRepository(Fuel::class)->findAll();
        $location = $em->getRepository(Location::class)->findAll();
        $models = $em->getRepository(ModelOfCars::class)->findAll();
        $color = $em->getRepository(Color::class)->findAll();
        $body = $em->getRepository(Overbody::class)->findAll();
        $gearbox = $em->getRepository(Gearbox::class)->findAll();
        $handlebar = $em->getRepository(Handlebar::class)->findAll();
        $condition = $em->getRepository(ConditionTechnical::class)->findAll();
        $country = $em->getRepository(Country::class)->findAll();
        $type = $em->getRepository(TypeParts::class)->findAll();
        $state = $em->getRepository(State::class)->findAll();
        $vehicleType = $em->getRepository(VehicleType::class)->findAll();
        $inch = $em->getRepository(InchTires::class)->findAll();
        $typeTires = $em->getRepository(TypeTires::class)->findAll();
        $typeRims = $em->getRepository(TypeRims::class)->findAll();
        $profilTires = $em->getRepository(ProfilTires::class)->findAll();
        $widthTires = $em->getRepository(WidthTires::class)->findAll();

        if ($offer) {

            return $this->render('announcement/view/view_announcements.html.twig',[
                'offer' => $offer,
                'cat' => $categoria,
                'catSlug' => $categorySlug,
                'fuel' => $fuel,
                'location' => $location,
                'models' => $models,
                'color' => $color,
                'gearbox' => $gearbox,
                'handlebar' => $handlebar,
                'condition' => $condition,
                'country' => $country,
                'body' => $body,
                'type' => $type,
                'state' => $state,
                'vehicleTires' => $vehicleType,
                'inch' => $inch,
                'typeTires' => $typeTires,
                'typeRims' => $typeRims,
                'profilTires' => $profilTires,
                'widthTires' => $widthTires,
            ]);
        }
        return $this->redirectToRoute('announcement');
    }
}
