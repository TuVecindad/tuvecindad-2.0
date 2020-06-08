<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sqm
 * @property string $created_at
 * @property string $updated_at
 * @property Property[] $properties
 */
class ProParking extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pro_parking';

    /**
     * @var array
     */
    protected $fillable = ['num_p','sqm_p', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties()
    {
        return $this->hasMany('App\Property', 'parking_id');
    }
}
