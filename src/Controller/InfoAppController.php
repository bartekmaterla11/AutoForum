<?php

namespace App\Controller;

use App\Service\AppInfoInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InfoAppController extends AbstractController
{
    /**
     * @var AppInfoInterface
     */
    private $appInfo;

    public function __construct(AppInfoInterface $appInfo)
    {
        $this->appInfo = $appInfo;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/infos/ajax")
     */
    public function appInfo()
    {
        $appInfos = $this->appInfo->getAppInfo();

       return $this->render('components/info_data_items_com.html.twig',[
           'info' => $appInfos,
       ]);
    }
}