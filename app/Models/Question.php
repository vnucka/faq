<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['theme_id', 'user_id', 'name', 'text', 'update_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function answer()
    {
        return $this->belongsTo('App\Models\Answer', 'question_id');
    }

    public function theme()
    {
        return $this->belongsTo('App\Models\Theme');
    }

    public function scopeConfirm($query)
    {
        return $query->where('moderate', 'confirm');
    }

    public function scopeGetId($query, $id)
    {
        return $query->where('id', $id);
    }

}
