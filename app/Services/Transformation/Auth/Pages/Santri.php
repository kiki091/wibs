<?php

namespace App\Services\Transformation\Auth\Pages;

class Santri
{
	/**
     * Get data santri Transformation
     * @param $data
     * @return array
     */
    public function getDataSantriTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataSantriTransform($data);
    }

    /**
     * Set data santri for edit Transformation
     * @param $data
     * @return array
     */
    public function getSingleForEditSantriTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleForEditSantriTransform($data);
    }

    /**
     * Set data santri transformation
     * @param $data
     * @return array
     */

    protected function setDataSantriTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [
                'id'            => isset($data['id']) ? $data['id'] : '',
                'nis'           => isset($data['nis']) ? $data['nis'] : '',
                'nama_lengkap'  => isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '',
                'foto_url'      => isset($data['foto']) ? asset(SISWA_IMAGES_DIRECTORY.rawurlencode($data['foto'])) : '',
                'is_active'     => isset($data['is_active']) ? $data['is_active'] : false,
            ];
        },$data);

        return $dataTransform;
    }


    /**
     * Set data santri for edit transformation
     * @param $data
     * @return array
     */

    protected function setSingleForEditSantriTransform($data)
    {
        $dataTransform['id']                       = isset($data['id']) ? $data['id'] : '';
        $dataTransform['nis']                      = isset($data['nis']) ? $data['nis'] : '';
        $dataTransform['nama_lengkap']             = isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '';
        $dataTransform['nama_panggilan']           = isset($data['nama_panggilan']) ? $data['nama_panggilan'] : '';
        $dataTransform['jenis_kelamin']            = isset($data['jenis_kelamin']) ? $data['jenis_kelamin'] : '';
        $dataTransform['tempat_lahir']             = isset($data['tempat_lahir']) ? $data['tempat_lahir'] : '';
        $dataTransform['agama']                    = isset($data['agama']) ? $data['agama'] : '';
        $dataTransform['kewarganegaraan']          = isset($data['kewarganegaraan']) ? $data['kewarganegaraan'] : '';
        $dataTransform['anak_ke']                  = isset($data['anak_ke']) ? $data['anak_ke'] : '';
        $dataTransform['jumlah_saudara_kandung']   = isset($data['jumlah_saudara_kandung']) ? $data['jumlah_saudara_kandung'] : '';
        $dataTransform['jumlah_saudara_tiri']      = isset($data['jumlah_saudara_tiri']) ? $data['jumlah_saudara_tiri'] : '';
        $dataTransform['status_orang_tua']         = isset($data['status_orang_tua']) ? $data['status_orang_tua'] : '';
        $dataTransform['jenis_bahasa']             = isset($data['jenis_bahasa']) ? $data['jenis_bahasa'] : '';
        $dataTransform['alamat']                   = isset($data['alamat']) ? $data['alamat'] : '';
        $dataTransform['no_telpon']                = isset($data['no_telpon']) ? $data['no_telpon'] : '';
        $dataTransform['status_tinggal']           = isset($data['status_tinggal']) ? $data['status_tinggal'] : '';
        $dataTransform['asrama_kost']              = isset($data['asrama_kost']) ? $data['asrama_kost'] : '';
        $dataTransform['jarak_rumah']              = isset($data['jarak_rumah']) ? $data['jarak_rumah'] : '';
        $dataTransform['golongan_darah']           = isset($data['golongan_darah']) ? $data['golongan_darah'] : '';
        $dataTransform['derita_penyakit']          = isset($data['derita_penyakit']) ? $data['derita_penyakit'] : '';
        $dataTransform['kelainan_jasmani']         = isset($data['kelainan_jasmani']) ? $data['kelainan_jasmani'] : '';
        $dataTransform['tinggi_badan']             = isset($data['tinggi_badan']) ? $data['tinggi_badan'] : '';
        $dataTransform['berat_badan']              = isset($data['berat_badan']) ? $data['berat_badan'] : '';
        $dataTransform['pendidikan_sebelumnya']    = isset($data['pendidikan_sebelumnya']) ? $data['pendidikan_sebelumnya'] : '';
        $dataTransform['lulusan_dari']             = isset($data['lulusan_dari']) ? $data['lulusan_dari'] : '';
        $dataTransform['alamat_sekolah']           = isset($data['alamat_sekolah']) ? $data['alamat_sekolah'] : '';
        $dataTransform['tanggal_nomer_sttb']       = isset($data['tanggal_nomer_sttb']) ? $data['tanggal_nomer_sttb'] : '';
        $dataTransform['lama_belajar']             = isset($data['lama_belajar']) ? $data['lama_belajar'] : '';
        $dataTransform['status_siswa']             = isset($data['status_siswa']) ? $data['status_siswa'] : '';
        $dataTransform['description']              = isset($data['description']) ? $data['description'] : '';
        $dataTransform['foto_url']                 = isset($data['foto']) ? asset(SISWA_IMAGES_DIRECTORY.rawurlencode($data['foto'])) : '';
        $dataTransform['email']                    = isset($data['email']) ? $data['email'] : '';

        return $dataTransform;
    }
}