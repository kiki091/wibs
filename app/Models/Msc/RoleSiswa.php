<?php

namespace App\Models\Msc;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 */
class RoleSiswa extends Model
{
    protected $table = 'role_siswa';

    public $timestamps = true;

    protected $fillable = [
        'update_at',
        'created_by'
    ];

    protected $guarded = [];

    public function privilage_siswa()
    {
        return $this->belongsTo('App\Models\Msc\PrivilageSiswa', 'privilage_siswa_id', 'id');
    }


    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}