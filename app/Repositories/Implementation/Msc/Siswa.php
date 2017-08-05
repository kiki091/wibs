<?php

namespace App\Repositories\Implementation\Msc;

use App\Repositories\Contracts\Msc\Siswa as SiswaInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\Siswa as SiswaModel;
use App\Services\Transformation\Msc\Siswa as SiswaTransformation;
use Cache;
use LaravelLocalization;
use Session;
use DB;
use Auth;
use MscDataHelper;
use Hash;

class Siswa extends BaseImplementation implements SiswaInterface
{

    protected $siswa;
    protected $siswaTransformation;
    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';

    const PREFIX_IMAGE_NAME = 'wibs__profile__images';

    function __construct(SiswaModel $siswa, SiswaTransformation $siswaTransformation)
    {
        $this->siswa = $siswa;
        $this->siswaTransformation = $siswaTransformation;
        $this->uniqueIdImagePrefix = uniqid(self::PREFIX_IMAGE_NAME);
    }

    /**
     * Set MSC Auth Session
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function getData($params)
    {
        

        $siswaId = MscDataHelper::siswaId();

        if (empty($siswaId)) {
           return response()->json(['message' => 'No Privilege', 'status' => false]);
        }

        $params = [
            'id' => $siswaId,
            'is_active' => true,
        ];
        
        $siswaData = $this->siswa($params, 'asc', 'array', true);

        if(empty($siswaData))
            return response()->json(['message' => 'No data, please relogin back !!', 'status' => false]);

        return $this->siswaTransformation->getMscSiswaTransform($siswaData);
    }

    /**
     * edit data
     * @param id
     * @return array()
     */

    public function edit($data)
    {
        $params = [
            'id'    => $data['id']
        ];

         $siswaData = $this->siswa($params, 'asc', 'array', true);
         return $this->setResponse(trans('message.cms_success_get_data'), true, $this->siswaTransformation->getSingleForEditDataTransform($siswaData));
    }

    /**
     * store data
     * @param id
     * @return array()
     */

    public function store($data)
    {
        try {

            DB::beginTransaction();
            
            if(!$this->storeData($data) == true)
            {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            //TODO: THUMBNAIL UPLOAD
            if ($this->uploadFoto($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }
            DB::commit();
            return $this->setResponse(trans('message.cms_success_store_data_general'), true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }


    /**
     * store data into database
     * @param id
     * @return array()
     */
    protected function storeData($data)
    {
        try {

            $store          = $this->siswa->find($data['id']);
            $store->email   = isset($data['email']) ? $data['email'] : '';
            $store->no_telpon   = isset($data['no_telpon']) ? $data['no_telpon'] : '';

            if (!empty($data['foto'])) {
                $store->foto    = $this->uniqueIdImagePrefix . '_' .$data['foto']->getClientOriginalName();
            }

            if($save = $store->save())
            {
                $this->lastInsertId = $store->id;
            }

            return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Upload Thumbnail
     * @param $data
     * @return bool
     */
    protected function uploadFoto($data)
    {
        try {
            //TODO: Edit Mode
            if (isset($data['foto']) && !empty($data['foto'])) {
                if (!$this->fotoUploader($data)) {
                    return false;
                }
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

    }

    /**
     * foto Uploader
     * @param $data
     * @return bool
     */
    protected function fotoUploader($data)
    {
        if ($data['foto']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$data['foto']->getClientOriginalName();

            if (! $data['foto']->move('./' . SISWA_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_thumbnail_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['foto']->getErrorMessage();
            return false;
        }
    }

    /**
     * Get All User
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function siswa($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $siswa = $this->siswa
            ->with('tingkatan')
            ->with('kelas')
            ->with('wali_siswa');

        if(isset($params['id'])) {
            $siswa->id($params['id']);
        }

        if(isset($params['nis'])) {
            $siswa->nis($params['nis']);
        }

        if(isset($params['is_active'])) {
            $siswa->isActive($params['is_active']);
        }

        if(!$siswa->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $siswa->get()->toArray();
                } else {
                    return $siswa->first()->toArray();
                }
                break;
        }
    }

} 