<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class ReportHadis extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'report_hafalan_hadits';
    
    public $timestamps = false;
    protected $guard = 'siswa';

    protected $fillable = [
        'kedisiplinan',
        'total_hafalan',
        'kekuatan_hafalan',
        'nilai_hafalan',
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
    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function kitab()
    {
        return $this->belongsTo('App\Models\Msc\Kitab', 'kitab_id', 'id');
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