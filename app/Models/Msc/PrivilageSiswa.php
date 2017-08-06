<?php

namespace App\Models\Msc;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 */
class PrivilageSiswa extends Model
{
    protected $connection = 'msc';
    protected $table = 'privilage_siswa';
    protected $guard = 'siswa';

    public $timestamps = true;

    protected $fillable = [
        'update_at',
        'created_by'
    ];

    protected $guarded = ['siswa'];

    public function role_siswa()
    {
        return $this->belongsTo('App\Models\Msc\RoleSiswa', 'id', 'privilage_id');
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