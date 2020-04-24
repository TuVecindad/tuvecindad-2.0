<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $floor
 * @property string $door
 * @property int $sqm
 * @property int $room
 * @property int $bathroom
 * @property int $occupants
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property Property[] $properties
 */
class ProHouse extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pro_house';

    /**
     * @var array
     */
    protected $fillable = ['floor', 'door', 'sqm', 'room', 'bathroom', 'occupants', 'type', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties()
    {
        return $this->hasMany('App\Property', 'house_id');
    }
}
