@extends('question.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Редактирование вопрос</div>
                <div class="panel-body">
                    @foreach($question as $quest)
                        <form class="form-horizontal" method="POST" action="{{route('editQuestion')}}?user_id={{$quest['user_id']}}&edit_question_id={{$quest['id']}}">
                            {{ csrf_field() }}
                            @if($thisUserRole == "admin")
                            <div class="form-group">
                                <label for="author" class="col-md-4 control-label">Автор</label>
                                <div class="col-md-6">
                                    <select name="author" id="theme">
                                        @foreach($users as $user)
                                            <option value="{{$user['id']}}" @if($questionUserId == $user['id']) selected @endif >{{$user['name']}} / {{$user['email']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="theme" class="col-md-4 control-label">Тема</label>
                                <div class="col-md-6">
                                    <select name="theme" id="theme">
                                        @foreach($themes as $theme)
                                            <option value="{{$theme['id']}}">{{$theme['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Заголовок вопроса</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus value="{{$quest['name']}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="text" class="col-md-4 control-label">Описание вопроса</label>

                                <div class="col-md-6">
                                    <textarea name="text" id="text" cols="" rows="15" required autofocus>{{$quest['text']}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Применить
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
