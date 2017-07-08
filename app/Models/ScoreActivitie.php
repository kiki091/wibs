<?php

namespace App\Models;

use App\Models\BaseModel;

class ScoreActivitie extends BaseModel
{
	protected $table = 'score_activitie';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'value',
        'remarks'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function sub_program()
    {
        return $this->belongsTo('App\Models\SubProgram', 'id', 'sub_program_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa', 'id', 'siswa_id');
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