<?php

namespace App\Services\Bridge\Msc;

use App\Repositories\Contracts\Msc\QuranRecitationReport as QuranRecitationReportInterface;

class QuranRecitationReport {

    /**
     * @var Report Kesehatan Interface
     */
    protected $quranRecitationReport;

    public function __construct(QuranRecitationReportInterface $quranRecitationReport)
    {
        $this->quranRecitationReport = $quranRecitationReport;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->quranRecitationReport->getData($params);
    }

} 