<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class Kelas extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'kelas';
    public $timestamps = false;
    protected $guard = 'siswa';

    protected $fillable = [
        'created_at',
        'updated_at',
        'created_by'
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