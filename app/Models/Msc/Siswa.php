<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class Siswa extends BaseModel
{
	protected $table = 'siswa';
    public $timestamps = false;

    protected $fillable = [
        'nis',
        'nama_lengkap',
        'nama_panggilan'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function tingkatan()
    {
        return $this->belongsTo('App\Models\Msc\Tingkatan', 'id', 'tingkatan_id');
    }

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeIsActive($query, $params = true)
    {
        return $query->where('is_active', $params);
    }

    /**
     * @param $query
     */
    public function scopeNis($query, $params)
    {
        return $query->where('nis', $params);
    }

    /**
     * @param $query
     */
    public function scopeFullName($query, $params)
    {
        return $query->where('nama_lengkap', $params);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}