<?php

namespace App\Services\Transformation\Msc\Auth;

class Siswa
{
	/**
     * Get Auth Session Transformation
     * @param $data
     * @return array
     */
    public function getMscAuthSessionTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setMscAuthSessionTransform($data);
    }

    /**
     * Set Auth Session Transformation
     * @param $data
     * @return array
     */
    protected function setMscAuthSessionTransform($data)
    {
        $dataTransform['siswa_id']               = isset($data['id']) ? $data['id'] : '';
        $dataTransform['nis']                  = isset($data['nis']) ? $data['nis'] : '';
        $dataTransform['nama_lengkap']                  = isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '';
        $dataTransform['email']                 = isset($data['email']) ? $data['email'] : '';
        $dataTransform['siswa_privilage']        = $this->setSiswaRole($data['role_siswa']);
        $dataTransform['siswa_location']         = $this->setSiswaLocation($data['tingkatan']);
        
        return $dataTransform;
    }

    /**
     * Set Auth role_siswa Transformation
     * @param $data
     * @return array
     */

    protected function setSiswaRole($data)
    {
        $dataTransform['role_id'] = isset($data['privilage_siswa']['id']) ? $data['privilage_siswa']['id'] : '';
        $dataTransform['role_name'] = isset($data['privilage_siswa']['name']) ? $data['privilage_siswa']['name'] : '';
        $dataTransform['role_description'] = isset($data['privilage_siswa']['description']) ? $data['privilage_siswa']['description'] : '';
        
        return $dataTransform;
    }

    /**
     * Set Auth Location Access Transformation
     * @param $data
     * @return array
     */

    protected function setSiswaLocation($data)
    {
        $dataTransform['title'] = isset($data['title']) ? $data['title'] : '';
        $dataTransform['slug'] = isset($data['slug']) ? $data['slug'] : '';

        return $dataTransform;
    }
}