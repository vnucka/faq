<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['theme_id', 'user_id', 'name', 'text', 'update_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answer()
    {
        return $this->belongsTo('App\Answer', 'question_id');
    }

    public function theme()
    {
        return $this->belongsTo('App\Theme');
    }

}
