<?php

namespace App\Models\Msc;

use App\Models\BaseModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
	protected $table = 'siswa';
    public $timestamps = false;

    protected $fillable = [
        'nis',
        'nama_lengkap',
        'nama_panggilan'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function tingkatan()
    {
        return $this->belongsTo('App\Models\Msc\Tingkatan', 'tingkatan_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Msc\Kelas', 'kelas_id', 'id');
    }

    public function role_siswa()
    {
        return $this->belongsTo('App\Models\Msc\RoleSiswa', 'id', 'siswa_id')->with('privilage_siswa');
    }

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeIsActive($query, $params = true)
    {
        return $query->where('is_active', $params);
    }

    /**
     * @param $query
     */
    public function scopeNis($query, $params)
    {
        return $query->where('nis', $params);
    }

    /**
     * @param $query
     */
    public function scopeFullName($query, $params)
    {
        return $query->where('nama_lengkap', $params);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
}