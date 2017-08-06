<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class ReportHafalanQuran extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'report_hafalan_quran';
    public $timestamps = false;
    protected $guard = 'siswa';

    protected $fillable = [
        'disiplin',
        'total_hafalan',
        'nilai_hafalan',
        'nilai_tajwid',
        'nilai_mahraj',
        'description',
        'report_form'
    ];

    protected $guarded = ['siswa'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function siswa()
    {
        return $this->belongsTo('App\Models\Msc\Siswa', 'siswa_id', 'id');
    }

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeSiswaId($query, $params)
    {
        return $query->where('siswa_id', $params);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }

    /**
     * @param $query
     */
    public function scopeReportForm($query, $params)
    {
        return $query->where('report_form', $params);
    }
}