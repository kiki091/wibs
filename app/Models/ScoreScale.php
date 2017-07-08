<?php

namespace App\Models;

use App\Models\BaseModel;

class ScoreScale extends BaseModel
{
	protected $table = 'score_scale';
    public $timestamps = false;

    protected $fillable = [
        'qualitative_score',
        'quantitative_score',
        'remarks'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function score_activitie()
    {
        return $this->belongsTo('App\Models\ScoreActivitie', 'id', 'score_activitie_id');
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