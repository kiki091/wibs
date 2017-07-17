<?php

namespace App\Models\Msc;

use App\Models\BaseModel;

class SubProgram extends BaseModel
{
	protected $table = 'sub_program';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function program()
    {
        return $this->belongsTo('App\Models\Msc\Program', 'id', 'program_id');
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