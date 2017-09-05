<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Theme;
use App\Models\User;

class FaqController extends Controller
{
    protected $redirectTo = '/';

    /*
     *
     * ~~~~~~~~~~ Метод формы создания вопроса ~~~~~~~~~~
     *
     * */

    public function faqCreate()
    {
        $themes = Theme::all();

        if(\Auth::user())
        {
            $thisUserId = \Auth::user()->id;

            $items['user'] = $thisUserId;
            $items['themes'] = $themes;

            return view('question.user-create', compact('items'));
        }

        return view('question.create', compact('themes'));
    }

    /*
     *
     * ~~~~~~~~~~ Метод редактирования вопросов ~~~~~~~~~~
     *
     * */

    public function editQuestion()
    {
        if(!\Auth::user())
        { // Если не зарегистрированный пользователь пытается зайти
            return redirect('bed-reg');
        }

        if(isset($_REQUEST['question_id']))
        { // Если question_id существует, то проверяем существования данного вопроса и возвращаем форму редактирования вопроса
            $id = $_REQUEST['question_id'];

            if(!Question::find($id))
            {
                return $this->infoReturn('Вопрос с таким ID отсутствует!', 'error');
            } else
            {
                $question = Question::GetId($id)->get();
                $questionUserId = $question[0]->user_id;
                $author = User::find($questionUserId)->toArray();
                $users = User::all()->toArray();
                $thisUserRole = \Auth::user()->role;

                $themes = Theme::all()->toArray();

                return view('question.edit', compact('question', 'themes', 'author', 'thisUserRole', 'users', 'questionUserId'));
            }
        }


        if(isset($_REQUEST['author']))
        { // Если существует author, значит пришел POST запрос от администратора / модератора
            $editID = (isset($_REQUEST['edit_question_id'])) ? $_REQUEST['edit_question_id'] : "";
            $author = (int)($_REQUEST['author']);

            if(Question::where('id', $editID)->count() == 0)
                return $this->infoReturn('Вопрос с таким ID отсутствует!', 'error');

            $oldName = Question::find($editID)->name;

            if(Question::GetId($editID)->update(['name' => $_REQUEST['name'], 'text' => $_REQUEST['text'], 'theme_id' => $_REQUEST['theme'], 'user_id' => $author, 'moderate' => 'moderate']))
            {
                $theme = Theme::find($_REQUEST['theme'])->name;

                // Логируем действие
                $this->logs("отредактировал вопрос \"" . $oldName . "\" с ID ($editID) в теме \" $theme\" с ID (" . $_REQUEST['theme'] . ")");

                return $this->infoReturn('Вопрос отредактирован!', 'success');
            }
        }

        if(isset($_REQUEST['edit_question_id']))
        { // Если существует edit_question_id значит пришел POST запрос от пользователя / модератора

            $user_id = (isset($_REQUEST['user_id'])) ? $_REQUEST['user_id'] : null;
            $editID = (isset($_REQUEST['edit_question_id'])) ? $_REQUEST['edit_question_id'] : null;
            if(\Auth::user()->id == $user_id || \Auth::user()->role == 'moderator')
            {
               if(Question::GetId($editID)->update(['name' => $_REQUEST['name'], 'text' => $_REQUEST['text'], 'theme_id' => $_REQUEST['theme'], 'moderate'=>'moderate']))
                   return $this->infoReturn('Вопрос отредактирован!', 'success');
            }
        }

        return $this->infoReturn('Ошибка редактирования вопроса!', 'error');
    }

    /*
     *
     * ~~~~~~~~~~ Метод администрирования вопросов ~~~~~~~~~~
     *
     * */

