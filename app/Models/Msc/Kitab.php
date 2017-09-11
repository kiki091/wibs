<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class Kitab extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'kitab';
    
    public $timestamps = false;
    protected $guard = 'siswa';

    protected $fillable = [
        'title',
        'description',
        'nama_penulis',
        'penerbit',
        'tahun',
        'jilid'
    ];

    protected $guarded = ['siswa'];
    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}