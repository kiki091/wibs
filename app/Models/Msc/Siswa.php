<?php

namespace App\Models\Msc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $connection = 'msc';
	protected $table = 'siswa';
    
    protected $guard = 'siswa';
    public $timestamps = true;

    protected $fillable = [
        'nis',
        'nama_lengkap',
        'nama_panggilan'
    ];

    protected $guarded = ['siswa'];

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

    public function wali_siswa()
    {
        return $this->belongsTo('App\Models\Msc\WaliSiswa', 'id', 'siswa_id');
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