<?php

namespace App\Models;

use App\Models\BaseModel;

class SiswaPindahan extends BaseModel
{
	protected $table = 'siswa_pindahan';
    public $timestamps = false;

    protected $fillable = [
        'tanggal_masuk'
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
}