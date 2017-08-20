@extends('question.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Информация</div>
                <div class="panel-body">
                    <h2 class="{{ $info['infoClass'] }}">{!! $info['infoText']  !!}</h2>
                    <a href="/">На главную</a>
                    <a href="/home">В личный кабинет</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
