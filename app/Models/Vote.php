<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'user_id',
        'id_aspiration',
    ];

    public function aspiration()
    {
        return $this->belongsTo(Aspiration::class, 'id_aspiration', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}