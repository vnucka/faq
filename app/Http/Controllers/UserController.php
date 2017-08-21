<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Answer;

class UserController extends Controller
{
    public function users()
    {
        // Проверяем авторизацию пользователя
        if(!\Auth::user())
        {
            redirect('bed-reg');
        } elseif (\Auth::user()->role != 'admin')
        { // Если пользователь не в группе администраторов
            return $this->infoReturn('Не достаточно прав доступа!', 'error');
        }

        if(isset($_REQUEST['role']))
        { // Проверяем существования параметра группы пользователя
            $role = $_REQUEST['role'];

            $users = User::where('role', $role)->get()->toArray();
        } else
        {
            $users = User::all()->toArray();
        }

        $thisUserRole = \Auth::user()->role;
        $thisUser = \Auth::user()->id;

        return view('user', compact('thisUserRole', 'users', 'thisUser'));
    }

    public function userEdit()
    {
        // Проверяем авторизацию пользователя
        if(!\Auth::user())
        {
            redirect('bed-reg');
        } elseif (\Auth::user()->role != 'admin')
        { // Если пользователь не в группе администраторов
            return $this->nfoReturn('Не достаточно прав доступа!', 'error');
        }

        $user_id = (isset($_REQUEST['user_id'])) ? $_REQUEST['user_id'] : "";

        /*
         * Проверяем существования GET запроса на удаление пользователя, удаляем пользователя, его вопросы и ответы.
        */

        if(isset($_REQUEST['delete_user']))
        {
            $deleteUserId = $_REQUEST['delete_user'];

            if(User::where('id', $deleteUserId)->delete())
            {
                Question::where('user_id', $deleteUserId)->delete();
                Answer::where('user_id', $deleteUserId)->delete();

                return $this->infoReturn("Пользователь с ID <strong>$deleteUserId</strong> удален!", 'success');
            }
            return $this->infoReturn("Ошибка удаления пользователя!", 'error');
        }

        /*
         * Проверяем существования POST запроса name, изменяем пользователя
        */
        if(isset($_POST['name']))
        {
            $user_name = $_REQUEST['name'];
            $user_role = $_REQUEST['role'];

            if(User::where('id',$user_id)->get()->toArray())
            { // Проверяем существования пользователя по переданному ID
                if($_REQUEST['password'] != "")
                { // Проверяем существования значения password
                    $pwd = $_REQUEST['password'];
                    $usrpwd = bcrypt($pwd);
                    if(User::where('id',$user_id)->update(['name'=>$user_name, 'role'=>$user_role, 'password'=>$usrpwd]))
                    {
                        return $this->infoReturn("Пользователь <strong>$user_name</strong> изменен!", 'success');
                    }
                    return $this->infoReturn("Ошибка редактирования пользователя!", 'error');

                } elseif(User::where('id',$user_id)->update(['name'=>$user_name, 'role'=>$user_role]))
                { // Обновляем пользователя
                    return $this->infoReturn("Пользователь <strong>$user_name</strong> изменен!", 'success');
                } else
                {
                    return $this->infoReturn("Ошибка редактирования пользователя!", 'error');
                }
            } else
            {
                return $this->nfoReturn('Пользователь с таким ID не существует', 'error');
            }
        } else
        {
            $user = User::find($user_id)->toArray();

            return view('users.edit', compact('user'));
        }
    }

    public function changePassword()
    {
        // Проверяем авторизацию пользователя
        if(!\Auth::user())
        {
            redirect('bed-reg');
        }

        if(isset($_REQUEST['password']))
        {
            $userId = (isset($_REQUEST['user_id'])) ? $_REQUEST['user_id'] : "";

            if(Auth::user()->id == $userId)
            {
                $password = bcrypt($_REQUEST['password']);
                if(User::where('id', $userId)->update(['password'=>$password]))
                {
                    return $this->infoReturn("Пароль изменен!", 'success');
                }
            }
            return $this->infoReturn("Ошибка редактирования пользователя!", 'error');
        }

        $userId = Auth::user()->id;

        return view('users.change-password', compact('userId'));
    }

    private function infoReturn($infoText, $infoClass)
    {
        $info = array('infoText'=>$infoText, 'infoClass'=>$infoClass);
        return view('question.info', compact('info'));
    }
}
