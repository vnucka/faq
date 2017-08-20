<!doctype html>
<html lang="{{ app()->getLocale() }}" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="./css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="./css/style.css"> <!-- Resource style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <title>FAQ</title>
</head>
<body>
<header>
    <h1>Вопрос - ответ</h1>
</header>
<section class="cd-faq">
    <div class="menu">
        <ul class="cd-faq-categories cd-faq-categories-usr">
        @if (Route::has('login'))
            @if (Auth::check())
                    <li class="open-forms" data-form="auth"><a href="{{ url('/home') }}">Личный кабинет</a></li>
                    <li class="open-forms" data-form="auth"><a href="{{ url('/faq-create') }}">Добавить вопрос</a></li>
            @else
                    <li class="open-forms" data-form="auth"><a href="{{ url('/login') }}">Войти</a></li>
                    <li class="open-forms" data-form="register"><a href="{{ url('/register') }}">Зарегистрироваться</a></li>
                    <li class="open-forms" data-form="auth"><a href="{{ url('/faq-create') }}">Добавить вопрос</a></li>
            @endif
        @endif
        </ul> <!-- cd-faq-categories -->


        @if (Route::has('login'))
            @if (Auth::check())
                <ul class="cd-faq-categories cd-faq-categories-scroll">
            @else
                <ul class="cd-faq-categories cd-faq-categories-scroll cd-faq-categories-lk">
            @endif
        @endif
            <li><a class="selected" href="#basics">Basics</a></li>
            <li><a href="#mobile">Mobile</a></li>
            <li><a href="#account">Account</a></li>
            <li><a href="#payments">Payments</a></li>
            <li><a href="#privacy">Privacy</a></li>
            <li><a href="#delivery">Delivery</a></li>
        </ul> <!-- cd-faq-categories -->
    </div>

    <div class="cd-faq-items">
        @include('question-item')
    </div> <!-- cd-faq-items -->
    <a href="#" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>