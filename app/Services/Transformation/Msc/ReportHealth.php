<?php

namespace App\Services\Transformation\Msc;

use Carbon\Carbon;

class ReportHealth
{
	/**
     * Get Data Transformation
     * @param $data
     * @return array
     */
    public function getReportHealthTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setReportHealthTransform($data);
    }

    /**
     * Set Data Transformation
     * @param $data
     * @return array
     */
    protected function setReportHealthTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [
                'berat_badan'   => isset($data['berat_badan']) ? $data['berat_badan'] : '',
                'tinggi_badan'  => isset($data['tinggi_badan']) ? $data['tinggi_badan'] : '',
                'tensi_darah'   => isset($data['tensi_darah']) ? $data['tensi_darah'] : '',
                'golongan_darah'=> isset($data['golongan_darah']) ? $data['golongan_darah'] : '',
                'riwayat_sakit' => isset($data['riwayat_sakit']) ? $data['riwayat_sakit'] : '',
                'keadaan_siswa' => isset($data['keadaan_siswa']) ? $data['keadaan_siswa'] : '',
                'report_from'   => isset($data['report_from']) ? date('M Y', strtotime($data['report_from'])) : '',
            ];
        },$data);

        return $dataTransform;
    }
}