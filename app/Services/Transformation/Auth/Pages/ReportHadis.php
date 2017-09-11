<?php

namespace App\Services\Transformation\Auth\Pages;

class ReportHadis
{
    /**
     * Get data santri Transformation
     * @param $data
     * @return array
     */
    public function getDataReportHadisTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataReportHadisTransform($data);
    }

    /**
     * Set data santri for edit Transformation
     * @param $data
     * @return array
     */
    public function getSingleForEditReportHadisTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleForEditReportHadisTransform($data);
    }

    /**
     * Set data transformation
     * @param $data
     * @return array
     */

    protected function setDataReportHadisTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [
                'id'                    => isset($data['id']) ? $data['id'] : '',
                'nis_siswa'             =>isset($data['siswa']['nis']) ? $data['siswa']['nis'] : '',
                'nama_siswa'            => isset($data['siswa']['nama_lengkap']) ? $data['siswa']['nama_lengkap'] : '',
                'kedisiplinan'          => isset($data['kedisiplinan']) ? $data['kedisiplinan'] : '',
                'total_hafalan'         => isset($data['total_hafalan']) ? $data['total_hafalan'] : '',
                'tingkatan'             => isset($data['siswa']['tingkatan']['title_alias']) ? $data['siswa']['tingkatan']['title_alias'] : '',
                'kekuatan_hafalan'      => isset($data['kekuatan_hafalan']) ? $data['kekuatan_hafalan'] : '',
                'nilai_hafalan'         => isset($data['nilai_hafalan']) ? $data['nilai_hafalan'] : '',
                'description'           => isset($data['description']) ? $data['description'] : '',
                'kitab_id'              => isset($data['kitab_id']) ? $data['kitab_id'] : '',
                'report_from'           => isset($data['report_from']) ? $data['report_from'] : '',
            ];
        },$data);

        return $dataTransform;
    }


    /**
     * Set data for edit transformation
     * @param $data
     * @return array
     */

    protected function setSingleForEditReportHadisTransform($data)
    {
        $dataTransform['id']                 = isset($data['id']) ? $data['id'] : '';
        $dataTransform['kedisiplinan']       = isset($data['kedisiplinan']) ? $data['kedisiplinan'] : '';
        $dataTransform['total_hafalan']      = isset($data['total_hafalan']) ? $data['total_hafalan'] : '';
        $dataTransform['kekuatan_hafalan']   = isset($data['kekuatan_hafalan']) ? $data['kekuatan_hafalan'] : '';
        $dataTransform['nilai_hafalan']      = isset($data['nilai_hafalan']) ? $data['nilai_hafalan'] : '';
        $dataTransform['description']        = isset($data['description']) ? $data['description'] : '';
        $dataTransform['kitab_id']           = isset($data['kitab_id']) ? $data['kitab_id'] : '';
        $dataTransform['report_from']        = isset($data['report_from']) ? $data['report_from'] : '';

        return $dataTransform;
    }
}