    public function admQuestion()
    {
        if(isset($_REQUEST['question_id']))
        { // Проверяем ID вопроса
            $id = $_REQUEST['question_id'];
            $Question = Question::find($id);

            if(isset($_REQUEST['moderate']))
            { // Если существует POST moderate, делаем действие по модерации вопроса
                $moderate = $_REQUEST['moderate'];

                if(!$Question)
                    return $this->infoReturn('Вопрос с таким ID отсутствует!', 'error');

                    if(Question::GetId($id)->update(['moderate'=>$moderate]))
                    {
                        if($moderate == "reject")
                        {
                            $moderate = "Отклонить";
                        } elseif ($moderate == "confirm")
                        {
                            $moderate = "Подтвердить";
                        } else
                        {
                            $moderate = "На модерацию";
                        }

                        $theme = Theme::find($Question->theme_id);

                        $this->logs("отредактировал статус вопроса \"" . $Question->name . "\" с ID ($id) в теме \" $theme->name \" с ID (" . $theme->id . ") на \"$moderate\"");
                        return $this->infoReturn('Статус вопроса изменен!', 'success');
                    } else
                    {
                        return $this->infoReturn('Произошла ошибка при изменении статуса вопроса!', 'error');
                    }
            } elseif (isset($_REQUEST['transfer']))
            { // Иначе производим действия по переносу в другую группу
                $id = $_REQUEST['question_id'];
                $transfer = $_REQUEST['transfer'];

                if(Question::GetId($id)->get()->count() != 0 && Theme::where('id', $transfer)->get()->count() != 0)
                {
                    if(Question::GetId($id)->update(['theme_id'=>$transfer]))
                    {
                        $theme = Theme::find($transfer);

                        $this->logs("Перенес вопрос \"" . $Question->name . "\" с ID ($id) в тему \" $theme->name \" с ID (" . $theme->id . ")");
                        return $this->infoReturn("Вопрос перенесен в тему <strong>$theme->name</strong>!", 'success');
                    }
                }
                return $this->infoReturn('Ошибка переноса вопроса!', 'error');
            }
        }
        return $this->infoReturn('Ошибка редактирования вопроса', 'error');
    }

    /*
     *
     * ~~~~~~~~~~ Метод создания вопроса ~~~~~~~~~~
     *
     * */

    public function createQuestion()
    {
        $theme = (isset($_REQUEST['theme'])) ? $_REQUEST['theme'] : "";
        $name = (isset($_REQUEST['name'])) ? $_REQUEST['name'] : "";
        $text = (isset($_REQUEST['text'])) ? $_REQUEST['text'] : "";

        // Если пользователь авторизован, проверяем пользователя и создаем вопрос
        if(\Auth::user())
        {
            $thisUserId = \Auth::user()->id;
            $user = ($_REQUEST['user_id']) ? $_REQUEST['user_id'] : "";

            if($thisUserId == $user)
            { // Получаем данные из POST запроса и создаем новый вопрос.

                if(Question::where('name', $name)->get()->count() != 0)
                { // Проверяем, существует ливопрос с таким названием
                    return $this->infoReturn('Такой вопрос уже существует!', 'error');
                } elseif(Question::create(['theme_id' => $theme, 'user_id' => $thisUserId, 'name' => $name, 'text' => $text]))
                {
                    return $this->infoReturn('Вопрос добавлен', 'success');
                } else
                {
                    return $this->infoReturn('Ошибка при добавлении вопроса', 'error');
                }
            } else
            {
                return $this->infoReturn('Пользователен не верен!', 'error');
            }
        } else
        { // Иначе создаем нового пользователя и вопрос

            $user_name = $_REQUEST['user_name'];
            $user_email = $_REQUEST['email'];

            if(User::where('email', $user_email)->get()->count() != 0)
            { // Проверяем существование пользователя по email
                return $this->infoReturn('Пользователен с таким email уже зарегестрирован!', 'error');
            }

            if(Question::where('name', $name)->get()->count() != 0)
            { // Проверяем существования вопрос с таким же названием
                return $this->infoReturn('Такой вопрос уже существует!', 'error');
            } else
            { // Создаем пользователя и вопрос
                $pwd = $this->generatePwd();
                $usrpwd = bcrypt($pwd);
                $token = str_random(60);
                if(User::create(['name'=>$user_name, 'email'=>$user_email, 'password'=>$usrpwd, 'remember_token'=>$token]))
                {
                    $thisUserId = User::where('email', $user_email)->get()->toArray();
                    $thisUserId = $thisUserId[0]['id'];
                    if(Question::create(['theme_id' => $theme, 'user_id' => $thisUserId, 'name' => $name, 'text' => $text]))
                    {
                        return $this->infoReturn("Вопрос создан! <br> По вашему email создан пользователь, вы можете авторизоваться используя пароль: <br><strong>$pwd</strong>", 'success');
                    }
                } else
                {
                    return $this->infoReturn('Ошибка регистрации пользователя', 'error');
                }
            }
        }
    }

