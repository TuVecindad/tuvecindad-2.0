<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $com_id
 * @property boolean $pool
 * @property boolean $gym
 * @property boolean $hall
 * @property boolean $rooftop
 * @property boolean $garden
 * @property Community $community
 */
class CommonArea extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'common_area';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'com_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['pool', 'gym', 'hall', 'rooftop', 'garden'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function community()
    {
        return $this->belongsTo('App\Community', 'com_id');
    }
}
