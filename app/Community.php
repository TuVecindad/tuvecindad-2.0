<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * @property int $id
 * @property string $cad_ref_com
 * @property string $address
 * @property int $apart_num
 * @property string $created_at
 * @property string $updated_at
 * @property Bulletin[] $bulletins
 * @property CommonArea $commonArea
 * @property Property[] $properties
 * @property UsersCommunity[] $usersCommunities
 */
class Community extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['cad_ref_com', 'address', 'apart_num', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bulletins()
    {
        return $this->hasMany('App\Bulletin', 'com_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function commonArea()
    {
        return $this->hasOne('App\CommonArea', 'com_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties()
    {
        return $this->hasMany('App\Property', 'com_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
