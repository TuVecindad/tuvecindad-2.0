<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property boolean $add_user
 * @property boolean $del_user
 * @property UsersCommunity[] $usersCommunities
 */
class Permissions extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    //protected $fillable = ['add_user', 'del_user'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usersCommunities()
    {
        return $this->hasMany('App\UsersCommunity', 'permissions');
    }
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
