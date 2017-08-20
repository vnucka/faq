<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\User;

class Faq extends Controller
{
    protected $redirectTo = '/';

    public function faq()
    {
        $id = Auth::user()->id;

        if(isset($_REQUEST['text-answer']))
        {
            dd($id);
            //var_dump(Answer::create(['answer'=>$_REQUEST['text-answer'], 'user_id']));
            //var_dump(isset($_REQUEST['text-answer']));

        }

    }
}
