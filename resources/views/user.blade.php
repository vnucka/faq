@extends('layouts.app')

@section('content')

    <section class="cd-faq">

        @include('left-menu')

        <div class="cd-faq-items">
            <div class="top-menu">
                <ul class="cd-faq-categories cd-faq-categories-usr">
                    <li><a href="?role=admin">Администраторы</a></li>
                    <li><a href="?role=moderator">Модераторы</a></li>
                    <li><a href="?role=user">Пользователи</a></li>
                    <li><a href="{{route('users')}}">Все пользователи</a></li>
                </ul> <!-- cd-faq-categories -->
            </div>
        </div> <!-- cd-faq-items -->

        <div class="cd-faq-items">
            @include('users-item')
        </div> <!-- cd-faq-items -->

        <a href="#" class="cd-close-panel">Close</a>
    </section>

@endsection
