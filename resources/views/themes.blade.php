@extends('layouts.app')

@section('content')

    <section class="cd-faq">

        @include('left-menu')

        <div class="cd-faq-items">
            <div class="top-menu">
                <ul class="cd-faq-categories cd-faq-categories-usr">
                    <li><a href="{{route ('themeAdd')}}">Добавить тему</a></li>
                </ul> <!-- cd-faq-categories -->
            </div>
        </div> <!-- cd-faq-items -->

        <div class="cd-faq-items">
            @include('themes-item')
        </div> <!-- cd-faq-items -->

        <a href="#" class="cd-close-panel">Close</a>
    </section>

@endsection
