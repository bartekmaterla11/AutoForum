<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\AppInfoInterface;
use App\Query\DownloadAppInfoQuery;

class AppInfoService implements \App\Service\AppInfoInterface
{
    /**
     * @var DownloadAppInfoQuery
     */
    private $downloadAppInfoQuery;

    public function __construct(DownloadAppInfoQuery $downloadAppInfoQuery)
    {
        $this->downloadAppInfoQuery = $downloadAppInfoQuery;
    }

    public function getAppInfo(): array
    {
        $appInfos = [];
        $appInfos['users'] = $this->downloadAppInfoQuery->downloadAppInfoUsers();
        $appInfos['posts'] = $this->downloadAppInfoQuery->downloadAppInfoPost();
        $appInfos['answers'] = $this->downloadAppInfoQuery->downloadAppInfoAnswer();
        $appInfos['announcement'] = $this->downloadAppInfoQuery->downloadAppInfoAnnouncement();

        return $appInfos;
    }
}
