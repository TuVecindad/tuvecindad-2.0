<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserComm extends Model
{
      /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'users_community';

    /**
     * @var array
     */
    protected $fillable = ['permissions'];

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
    public function permission()
    {
        return $this->belongsTo('App\Permission', 'permissions');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function community()
    {
        return $this->belongsTo('App\Community', 'com_id');
    }
}
