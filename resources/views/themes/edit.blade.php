@extends('question.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Редактирование тему</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('themeEdit')}}?edit_theme={{$theme['id']}}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Название темы</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus value="{{$theme['name']}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Удалить тему, все вопросы и ответы</label>

                            <div class="col-md-6">
                                <a class="btn btn-primary btn-primary-usr" href="{{ route('themeEdit') }}?delete_theme={{$theme['id']}}"> Удалить тему</a>
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
