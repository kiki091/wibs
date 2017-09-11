<?php

namespace App\Services\Transformation\Auth\Pages;

class ReportQuran
{
    /**
     * Get data santri Transformation
     * @param $data
     * @return array
     */
    public function getDataReportQuranTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataReportQuranTransform($data);
    }

    /**
     * Set data santri for edit Transformation
     * @param $data
     * @return array
     */
    public function getSingleForEditReportQuranTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleForEditReportQuranTransform($data);
    }

    /**
     * Set data transformation
     * @param $data
     * @return array
     */

    protected function setDataReportQuranTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [
                'id'                => isset($data['id']) ? $data['id'] : '',
                'nis_siswa'         =>isset($data['siswa']['nis']) ? $data['siswa']['nis'] : '',
                'nama_siswa'        => isset($data['siswa']['nama_lengkap']) ? $data['siswa']['nama_lengkap'] : '',
                'disiplin'          => isset($data['disiplin']) ? $data['disiplin'] : '',
                'total_hafalan'     => isset($data['total_hafalan']) ? $data['total_hafalan'] : '',
                'tingkatan'         => isset($data['siswa']['tingkatan']['title_alias']) ? $data['siswa']['tingkatan']['title_alias'] : '',
                'nilai_hafalan'     => isset($data['nilai_hafalan']) ? $data['nilai_hafalan'] : '',
                'nilai_tajwid'      => isset($data['nilai_tajwid']) ? $data['nilai_tajwid'] : '',
                'nilai_mahraj'      => isset($data['nilai_mahraj']) ? $data['nilai_mahraj'] : '',
                'description'       => isset($data['description']) ? $data['description'] : '',
                'report_from'       => isset($data['report_from']) ? $data['report_from'] : '',
            ];
        },$data);

        return $dataTransform;
    }


    /**
     * Set data for edit transformation
     * @param $data
     * @return array
     */

    protected function setSingleForEditReportQuranTransform($data)
    {
        $dataTransform['id']              = isset($data['id']) ? $data['id'] : '';
        $dataTransform['disiplin']        = isset($data['disiplin']) ? $data['disiplin'] : '';
        $dataTransform['total_hafalan']   = isset($data['total_hafalan']) ? $data['total_hafalan'] : '';
        $dataTransform['nilai_hafalan']   = isset($data['nilai_hafalan']) ? $data['nilai_hafalan'] : '';
        $dataTransform['nilai_tajwid']    = isset($data['nilai_tajwid']) ? $data['nilai_tajwid'] : '';
        $dataTransform['nilai_mahraj']    = isset($data['nilai_mahraj']) ? $data['nilai_mahraj'] : '';
        $dataTransform['description']     = isset($data['description']) ? $data['description'] : '';
        $dataTransform['report_from']     = isset($data['report_from']) ? $data['report_from'] : '';

        return $dataTransform;
    }
}