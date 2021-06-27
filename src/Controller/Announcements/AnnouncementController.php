<?php

namespace App\Controller\Announcements;

use App\Entity\AttributeValue;
use App\Entity\CheckLikeOffer;
use App\Entity\ChildrenCategory;
use App\Entity\MainCategory;
use App\Entity\MarkOfVansAndTrucks;
use App\Entity\Offer;
use App\Service\Announcements\AnnouncementsInterface;
use App\Service\Announcements\AscriptionOffersByCategory;
use App\Service\Announcements\DownloadTablesServices;
use App\Service\Announcements\ReceivFilteringDataService;
use App\Service\Announcements\SelectByTypeParts;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementController extends AbstractController
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;
    /**
     * @var AnnouncementsInterface
     */
    private $announcements;
    /**
     * @var DownloadTablesServices
     */
    private DownloadTablesServices $tablesServices;
    /**
     * @var ReceivFilteringDataService
     */
    private ReceivFilteringDataService $filteringDataService;
    /**
     * @var AscriptionOffersByCategory
     */
    private AscriptionOffersByCategory $offersByCategory;
    /**
     * @var SelectByTypeParts
     */
    private SelectByTypeParts $byTypeParts;

    public function __construct(PaginatorInterface $paginator, AnnouncementsInterface $announcements, DownloadTablesServices $tablesServices,
                                ReceivFilteringDataService $filteringDataService, AscriptionOffersByCategory $offersByCategory, SelectByTypeParts $byTypeParts)
    {
        $this->paginator = $paginator;
        $this->announcements = $announcements;
        $this->tablesServices = $tablesServices;
        $this->filteringDataService = $filteringDataService;
        $this->offersByCategory = $offersByCategory;
        $this->byTypeParts = $byTypeParts;
    }

    /**
     * @Route("/dodaj/category", name="add_category_ajax")
     */
    public function categoryChange(Request $request)
    {
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
        $datas = $this->tablesServices->downloadTables($em);

        return $this->render('announcement/add/add_announcement.html.twig', [
            'data' => $datas,
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
        $numberOffers = count($offers);
        $offers = $this->paginator->paginate($offers, $page, 10);
        $check = $em->getRepository(CheckLikeOffer::class)->findAll();

        return $this->render('announcement/index/index_announcements.html.twig', [
            'cat' => $categories,
            'offers' => $offers,
            'check' => $check,
            'number' => $numberOffers,
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
        $datas = $this->tablesServices->downloadTables($em);
        $categoria = $em->getRepository(MainCategory::class)->findOneBy(['slug' => $categorySlug]);
        $categories1 = $em->getRepository(MainCategory::class)->findAll();
        $typeParts = $this->byTypeParts->findTypePartsByCategory($categoria, $em);
        $offers = $em->getRepository(Offer::class)->findByCategoryOffers($categoria->getId());
        $filters = $this->filteringDataService->receivingFilteringData($request);
        $offers = $this->offersByCategory->assigningOffersByCategory($categoria, $em, $filters);

        if ($request->get('sort')) {
            $offers = $em->getRepository(Offer::class)->findBySortOffers((int)$request->get('sort'));
        }
        $listType = 1;
        if ($request->get('type')) {
            $listType = (int)$request->get('type');

        }
        $filters['view'] = $listType;

        $numberOffers = count($offers);
        $offers = $this->paginator->paginate($offers, $page, 5);

        return $this->render('announcement/view/category_view_announcement.html.twig', [
            'cat' => $categoria,
            'cat1' => $categories1,
            'slug' => $categorySlug,
            'offers' => $offers,
            'filters' => $filters,
            'datas' => $datas,
            'typeParts' => $typeParts,
            'number' => $numberOffers,
        ]);
    }

    /**
     * @Route("/ogloszenia/1/{categorySlug}/{childrenSlug}", name="children_category_filters")
     * @param string $categorySlug
     * @param string $childrenSlug
     */
    public function childrenCategoryFilters(Request $request, string $categorySlug, string $childrenSlug): Response
    {
        $page = 1;
        if ($request->get('page')) {
            $page = $request->get('page');
        }

        $em = $this->getDoctrine()->getManager();
        $datas = $this->tablesServices->downloadTables($em);
        $categoria = $em->getRepository(MainCategory::class)->findOneBy(['slug' => $categorySlug]);
        $childCat = $em->getRepository(ChildrenCategory::class)->findOneBy(['slug' => $childrenSlug]);
        $offers = $em->getRepository(Offer::class)->findByChildCategoryOffers($categoria->getId(), $childCat->getId());
        $markVansTrucks = $em->getRepository(MarkOfVansAndTrucks::class)->findBy(['childrenCategory' => $childCat->getId()]);
        $typeParts = $this->byTypeParts->findTypePartsByCategory($categoria, $em);
        $filters = $this->filteringDataService->receivingFilteringChildData($request);
        $offers = $this->offersByCategory->assigningOffersByCategoryChild($categoria, $childCat, $em, $filters);
        $offers = $this->paginator->paginate($offers, $page, 5);
        $numberOffers = count($offers);

        $listType = 1;
        if ($request->get('valueType')) {
            $listType = $request->get('valueType');

        }

        return $this->render('announcement/view/category_view_announcement.html.twig', [
            'cat' => $categoria,
            'childSlug' => $childrenSlug,
            'slug' => $categorySlug,
            'offers' => $offers,
            'filters' => $filters,
            'datas' => $datas,
            'markVansTrucks' => $markVansTrucks,
            'typeParts' => $typeParts,
            'listType' => $listType,
            'number' => $numberOffers,
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
        $offerRep = $em->getRepository(Offer::class);
        $categoria = $em->getRepository(MainCategory::class)->findOneBy(['slug' => $categorySlug]);
        $offer = $offerRep->findOneBy(['slug' => $slug]);
        $offersUser = $offerRep->findByAllOtherOffersUser($offer->getUser()->getId(), $offer->getId());
        $datas = $this->tablesServices->downloadTables($em);
        $check = $em->getRepository(CheckLikeOffer::class)->findBy(['offer' => $offer->getId()]);

        $attribute = $em->getRepository(AttributeValue::class)->findByAttributeLocation($offer->getId());
        $likeOffers = $offerRep->findByAllLikeOffers((int)$attribute->getValue(), $categoria->getId(), $offer->getId());

        if ($offer) {

            return $this->render('announcement/view/view_announcements.html.twig', [
                'offer' => $offer,
                'cat' => $categoria,
                'catSlug' => $categorySlug,
                'offersUser' => $offersUser,
                'likeOffers' => $likeOffers,
                'check' => $check,
                'datas' => $datas,
            ]);
        }
        return $this->redirectToRoute('announcement', ['page' => 1]);
    }

    /**
     * @Route("/uzytkownicy/{userId}/moj-profil/{userTab}/{offerId}/usuwanie-oferty", name="remove_offer")
     * @param int $offerId
     * @param int $userId
     * @param string $userTab
     */
    public function removeOffer(int $offerId, int $userId, string $userTab)
    {
        $em = $this->getDoctrine()->getManager();
        $offer = $em->getRepository(Offer::class)->find($offerId);

        if ($this->announcements->removeOffer($offer)) {
            $this->addFlash('success_remove_offer', 'Oferta została usunięta');
        } else {
            $this->addFlash('error_remove_offer', 'Oferta nie została usunięta');
        }

        return $this->redirectToRoute('profile', ['page' => 1, 'userId' => $userId, 'userTab' => $userTab]);
    }
}
