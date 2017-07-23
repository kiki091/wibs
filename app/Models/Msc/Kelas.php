<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class Kelas extends BaseModel
{
	protected $table = 'kelas';
    public $timestamps = false;

    protected $fillable = [
        'created_at',
        'updated_at',
        'created_by'
    ];

    protected $guarded = [];

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}