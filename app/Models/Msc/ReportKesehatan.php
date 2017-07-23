<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class ReportKesehatan extends BaseModel
{
	protected $table = 'report_kesehatan';
    public $timestamps = false;

    protected $fillable = [
        'berat_badan',
        'tinggi_badan',
        'tensi_darah',
        'riwayat_sakit',
        'keadaan_siswa',
        'keadaan_siswa_other',
        'report_form'
    ];

    protected $guarded = [];

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
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }
    
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
    public function scopeReportForm($query, $params)
    {
        return $query->where('report_form', $params);
    }
}