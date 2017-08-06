<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class ScoreActivitie extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'score_activitie';
    protected $guard = 'siswa';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'value',
        'remarks'
    ];

    protected $guarded = ['siswa'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function sub_program()
    {
        return $this->belongsTo('App\Models\Msc\SubProgram', 'id', 'sub_program_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function siswa()
    {
        return $this->belongsTo('App\Models\Msc\Siswa', 'id', 'siswa_id');
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