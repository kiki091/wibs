<?php

namespace App\Services\Transformation\Msc;

use Carbon\Carbon;

class ReportHadis
{
	/**
     * Get Data Transformation
     * @param $data
     * @return array
     */
    public function getReportHadisTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setReportHadisTransform($data);
    }

    /**
     * Get Data Transformation
     * @param $data
     * @return array
     */
    public function getAllDataTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setAllDataTransform($data);
    }

    /**
     * Set Data Transformation
     * @param $data
     * @return array
     */
    protected function setReportHadisTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [
                'id'                => isset($data['id']) ? $data['id'] : '',
                'kedisiplinan'      => isset($data['kedisiplinan']) ? $data['kedisiplinan'] : '',
                'total_hafalan'     => isset($data['total_hafalan']) ? $data['total_hafalan'] : '',
                'kekuatan_hafalan'  => isset($data['kekuatan_hafalan']) ? $data['kekuatan_hafalan'] : '',
                'nilai_hafalan'     => isset($data['nilai_hafalan']) ? $data['nilai_hafalan'] : '',
                'description'       => isset($data['description']) ? $data['description'] : '',
                'report_from'       => isset($data['report_from']) ? date('M Y', strtotime($data['report_from'])) : '',
                'kitab'             => isset($data['kitab']) ?  $data['kitab']['title']: '',
            ];
        },$data);

        return $dataTransform;
    }

    /**
     * Set Data Transformation
     * @param $data
     * @return array
     */
    protected function setAllDataTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [
                'nama_siswa'        => isset($data['siswa']['nama_lengkap']) ? $data['siswa']['nama_lengkap'] : '',
                'nilai_hafalan'     => isset($data['nilai_hafalan']) ? $data['nilai_hafalan'] : '',
            ];
        },$data);

        return $dataTransform;
    }
}