<?php

namespace App\Models;

use App\Models\BaseModel;

class Tingkatan extends BaseModel
{
	protected $table = 'tingkatan';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug'
    ];

    protected $guarded = [];

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeIsActive($query, $params = true)
    {
        return $query->where('is_active', $params);
    }

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeSlug($query, $params)
    {
        return $query->where('slug', $params);
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