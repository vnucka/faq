<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Theme;
use App\Models\User;

class MainPageController extends Controller
{
    public function viewMainPage()
    {
        //$question = Question::Confirm()->orderBy('created_at', 'DESC')->get()->toArray();
        $question = Question::Confirm()->orderBy('created_at', 'DESC')->get();

        $themes = Theme::all()->toArray();

        for ($i = 0; $i <= count($themes); $i++ )
        { // Проверяем темы, если нет в ней ответов, удаляем ее из массива

            $themeId = $themes[$i]['id'];

            if(Question::whereRaw("theme_id = $themeId")->get()->count() == 0)
            {
                unset($themes[$i]);
            }
        }


        $questions = array();

        foreach ($question as $quest)
        {
            $user = $quest->user->name;

            $answer = Answer::GetId($quest->id)->orderBy('created_at', 'DESC')->get();
            $answers = array();

            if($answer)
            { // Проверяем существование ответов на вопрос.
                foreach ($answer as $oneAnswer)
                {
                    $oneAnswer = ['answer' => $oneAnswer->answer, 'user_id' => $oneAnswer->user_id, 'created_at' => date($oneAnswer->created_at)];
                    $userId = $oneAnswer['user_id'];
                    $answerItem = ['user_name' => User::find($userId)->name];
                    $answers[] = $oneAnswer + $answerItem;
                }
            }

            $quest = $quest->toArray();
            $questions[] = $quest + array('answers' => $answers);
        }

        return view('welcome', compact('questions', 'themes'));
    }
}
