<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $com_id
 * @property int $owner
 * @property int $tenant
 * @property int $house_id
 * @property int $parking_id
 * @property int $storage_id
 * @property string $cad_ref_pro
 * @property ProStorage $proStorage
 * @property ProParking $proParking
 * @property ProHouse $proHouse
 * @property User $user
 * @property User $user
 * @property Community $community
 */
class Property extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'property';

    /**
     * @var array
     */
    protected $fillable = ['com_id', 'owner', 'tenant', 'house_id', 'parking_id', 'storage_id', 'cad_ref_pro'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proStorage()
    {
        return $this->belongsTo('App\ProStorage', 'storage_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proParking()
    {
        return $this->belongsTo('App\ProParking', 'parking_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proHouse()
    {
        return $this->belongsTo('App\ProHouse', 'house_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_tenant()
    {
        return $this->belongsTo('App\User', 'tenant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_owner()
    {
        return $this->belongsTo('App\User', 'owner');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function community()
    {
        return $this->belongsTo('App\Community', 'com_id');
    }
}
