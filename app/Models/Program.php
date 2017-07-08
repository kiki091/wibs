<?php

namespace App\Models;

use App\Models\BaseModel;

class Program extends BaseModel
{
	protected $table = 'program';
    public $timestamps = false;

    protected $fillable = [
        'name'
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