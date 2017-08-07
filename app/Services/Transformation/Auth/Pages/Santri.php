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
        dd($data);
    }
}