<?php

namespace App\Services\Transformation\Auth\Pages;

class ReportKesehatan
{
    /**
     * Get data santri Transformation
     * @param $data
     * @return array
     */
    public function getDataReportKesehatanTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataReportKesehatanTransform($data);
    }

    /**
     * Set data santri for edit Transformation
     * @param $data
     * @return array
     */
    public function getSingleForEditReportKesehatanTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleForEditReportKesehatanTransform($data);
    }

    /**
     * Set data transformation
     * @param $data
     * @return array
     */

    protected function setDataReportKesehatanTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [
                'id'                    => isset($data['id']) ? $data['id'] : '',
                'nis_siswa'             =>isset($data['siswa']['nis']) ? $data['siswa']['nis'] : '',
                'nama_siswa'            => isset($data['siswa']['nama_lengkap']) ? $data['siswa']['nama_lengkap'] : '',
                'berat_badan'           => isset($data['berat_badan']) ? $data['berat_badan'] : '',
                'tinggi_badan'          => isset($data['tinggi_badan']) ? $data['tinggi_badan'] : '',
                'tingkatan'             => isset($data['siswa']['tingkatan']['title_alias']) ? $data['siswa']['tingkatan']['title_alias'] : '',
                'tensi_darah'           => isset($data['tensi_darah']) ? $data['tensi_darah'] : '',
                'golongan_darah'        => isset($data['golongan_darah']) ? $data['golongan_darah'] : '',
                'riwayat_sakit'         => isset($data['riwayat_sakit']) ? $data['riwayat_sakit'] : '',
                'keadaan_siswa'         => isset($data['keadaan_siswa']) ? $data['keadaan_siswa'] : '',
                'keadaan_siswa_other'   => isset($data['keadaan_siswa_other']) ? $data['keadaan_siswa_other'] : '',
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

    protected function setSingleForEditReportKesehatanTransform($data)
    {
        $dataTransform['id']                 = isset($data['id']) ? $data['id'] : '';
        $dataTransform['berat_badan']        = isset($data['berat_badan']) ? $data['berat_badan'] : '';
        $dataTransform['tinggi_badan']       = isset($data['tinggi_badan']) ? $data['tinggi_badan'] : '';
        $dataTransform['tensi_darah']        = isset($data['tensi_darah']) ? $data['tensi_darah'] : '';
        $dataTransform['golongan_darah']     = isset($data['golongan_darah']) ? $data['golongan_darah'] : '';
        $dataTransform['riwayat_sakit']      = isset($data['riwayat_sakit']) ? $data['riwayat_sakit'] : '';
        $dataTransform['keadaan_siswa']      = isset($data['keadaan_siswa']) ? $data['keadaan_siswa'] : '';
        $dataTransform['keadaan_siswa_other']= isset($data['keadaan_siswa_other']) ? $data['keadaan_siswa_other'] : '';
        $dataTransform['report_from']        = isset($data['report_from']) ? $data['report_from'] : '';

        return $dataTransform;
    }
}