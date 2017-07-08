<?php

namespace App\Models;

use App\Models\BaseModel;

class WaliSiswa extends BaseModel
{
	protected $table = 'wali_siswa';
    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa', 'id', 'siswa_id');
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