    /*
     *
     * ~~~~~~~~~~ Метод редактирование пользователей ~~~~~~~~~~
     *
     * */

    public function editUser()
    {
        return view('users.users');
    }


    /*
     *
     * ~~~~~~~~~~ Метод отображения домашней страницы ~~~~~~~~~~
     *
     * */

    public function home()
    {
        /*~~~~~~ Если пользователь не авторизован, пересылаем его на страницу с ошибкой ~~~~*/
        if(!\Auth::user())
        {
            return redirect('bed-reg');
        }

        $thisUserId = \Auth::user()->id;
        $thisUserRole = \Auth::user()->role;
        $themes = Theme::all()->toArray();
        $themesAll = Theme::all()->toArray();

        for ($i = 0; $i < count($themes); $i++ )
        { // Проверяем темы, если нет в ней ответов, удаляем ее из массива
            $themeId = $themes[$i]['id'];
            if($thisUserRole == 'user')
            { // обработка тем для пользователя
                if(Question::whereRaw("theme_id = $themeId and user_id = $thisUserId")->get()->count() == 0)
                {
                    unset($themes[$i]);
                }
            } else
            { // обработка тем для модератора / администратора
                if(Question::whereRaw("theme_id = $themeId")->get()->count() == 0)
                {
                    unset($themes[$i]);
                }
            }
        }

            /*~~~~~~~~~~
                Отображение домашней страницы пользователя с ролью user, moderator, admin
            ~~~~~~~~~~*/
        if( $thisUserRole == 'user')
        {
            $quests = $this->visibleQuestions($thisUserId);
            $questions = $this->getQuestionsAndAnswers($quests, $thisUserRole);

        } elseif($thisUserRole == 'moderator')
        {
            $quests = $this->visibleQuestions('');
            $questions = $this->getQuestionsAndAnswers($quests, $thisUserRole);
        } else
        {
            $quests = $this->visibleQuestions('');
            $questions = $this->getQuestionsAndAnswers($quests, $thisUserRole);
        }

        return view('home', compact('questions', 'themes', 'thisUserRole', 'themesAll'));
    }

    /*
     *
     * ~~~~~~~~~~ Метод формы создания ответа ~~~~~~~~~~
     *
     * */

    public function faqReply()
    {
        if(!isset($_REQUEST['question_id']))
            return $this->infoReturn('Отсутствует аттрибут ID', 'error');

        if(\Auth::user() != NULL)
        {
            if($_REQUEST['question_id'])
            {
                $question_id = $_REQUEST['question_id'];

                if(Question::find($question_id))
                {
                    return view('question.reply', ['question_id'=>$question_id]);
                } else {
                    return $this->infoReturn('Вопрос с таким ID не найден', 'error');
                }
            } else
            {
                return $this->infoReturn('Вопрос с таким ID не найден', 'error');
            }
        }
        return redirect('/bed-reg');
    }

    /*
     *
     * ~~~~~~~~~~ Метод создания ответа ~~~~~~~~~~
     *
     * */

    public function createAnswer()
    {
        $thisUserId = \Auth::user()->id;

        if(isset($_REQUEST['text-answer']))
        { // Проверяем существования POST
            $question_id = $_REQUEST['question_id'];

            if(Question::find($question_id))
            {
                if(Answer::create(['answer'=>$_REQUEST['text-answer'], 'question_id'=>$question_id, 'user_id'=>$thisUserId]))
                {
                    return $this->infoReturn('Ответ добавлен', 'success');
                } else
                {
                    return $this->infoReturn('Ошибка добавления ответа', 'error');
                }
            } else
            {
                return $this->infoReturn('Вопрос с таким ID не найден', 'error');
            }
        }
    }

