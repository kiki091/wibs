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
        $dataTransform['id']                    = isset($data['id']) ? $data['id'] : '';
        $dataTransform['nama_lengkap_ayah']     = isset($data['nama_lengkap_ayah']) ? $data['nama_lengkap_ayah'] : '';
        $dataTransform['nama_lengkap_ibu']      = isset($data['nama_lengkap_ibu']) ? $data['nama_lengkap_ibu'] : '';
        $dataTransform['tempat_lahir']          = isset($data['tempat_lahir']) ? $data['tempat_lahir'] : '';
        $dataTransform['tanggal_lahir']         = isset($data['tanggal_lahir']) ? $data['tanggal_lahir'] : '';
        $dataTransform['agama']                 = isset($data['agama']) ? $data['agama'] : '';
        $dataTransform['kewarganegaraan']       = isset($data['kewarganegaraan']) ? $data['kewarganegaraan'] : '';
        $dataTransform['pendidikan']            = isset($data['pendidikan']) ? $data['pendidikan'] : '';
        $dataTransform['pekerjaan']             = isset($data['pekerjaan']) ? $data['pekerjaan'] : '';
        $dataTransform['penghasilan_bulanan']   = isset($data['penghasilan_bulanan']) ? $data['penghasilan_bulanan'] : '';
        $dataTransform['alamat_kantor']         = isset($data['alamat_kantor']) ? $data['alamat_kantor'] : '';
        $dataTransform['telpon_kantor']         = isset($data['telpon_kantor']) ? $data['telpon_kantor'] : '';
        $dataTransform['alamat_rumah']          = isset($data['alamat_rumah']) ? $data['alamat_rumah'] : '';
        $dataTransform['no_telepon']            = isset($data['no_telepon']) ? $data['no_telepon'] : '';
        $dataTransform['email']                 = isset($data['email']) ? $data['email'] : '';
        $dataTransform['status']                = isset($data['status']) ? $data['status'] : '';
        $dataTransform['siswa_id']              = isset($data['siswa_id']) ? $data['siswa_id'] : '';

        return $dataTransform;
    }
}