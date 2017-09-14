<?php

namespace App\Services\Transformation\Msc;

use Carbon\Carbon;

class ReportTahfidz
{
	/**
     * Get Data Transformation
     * @param $data
     * @return array
     */
    public function getReportTahfidzTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setReportTahfidzTransform($data);
    }

    /**
     * Set Data Transformation
     * @param $data
     * @return array
     */
    protected function setReportTahfidzTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [
                'id'            => isset($data['id']) ? $data['id'] : '',
                'disiplin'      => isset($data['disiplin']) ? $data['disiplin'] : '',
                'total_hafalan' => isset($data['total_hafalan']) ? $data['total_hafalan'] : '',
                'nilai_hafalan' => isset($data['nilai_hafalan']) ? $data['nilai_hafalan'] : '',
                'nilai_tajwid'  => isset($data['nilai_tajwid']) ? $data['nilai_tajwid'] : '',
                'nilai_mahraj'  => isset($data['nilai_mahraj']) ? $data['nilai_mahraj'] : '',
                'report_from'   => isset($data['report_from']) ? date('M Y', strtotime($data['report_from'])) : '',
            ];
        },$data);

        return $dataTransform;
    }
}