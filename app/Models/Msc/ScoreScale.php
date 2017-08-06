<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class ScoreScale extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'score_scale';
    
    protected $guard = 'siswa';
    public $timestamps = false;

    protected $fillable = [
        'qualitative_score',
        'quantitative_score',
        'remarks'
    ];

    protected $guarded = ['siswa'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function score_activitie()
    {
        return $this->belongsTo('App\Models\Msc\ScoreActivitie', 'id', 'score_activitie_id');
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