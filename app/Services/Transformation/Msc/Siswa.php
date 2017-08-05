<?php

namespace App\Services\Transformation\Msc;

class Siswa
{
	/**
     * Get Auth Session Transformation
     * @param $data
     * @return array
     */
    public function getMscSiswaTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setMscSiswaTransform($data);
    }

    /**
     * Get Single Data For Edit Transformation
     * @param $data
     * @return array
     */
    public function getSingleForEditDataTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleForEditDataTransform($data);
    }

    /**
     * Set Auth Session Transformation
     * @param $data
     * @return array
     */
    protected function setMscSiswaTransform($data)
    {
        $dataTransform['siswa_id']          = isset($data['id']) ? $data['id'] : '';
        $dataTransform['nis']               = isset($data['nis']) ? $data['nis'] : '';
        $dataTransform['nama_lengkap']      = isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '';
        $dataTransform['nama_panggilan']    = isset($data['nama_panggilan']) ? $data['nama_panggilan'] : '';
        $dataTransform['jenis_kelamin']     = isset($data['jenis_kelamin']) ? $this->defineGenderSiswa($data['jenis_kelamin']) : '';
        $dataTransform['tempat_lahir']      = isset($data['tempat_lahir']) ? $data['tempat_lahir'] : '';
        $dataTransform['agama']             = isset($data['agama']) ? $this->defineReligionSiswa($data['agama']) : '';
        $dataTransform['kewarganegaraan']   = isset($data['kewarganegaraan']) ? $data['kewarganegaraan'] : '';
        $dataTransform['alamat']            = isset($data['alamat']) ? $data['alamat'] : '';
        $dataTransform['no_telpon']         = isset($data['no_telpon']) ? $data['no_telpon'] : '';
        $dataTransform['description']       = isset($data['description']) ? $data['description'] : '';
        $dataTransform['email']             = isset($data['email']) ? $data['email'] : '';
        $dataTransform['kelas']             = isset($data['kelas']['title']) ? $data['kelas']['title'] : '';
        $dataTransform['tingkatan']         = isset($data['tingkatan']['title_alias']) ? $data['tingkatan']['title_alias'] : '';
        $dataTransform['foto_url']        = isset($data['foto']) ? asset(SISWA_IMAGES_DIRECTORY.rawurlencode($data['foto'])) : DEFAULT_AVATAR_IMAGE;

        $dataTransform['nama_ayah']         = isset($data['wali_siswa']['nama_lengkap_ayah']) ? $data['wali_siswa']['nama_lengkap_ayah'] : '';
        $dataTransform['nama_ibu']          = isset($data['wali_siswa']['nama_lengkap_ibu']) ? $data['wali_siswa']['nama_lengkap_ibu'] : '';
        
        return $dataTransform;
    }

    /**
     * Declare define gender
     * @param $data
     * @return array
     */

    protected function defineGenderSiswa($data)
    {
        switch ($data) {
            case '1':
                $data = 'Laki-laki';
                break;

            case '2':
                $data = 'Perempuan';
                break;
            
            default:
                'Laki-laki';
                break;
        }

        return $data;
    }

    /**
     * Declare define religion
     * @param $data
     * @return array
     */

    protected function defineReligionSiswa($data)
    {
        switch ($data) {
            case '1':
                $data = 'Islam';
                break;

            case '2':
                $data = 'Kristen Katolik';
                break;

            case '3':
                $data = 'Kristen Protestan';
                break;

            case '4':
                $data = 'Hindu';
                break;

            case '5':
                $data = 'Budha';
                break;
            
            default:
                'Lainnya';
                break;
        }

        return $data;
    }

    protected function setSingleForEditDataTransform($data)
    {

        $dataTransform['siswa_id']       = isset($data['id']) ? $data['id'] : '';
        $dataTransform['email']          = isset($data['email']) ? $data['email'] : '';
        $dataTransform['no_telpon']      = isset($data['no_telpon']) ? $data['no_telpon'] : '';
        $dataTransform['nis']            = isset($data['nis']) ? $data['nis'] : '';
        $dataTransform['nama_lengkap']   = isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '';
        $dataTransform['nama_panggilan'] = isset($data['nama_panggilan']) ? $data['nama_panggilan'] : '';
        $dataTransform['jenis_kelamin']  = isset($data['jenis_kelamin']) ? $data['jenis_kelamin'] : '';
        $dataTransform['tempat_lahir']   = isset($data['tempat_lahir']) ? $data['tempat_lahir'] : '';
        $dataTransform['agama']          = isset($data['agama']) ? $data['agama'] : '';
        $dataTransform['kewarganegaraan'] = isset($data['kewarganegaraan']) ? $data['kewarganegaraan'] : '';
        $dataTransform['alamat']         = isset($data['alamat']) ? $data['alamat'] : '';
        $dataTransform['description']    = isset($data['description']) ? $data['description'] : '';
        $dataTransform['kelas']          = isset($data['kelas']) ? $data['kelas'] : '';
        $dataTransform['tingkatan']      = isset($data['tingkatan']) ? $data['tingkatan'] : '';
        $dataTransform['foto_url']       = isset($data['foto']) ? asset(SISWA_IMAGES_DIRECTORY.rawurlencode($data['foto'])) : DEFAULT_AVATAR_IMAGE;

        return $dataTransform;
    }
}