    /*
     *
     * ~~~~~~~~~~ Метод отображения списка тем ~~~~~~~~~~
     *
     * */

    public function themes()
    {
        if($this->checkAdmin())
        { // Проверяем права доступа, если Админ, разрешаем
            return $this->checkAdmin();
        }

        $theme = Theme::all()->toArray();
        $thisUserRole = \Auth::user()->role;
        $themes = array();

        foreach ($theme as $th)
        { // Проходим по теме, собираем данные (количество вопросов в теме, опубликованных, количество вопросов без ответа)
            $themeId = $th['id'];
            $countQuestion = Question::GetId($themeId)->count();
            $visibleQuestion = Question::whereRaw("theme_id = $themeId and moderate = 'confirm'")->count();
            $questions = Question::GetId($themeId)->get()->toArray();
            $countAnswers = 0;

            foreach ($questions as $question)
            { // Проверяем количество вопросов без ответа
                $questionId = $question['id'];
                if(Answer::GetId($questionId)->count() == 0)
                {
                    $countAnswers++;
                }
            }
            $themes[] = $th + array('questions'=>$countQuestion, 'visible_questions'=>$visibleQuestion, 'answers'=>$countAnswers);
        }

        return view('themes', compact('themes', 'thisUserRole'));
    }


    /*
     *
     * ~~~~~~~~~~ Метод редактирования / удаления темы ~~~~~~~~~~
     *
     * */

    public function themeEdit()
    {
        if($this->checkAdmin())
        { // Проверяем права доступа, если Админ, разрешаем
            return $this->checkAdmin();
        }

        if(isset($_REQUEST['theme_id']))
        { // Определяем ID Темы и отображаем форму
            $themeId = $_REQUEST['theme_id'];

            if(Theme::find($themeId))
            {
                $theme = Theme::find($themeId)->toArray();
                return view('themes.edit', compact('theme'));
            } else
            {
                return $this->infoReturn('Темы с таким ID не существует!', 'error');
            }
        }

        if(isset($_REQUEST['edit_theme']))
        { // Определяем тему ID и редактируем ее
            $themeId = $_REQUEST['edit_theme'];
            if(Theme::find($themeId))
            {
                $oldName = Theme::find($themeId)->name;
                $themeName = $_REQUEST['name'];
                if(Theme::where('id', $themeId)->update(['name'=>$themeName]))
                {
                    $this->logs("отредактировал тему \"" . $oldName . "\" с ID ($themeId) на \" $themeName \"");
                    return $this->infoReturn('Тема отредактирована!', 'success');
                }
                return $this->infoReturn('Ошибкав редактирования темы!', 'error');
            }

            return $this->infoReturn('Темы с таким ID не существует!', 'error');
        }

        if(isset($_REQUEST['delete_theme']))
        { // Если передан POST delete_theme, удаляем тему, все вопросы и ответы в ней.
            $themeId = $_REQUEST['delete_theme'];
            if(Theme::find($themeId))
            {
                $theme = Theme::find($themeId);

                if(Theme::find($themeId)->delete())
                {
                    $questions = Question::GetId($themeId)->get()->toArray();
                    //$questions = Question::where('theme_id', $themeId)->get()->toArray();
                    foreach ($questions as $question)
                    {
                        $questionId = $question['id'];
                        Answer::GetId($questionId)->delete();
                    }
                    Question::where('theme_id', $themeId)->delete();

                    $this->logs("удалил тему \"" . $theme->name . "\" с ID ($themeId), так же все вопросы и ответы из этой темы");

                    return $this->infoReturn('Тема, вопросы и ответы удалены!', 'success');
                }
                return $this->infoReturn('Ошибка удаления темы!', 'error');
            }

            return $this->infoReturn('Темы с таким ID не существует!', 'error');
        }

    }

    /*
     *
     * ~~~~~~~~~~ Метод добавления темы ~~~~~~~~~~
     *
     * */

