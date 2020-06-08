<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Community;
use App\ProHouse;
use App\ProParking;
use App\ProStorage;
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
    // public function tenant()
    // {
    //     return $this->belongsTo('App\User', 'tenant');
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function owner()
    // {
    //     return $this->belongsTo('App\User', 'owner');
    // }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function community()
    {
        return $this->belongsTo('App\Community', 'com_id');
    }

    public function getData($type, $value)
    {
        switch ($type) {
            case 'house':
                switch ($value) {
                    case 'floor':
                        $data = ProHouse::findOrFail($this->house_id)->floor;
                        break;

                    case 'door':
                        $data = ProHouse::findOrFail($this->house_id)->door;
                        break;

                    case 'sqm':
                        $data = ProHouse::findOrFail($this->house_id)->sqm;
                        break;

                    case 'room':
                        $data = ProHouse::findOrFail($this->house_id)->room;
                        break;

                    case 'bathroom':
                        $data = ProHouse::findOrFail($this->house_id)->bathroom;
                        break;

                    case 'occupants':
                        $data = ProHouse::findOrFail($this->house_id)->occupants;
                        break;

                    case 'type':
                        $data = ProHouse::findOrFail($this->house_id)->type;
                        break;

                    default:
                        break;
                }
                break;

            case 'parking':
                switch ($value) {
                    case 'sqm_p':
                        $data = ProParking::findOrFail($this->parking_id)->sqm_p;
                        break;

                    case 'num_p':
                        $data = ProParking::findOrFail($this->parking_id)->num_p;
                        break;

                    default:
                        break;
                }
                break;

            case 'storage':
                switch ($value) {
                    case 'sqm_s':
                        $data = ProStorage::findOrFail($this->storage_id)->sqm_s;
                        break;

                    case 'num_s':
                        $data = ProStorage::findOrFail($this->storage_id)->num_s;
                        break;

                    default:
                        break;
                }
                break;

                break;

            default:
                break;
        }

        return $data;
    }

    public function getMail($id)
    {
        $email = User::where('id',$id)->first();

        if ($email != null) {
           return $email->email;
        } else  {
            return;
        }
    }
}

