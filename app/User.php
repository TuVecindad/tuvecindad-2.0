<?php

namespace App;

use App\Role;
use App\Community;
use App\Bulletin;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //clave
    protected $primaryKey = 'id';
    protected $fillable = [
        'email', 'name', 'nif', 'name', 'surname1', 'surname2', 'phone1', 'phone2', 'password', 'payment'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at', 'created_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function hasRoleCommunity($id,$role)
    {
        if ($this->communities()->wherePivot('community_id', '=', $id)->wherePivot('role_id', '=', $role)->first()) {
            return true;
        }
        return false;
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class)->withTimestamps();
    }

    public function bulletin()
    {
        return $this->belongsToMany(Bulletin::class)->withTimestamps();
    }

    /* Calcula diferencia de días desde el registro para controlar serv. premium */

    public function diffDate(){
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $created = auth()->user()->where('id', $id)->pluck('created_at')->first();
        $date = Carbon::parse($created);
        $now = Carbon::now();
        $diffdate = $now->diffInDays($date);
        $restantes = 30 - $diffdate;
        if ($restantes <= 0){
            auth()->user()->roles()->update(['role_id' => 3]);
            return redirect()->back()->with('error', 'Tu periodo de prueba ha caducado');
        } else {
            return $restantes;
        }

    }

    public function hasSubscription(){

        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $subs = $user->where('id', $id)->pluck('payment')->first();
        if ($subs != null) {
            return true;
        }
        return false;
    }

}
