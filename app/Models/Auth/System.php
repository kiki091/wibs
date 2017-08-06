<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 */
class System extends Model
{
    protected $connection = 'auth';
    protected $table = 'system';
    protected $guard = 'users';

    public $timestamps = true;

    protected $fillable = [
        'update_at',
        'created_by'
    ];

    protected $guarded = ['users'];


    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}