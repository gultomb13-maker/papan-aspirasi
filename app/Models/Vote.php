<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $primaryKey = 'id_vote';

    protected $fillable = [
        'user_id',
        'id_aspiration',
    ];
}