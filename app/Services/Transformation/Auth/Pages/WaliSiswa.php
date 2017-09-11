<?php

namespace App\Services\Transformation\Auth\Pages;

class WaliSiswa
{
    /**
     * Get data santri Transformation
     * @param $data
     * @return array
     */
    public function getDataWaliSiswaTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataWaliSiswaTransform($data);
    }

    /**
     * Set data santri for edit Transformation
     * @param $data
     * @return array
     */
    public function getSingleForEditWaliSiswaTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleForEditWaliSiswaTransform($data);
    }

    /**
     * Set data santri transformation
     * @param $data
     * @return array
     */

    protected function setDataWaliSiswaTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [
                'id'                => isset($data['id']) ? $data['id'] : '',
                'nis_siswa'         =>isset($data['siswa']['nis']) ? $data['siswa']['nis'] : '',
                'nama_siswa'        => isset($data['siswa']['nama_lengkap']) ? $data['siswa']['nama_lengkap'] : '',
                'nama_lengkap_ayah' => isset($data['nama_lengkap_ayah']) ? $data['nama_lengkap_ayah'] : '',
                'nama_lengkap_ibu'  => isset($data['nama_lengkap_ibu']) ? $data['nama_lengkap_ibu'] : '',
                'tingkatan'         => isset($data['siswa']['tingkatan']['title_alias']) ? $data['siswa']['tingkatan']['title_alias'] : '',
                'is_active'         => isset($data['is_active']) ? $data['is_active'] : false,
            ];
        },$data);

        return $dataTransform;
    }


    /**
     * Set data santri for edit transformation
     * @param $data
     * @return array
     */

    protected function setSingleForEditWaliSiswaTransform($data)
    {
        $dataTransform['id']                         = isset($data['id']) ? $data['id'] : '';
        $dataTransform['nama_lengkap_ayah']          = isset($data['nama_lengkap_ayah']) ? $data['nama_lengkap_ayah'] : '';
        $dataTransform['nama_lengkap_ibu']           = isset($data['nama_lengkap_ibu']) ? $data['nama_lengkap_ibu'] : '';
        $dataTransform['tempat_lahir_ayah']          = isset($data['tempat_lahir_ayah']) ? $data['tempat_lahir_ayah'] : '';
        $dataTransform['tempat_lahir_ibu']           = isset($data['tempat_lahir_ibu']) ? $data['tempat_lahir_ibu'] : '';
        $dataTransform['tanggal_lahir_ayah']         = isset($data['tanggal_lahir_ayah']) ? $data['tanggal_lahir_ayah'] : '';
        $dataTransform['tanggal_lahir_ibu']          = isset($data['tanggal_lahir_ibu']) ? $data['tanggal_lahir_ibu'] : '';
        $dataTransform['kewarganegaraan_ayah']       = isset($data['kewarganegaraan_ayah']) ? $data['kewarganegaraan_ayah'] : '';
        $dataTransform['kewarganegaraan_ibu']        = isset($data['kewarganegaraan_ibu']) ? $data['kewarganegaraan_ibu'] : '';
        $dataTransform['pendidikan_ayah']            = isset($data['pendidikan_ayah']) ? $data['pendidikan_ayah'] : '';
        $dataTransform['pendidikan_ibu']             = isset($data['pendidikan_ibu']) ? $data['pendidikan_ibu'] : '';
        $dataTransform['pekerjaan_ayah']             = isset($data['pekerjaan_ayah']) ? $data['pekerjaan_ayah'] : '';
        $dataTransform['pekerjaan_ibu']              = isset($data['pekerjaan_ibu']) ? $data['pekerjaan_ibu'] : '';
        $dataTransform['penghasilan_bulanan_ayah']   = isset($data['penghasilan_bulanan_ayah']) ? $data['penghasilan_bulanan_ayah'] : '';
        $dataTransform['penghasilan_bulanan_ibu']    = isset($data['penghasilan_bulanan_ibu']) ? $data['penghasilan_bulanan_ibu'] : '';
        $dataTransform['email_ayah']                 = isset($data['email_ayah']) ? $data['email_ayah'] : '';
        $dataTransform['email_ibu']                  = isset($data['email_ibu']) ? $data['email_ibu'] : '';
        $dataTransform['status_ayah']                = isset($data['status_ayah']) ? $data['status_ayah'] : '';
        $dataTransform['status_ibu']                 = isset($data['status_ibu']) ? $data['status_ibu'] : '';
        $dataTransform['siswa_id']                   = isset($data['siswa_id']) ? $data['siswa_id'] : '';

        return $dataTransform;
    }
}