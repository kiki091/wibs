<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class Program extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'program';
    public $timestamps = false;
    protected $guard = 'siswa';

    protected $fillable = [
        'name'
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