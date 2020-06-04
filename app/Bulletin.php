<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $com_id
 * @property int $user_id
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Community $community
 */
class Bulletin extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'bulletin';

    /**
     * @var array
     */
    protected $fillable = ['com_id', 'user_id', 'body', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function community()
    {
        return $this->belongsTo('App\Community', 'com_id');
    }
}
