<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class SiswaPindahan extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'siswa_pindahan';
    public $timestamps = false;
    protected $guard = 'siswa';

    protected $fillable = [
        'tanggal_masuk'
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
}