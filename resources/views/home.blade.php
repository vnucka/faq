@extends('layouts.app')

@section('content')

    <section class="cd-faq">

        @include('left-menu')

        <div class="cd-faq-items">
            <div class="top-menu">
                <ul class="cd-faq-categories cd-faq-categories-usr">
                    <li><a href="?visible=all">Все вопросы</a></li>
                    <li><a href="?visible=1">Опубликованные вопросы</a></li>
                    <li><a href="?visible=0">Не опубликованные вопросы</a></li>
                </ul> <!-- cd-faq-categories -->
            </div>
            @include('home-item')
        </div> <!-- cd-faq-items -->

        <a href="#" class="cd-close-panel">Close</a>
    </section>

@endsection
