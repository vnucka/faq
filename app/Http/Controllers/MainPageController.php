<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;
use App\Answer;
use App\Question;

class MainPageController extends Controller
{
    public function viewMainPage()
    {
        $question = Question::where('moderate', 'confim')->get()->sortBy('create_at')->toArray();
        $themes = Theme::all()->toArray();

        for ($i = 0; $i < count($themes); $i++ )
        { // Проверяем темы, если нет в ней ответов, удаляем ее из массива
            $themeId = $themes[$i]['id'];
            if(!Question::whereRaw("theme_id = $themeId")->get()->toArray())
            {
                unset($themes[$i]);
            }
        }


        $questions = array();

        foreach ($question as $quest)
        {
            $user = ['user_name' => Question::find($quest['id'])->user->name];

            $answer = Answer::where('question_id', $quest['id'])->get()->toArray();
            $answers = array();


            if($answers)
            { // Проверяем существование ответов на вопрос.
                foreach ($answer as $oneAnswer)
                {
                    $answerItem = ['user_name' => Answer::find($oneAnswer['user_id'])->user->name];
                    $answers[] = array_merge($oneAnswer + $answerItem);
                }
            }
            $questions[] = $quest + $user + array('answers' => $answers);
        }

        return view('welcome', compact('questions', 'themes'));
    }
}
