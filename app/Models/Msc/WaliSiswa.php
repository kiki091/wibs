<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class WaliSiswa extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'wali_siswa';
    
    protected $guard = 'siswa';
    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap'
    ];

    protected $guarded = ['siswa'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function siswa()
    {
        return $this->belongsTo('App\Models\Msc\Siswa', 'id', 'siswa_id');
    }

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }

    /**
     * @param $query
     */
    public function scopeFullName($query, $params)
    {
        return $query->where('nama_lengkap', $params);
    }
}