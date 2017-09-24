<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 */
class UserLocation extends Model
{
    protected $connection = 'auth';
    protected $table = 'user_location';
    protected $guard = 'users';

    public $timestamps = true;

    protected $fillable = [
        'update_at',
        'created_by'
    ];

    protected $guarded = ['users'];


    public function location()
    {
        return $this->belongsTo('App\Models\Auth\Location', 'location_id', 'id');
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