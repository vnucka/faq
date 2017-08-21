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
    <h1>Ошибка авторизации</h1>
</header>
 <div class="bed_reg">
  <img src="./img/bed_reg.png" alt="">
     <p><strong>Упс...</strong></p>
     <p>Кажется, что то пошло не так. <br> Вы пытаетесь войти в закрытую часть сайта без резистрации.</p>
     <p>Пройдите пожалуйста <a href="{{ url('/login') }}"><strong>авторизацию</strong></a> или <a href="{{ url('/register') }}"><strong>зарегистрируйтесь</strong></a><br>
         так же вы можете вернуться <a href="{{url('/')}}"><strong>на главную</strong></a>.
     </p>
 </div>
</body>
</html>