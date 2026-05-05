<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

    protected $primaryKey = 'id_vote';

    protected $fillable = [
        'user_id',
        'id_aspiration'
    ];

    public function aspiration()
    {
        return $this->belongsTo(\App\Models\Aspiration::class, 'id_aspiration');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}