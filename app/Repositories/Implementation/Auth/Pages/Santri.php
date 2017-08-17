<?php

namespace App\Repositories\Implementation\Auth\Pages;

use App\Repositories\Contracts\Auth\Pages\Santri as SantriInterface;
use App\Repositories\Implementation\BaseImplementation;
use App\Models\Msc\Siswa as SantriModel;
use App\Models\Msc\SiswaPindahan as SantriPindahanModel;
use App\Services\Transformation\Auth\Pages\Santri as SantriTransformation;

use Carbon\Carbon;
use DataHelper;
use Cache;
use Session;
use DB;
use Hash;

class Santri extends BaseImplementation implements SantriInterface
{

    protected $santri;
    protected $santriPindahan;
    protected $santriTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';
    
    const PREFIX_IMAGE_NAME = 'wibs__profile__images';

    function __construct(SantriModel $santri, SantriPindahanModel $santriPindahan, SantriTransformation $santriTransformation)
    {

        $this->santri = $santri;
        $this->santriPindahan = $santriPindahan;
        $this->santriTransformation = $santriTransformation;
        $this->uniqueIdImagePrefix = uniqid(self::PREFIX_IMAGE_NAME);
    }

    /** 
     * get data santri
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        $params = [
            'current_location_slug' => $this->currentLocation,
        ];

        $dataSantri = $this->santri($params, 'desc', 'array', false);

        return $this->santriTransformation->getDataSantriTransform($dataSantri);
    }

    /** 
     * edit data santri
     * @param $data
     * @return array
     */

    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : '',
        ];

        $dataSantri = $this->santri($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->santriTransformation->getSingleForEditSantriTransform($dataSantri));
    }

    /** 
     * change status data santri
     * @param $data
     * @return array
     */

    public function changeStatus($data)
    {
        try {
            if (!isset($data['id']) && empty($data['id']))
                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->santri
                ->id($data['id'])
                ->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
            ];

            $changeStatus = $this->santri
                ->id($data['id'])
                ->update($updatedData);

            if($changeStatus) {
                DB::commit();
                return $this->setResponse(trans('message.cms_success_update_status_general'), true);
            }

            DB::rollBack();
            return $this->setResponse(trans('message.cms_failed_update_status_general'), false);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /** 
     * store data santri
     * @param $data
     * @return array
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

            if($data['status_siswa'] == '2' && !$this->isEditMode($data)) {

                if(!$this->storeDataPindahan($data) == true)
                {
                    DB::rollBack();
                    return $this->setResponse($this->message, false);
                }
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
     * store data santri into database
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $store = $this->santri;

            if ($this->isEditMode($data)) {
                $store                          = $this->santri->find($data['id']);

                if (!empty($data['foto'])) {
                    $store->foto                = $this->uniqueIdImagePrefix . '_' .$data['foto']->getClientOriginalName();
                }

                $store->updated_at              = $this->mysqlDateTimeFormat();

            } else {
                $store->nis                     = isset($data['nis']) ? $data['nis'] : '';
                $store->password                = isset($data['password']) ? Hash::make($data['confirm_password']) : '';
                $store->foto                    = isset($data['foto']) ? $this->uniqueIdImagePrefix . '_' .$data['foto']->getClientOriginalName() : '';
                $store->is_active               = true;
                $store->created_at              = $this->mysqlDateTimeFormat();
                $store->created_by              = DataHelper::userId();
            }

            $store->nis                         = isset($data['nis']) ? $data['nis'] : '';
            $store->nama_lengkap                = isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '';
            $store->nama_panggilan              = isset($data['nama_panggilan']) ? $data['nama_panggilan'] : '';
            $store->jenis_kelamin               = isset($data['jenis_kelamin']) ? $data['jenis_kelamin'] : '';
            $store->tempat_lahir                = isset($data['tempat_lahir']) ? $data['tempat_lahir'] : '';
            $store->tanggal_lahir               = isset($data['tanggal_lahir']) ? $data['tanggal_lahir'] : '';
            $store->agama                       = isset($data['agama']) ? $data['agama'] : '';
            $store->kewarganegaraan             = isset($data['kewarganegaraan']) ? $data['kewarganegaraan'] : '';
            $store->anak_ke                     = isset($data['anak_ke']) ? $data['anak_ke'] : '';
            $store->jumlah_saudara_kandung      = isset($data['jumlah_saudara_kandung']) ? $data['jumlah_saudara_kandung'] : '';
            $store->jumlah_saudara_tiri         = isset($data['jumlah_saudara_tiri']) ? $data['jumlah_saudara_tiri'] : '';
            $store->status_orang_tua            = isset($data['status_orang_tua']) ? $data['status_orang_tua'] : '';
            $store->jenis_bahasa                = isset($data['jenis_bahasa']) ? $data['jenis_bahasa'] : '';
            $store->alamat                      = isset($data['alamat']) ? $data['alamat'] : '';
            $store->no_telpon                   = isset($data['no_telpon']) ? $data['no_telpon'] : '';
            $store->status_tinggal              = isset($data['status_tinggal']) ? $data['status_tinggal'] : '';
            $store->asrama_kost                 = isset($data['asrama_kost']) ? $data['asrama_kost'] : '';
            $store->jarak_rumah                 = isset($data['jarak_rumah']) ? $data['jarak_rumah'] : '';
            $store->golongan_darah              = isset($data['golongan_darah']) ? $data['golongan_darah'] : '';
            $store->derita_penyakit             = isset($data['derita_penyakit']) ? $data['derita_penyakit'] : '';
            $store->kelainan_jasmani            = isset($data['kelainan_jasmani']) ? $data['kelainan_jasmani'] : '';
            $store->tinggi_badan                = isset($data['tinggi_badan']) ? $data['tinggi_badan'] : '';
            $store->berat_badan                 = isset($data['berat_badan']) ? $data['berat_badan'] : '';
            $store->pendidikan_sebelumnya       = isset($data['pendidikan_sebelumnya']) ? $data['pendidikan_sebelumnya'] : '';
            $store->lulusan_dari                = isset($data['lulusan_dari']) ? $data['lulusan_dari'] : '';
            $store->alamat_sekolah              = isset($data['alamat_sekolah']) ? $data['alamat_sekolah'] : '';
            $store->tanggal_nomer_sttb          = isset($data['tanggal_nomer_sttb']) ? $data['tanggal_nomer_sttb'] : '';
            $store->lama_belajar                = isset($data['lama_belajar']) ? $data['lama_belajar'] : '';
            $store->kelas_id                    = isset($data['kelas_id']) ? $data['kelas_id'] : '';
            $store->tingkatan_id                = isset($data['tingkatan_id']) ? $data['tingkatan_id'] : '';
            $store->status_siswa                = isset($data['status_siswa']) ? $data['status_siswa'] : '';
            $store->description                 = isset($data['description']) ? $data['description'] : '';
            $store->email                       = isset($data['email']) ? $data['email'] : '';


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


    protected function storeDataPindahan($data)
    {
        try {

            $store = $this->santriPindahan;

            $store->asal_sekolah            = isset($data['asal_sekolah']) ? $data['asal_sekolah'] : '';
            $store->alamat_sekolah_lama     = isset($data['alamat_sekolah_lama']) ? $data['alamat_sekolah_lama'] : '';
            $store->alasan_pindah           = isset($data['alasan_pindah']) ? $data['alasan_pindah'] : '';
            $store->status_berpindah        = true;
            $store->tanggal_masuk           = $this->mysqlDateTimeFormat();
            $store->created_at              = $this->mysqlDateTimeFormat();
            $store->created_by              = DataHelper::userId();
            $store->siswa_id                = $this->lastInsertId;

            $save = $store->save();

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
     * Get All santri
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function santri($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $santri = $this->santri->with(['tingkatan','kelas','wali_siswa']);

        if(isset($params['current_location_slug']) && $params['current_location_slug']) {
            $santri->whereHas('tingkatan', function($q) use($params){
                $q->slug($params['current_location_slug']);
            });
        }

        if(isset($params['id'])) {
            $santri->santriId($params['id']);
        }

        if(isset($params['is_active'])) {
            $santri->isActive($params['is_active']);
        }

        if(isset($params['order'])) {
            $santri->orderBy($params['order'], $orderType);
        }

        if(isset($params['email'])) {
            $santri->email($params['email']);
        }

        if(isset($params['nis'])) {
            $santri->nis($params['nis']);
        }

        if(!$santri->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $santri->get()->toArray();
                } else {
                    return $santri->first()->toArray();
                }
                break;
        }
    }

    /**
     * Check need edit Mode or No
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }
}