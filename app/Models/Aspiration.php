<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $table = 'aspirations';

    protected $primaryKey = 'id_aspiration';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content'
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function votes()
    {
        return $this->hasMany(\App\Models\Vote::class, 'id_aspiration');
    }
}