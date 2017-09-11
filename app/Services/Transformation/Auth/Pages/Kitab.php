<?php

namespace App\Services\Transformation\Auth\Pages;

class Kitab
{
    /**
     * Get data santri Transformation
     * @param $data
     * @return array
     */
    public function getDataKitabTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataKitabTransform($data);
    }

    /**
     * Set data santri for edit Transformation
     * @param $data
     * @return array
     */
    public function getSingleForEditKitabTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleForEditKitabTransform($data);
    }

    /**
     * Set data transformation
     * @param $data
     * @return array
     */

    protected function setDataKitabTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [
                'id'              => isset($data['id']) ? $data['id'] : '',
                'title'           => isset($data['title']) ? $data['title'] : '',
                'nama_penulis'    => isset($data['nama_penulis']) ? $data['nama_penulis'] : '',
            ];
        },$data);

        return $dataTransform;
    }


    /**
     * Set data for edit transformation
     * @param $data
     * @return array
     */

    protected function setSingleForEditKitabTransform($data)
    {
        $dataTransform['id']           = isset($data['id']) ? $data['id'] : '';
        $dataTransform['title']        = isset($data['title']) ? $data['title'] : '';
        $dataTransform['description']  = isset($data['description']) ? $data['description'] : '';
        $dataTransform['nama_penulis'] = isset($data['nama_penulis']) ? $data['nama_penulis'] : '';
        $dataTransform['penerbit']     = isset($data['penerbit']) ? $data['penerbit'] : '';
        $dataTransform['tahun']        = isset($data['tahun']) ? $data['tahun'] : '';
        $dataTransform['jilid']        = isset($data['jilid']) ? $data['jilid'] : '';

        return $dataTransform;
    }
}