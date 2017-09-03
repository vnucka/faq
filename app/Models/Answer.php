<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['answer', 'question_id', 'user_id', 'created_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }

    public function scopeGetId($query, $id)
    {
        return $query->where('id', $id);
    }
}
