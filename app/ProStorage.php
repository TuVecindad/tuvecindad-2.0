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
class ProStorage extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pro_storage';

    /**
     * @var array
     */
    protected $fillable = ['num_s','sqm_s', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties()
    {
        return $this->hasMany('App\Property', 'storage_id');
    }
}
