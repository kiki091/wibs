<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class ScoreDescription extends BaseModel
{
    protected $connection = 'msc';
	protected $table = 'score_description';
    
    protected $guard = 'siswa';
    public $timestamps = false;

    protected $fillable = [
        'report_from',
        'description'
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