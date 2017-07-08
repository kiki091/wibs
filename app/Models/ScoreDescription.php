<?php

namespace App\Models;

use App\Models\BaseModel;

class ScoreDescription extends BaseModel
{
	protected $table = 'score_description';
    public $timestamps = false;

    protected $fillable = [
        'report_from',
        'description'
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