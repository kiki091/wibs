<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class Hadis extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'hadis';
    
    public $timestamps = false;
    protected $guard = 'siswa';

    protected $fillable = [
        'awal_hadis',
        'perawi_dari_sahabat',
        'imam_ahlul_hadis'
    ];

    protected $guarded = ['siswa'];

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}