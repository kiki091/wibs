<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class Tingkatan extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'tingkatan';
    
    protected $guard = 'siswa';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug'
    ];

    protected $guarded = ['siswa'];

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