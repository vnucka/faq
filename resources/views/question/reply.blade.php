@extends('question.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Форма ответа</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('createAnswer')}}?question_id={{$question_id}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="text" class="col-md-4 control-label">Ваш ответ</label>

                            <div class="col-md-6">
                                <textarea name="text-answer" id="text" cols="" rows="15" required autofocus></textarea>

                                @if ($errors->has('text'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Ответить
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
