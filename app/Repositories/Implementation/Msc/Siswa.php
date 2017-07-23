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

    function __construct(SiswaModel $siswa, SiswaTransformation $siswaTransformation)
    {
        $this->siswa = $siswa;
        $this->siswaTransformation = $siswaTransformation;
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
     * Get All User
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function siswa($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $siswa = $this->siswa
            ->with('tingkatan')
            ->with('kelas');

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