    public function themeAdd()
    {
        if($this->checkAdmin())
        { // Проверяем права доступа, если Админ, разрешаем
            return $this->checkAdmin();
        }

        if(isset($_REQUEST['name']))
        {// Если существует POST запрос, создаем тему
            $name = $_REQUEST['name'];

            if(Theme::where('name', $name)->get()->count() != 0)
            {
                return $this->infoReturn('Тема с заким названием существует!', 'error');
            }elseif(Theme::create(['name'=>$name]))
            {
                return $this->infoReturn('Тема создана!', 'success');
            }
            return $this->infoReturn('Ошибка создания темы!', 'error');
        }
        return view('themes.add');
    }


    /*
     *
     * ~~~~~~~~~~ Метод проверки авторизации администратора ~~~~~~~~~~
     *
     * */

    public function checkAdmin()
    {
        // Проверяем авторизацию пользователя
        if(!\Auth::user())
        {
            return redirect('bed-reg');
        } elseif (\Auth::user()->role != 'admin')
        { // Если пользователь не в группе администраторов
            return $this->infoReturn('Не достаточно прав доступа!', 'error');
        }
    }

    /*
     *
     * ~~~~~~~~~~ Метод получения всех вопросов и ответов к ним ~~~~~~~~~~
     *
     * */

    private function getQuestionsAndAnswers($quests, $userRole)
    {
        $questions = array();
        foreach ($quests as $quest)
        {
            $answers = array();
            $id = $quest['id'];
            $questionUserId = $quest['user_id'];
            $questionUserName = User::find($questionUserId)->name;
            $answer = Answer::GetId($id)->get()->toArray();

            foreach ($answer as $item)
            {
                $answerUserId = $item['user_id'];
                $answersUserName = User::find($answerUserId)->name;
                $answers[] = $item + array('user_name'=>$answersUserName);
            }
            $questions[] = $quest  + array('user_name'=>$questionUserName) + array('user_role'=>$userRole) + array('answers'=>$answers);
        }
        
        return $questions;
    }


    /*
     *
     * ~~~~~~~~~~ Метод отображения вопросов (Опубликованные, не опубликованные, все) ~~~~~~~~~~
     *
     * */

    private function visibleQuestions($thisUserId)
    {
        $visible = (isset($_REQUEST['visible'])) ? $_REQUEST['visible'] : "all";

        /*~~~~~~~~~~
            Если thisUserId пустой, то подразумевается пользователь с правами moderator или admin
        ~~~~~~~~~~*/

        if($thisUserId == "")
        {
            if($visible == "1")
            {
                return Question::Confirm()->orderBy('created_at', 'ASC')->get()->toArray();
                // return Question::where('moderate','confirm')->orderBy('created_at', 'ASC')->get()->toArray();
            } elseif($visible == "0")
            {
                return Question::where('moderate','!=','confirm')->orderBy('created_at', 'ASC')->get()->toArray();
            } else
            {
                return Question::all()->sortBy('created_at')->toArray();
            }
        } else {
            if($visible == "1")
            {
                return Question::whereRaw("user_id = $thisUserId and moderate = 'confirm'")->orderBy('created_at', 'ASC')->get()->toArray();
            } else if($visible == "0")
            {
                return Question::whereRaw("user_id = $thisUserId and moderate != 'confirm'")->orderBy('created_at', 'ASC')->get()->toArray();
            } else
            {
                return Question::where('user_id' , $thisUserId)->orderBy('created_at', 'ASC')->get()->toArray();
            }
        }

    }

    /*
     *
     * ~~~~~~~~~~ Метод генерации пароля пользователей ~~~~~~~~~~
     *
     * */

    public function generatePwd()
    {
        $simbols = [
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            '~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '-', '=', '+', '"', '№', ',', ';', ':', '?', '/', '.'
        ];

        shuffle($simbols);
        $pwd = '';

        for($i = 0; $i< rand(6, 20); $i++){
            $pwd = $pwd . $simbols[$i];
        }

        return $pwd;
    }
}
