<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 */
class Privilage extends Model
{
    protected $connection = 'auth';
    protected $table = 'privilage';
    protected $guard = 'users';

    public $timestamps = true;

    protected $fillable = [
        'update_at',
        'created_by'
    ];

    protected $guarded = ['users'];

    public function role_user()
    {
        return $this->belongsTo('App\Models\Auth\Role', 'id', 'privilage_id');
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