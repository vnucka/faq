@extends('question.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Редактирование пользователя</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('userEdit')}}?user_id={{$user['id']}}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Имя пользователя</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus value="{{$user['name']}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email пользователя</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" disabled value="{{$user['email']}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Новый пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" name="password" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Роль пользователя</label>

                            <div class="col-md-6">
                                <select name="role" id="role">
                                    @if($user['role'] == 'admin')
                                        <option value="admin" selected>Администратор</option>
                                        <option value="moderator">Модератор</option>
                                        <option value="user">Пользователь</option>
                                    @elseif($user['role'] == 'moderator')
                                        <option value="admin" >Администратор</option>
                                        <option value="moderator" selected>Модератор</option>
                                        <option value="user">Пользователь</option>
                                    @else
                                        <option value="admin" >Администратор</option>
                                        <option value="moderator">Модератор</option>
                                        <option value="user" selected>Пользователь</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Удалить пользователя, все его вопросы и ответы</label>

                            <div class="col-md-6">
                                <a class="btn btn-primary btn-primary-usr" href="{{ route('userEdit') }}?delete_user={{$user['id']}}"> Удалить пользователя</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Изменить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
