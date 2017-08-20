@extends('question.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Задать вопрос</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('createQuestion')}}?user_id={{$items['user']}}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="theme" class="col-md-4 control-label">Тема</label>
                            <div class="col-md-6">
                                <select name="theme" id="theme">
                                    @foreach($items['themes'] as $theme)
                                        <option value="{{$theme['id']}}">{{$theme['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Заголовок вопроса</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="text" class="col-md-4 control-label">Описание вопроса</label>

                            <div class="col-md-6">
                                <textarea name="text" id="text" cols="" rows="15" required autofocus></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Отправить
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
