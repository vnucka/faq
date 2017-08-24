<div class="menu">
    <ul class="cd-faq-categories cd-faq-categories-usr left-menu">
        <li><a href="{{ url('/') }}">На главную</a></li>
        <li><a href="{{ url('/faq-create') }}">Добавить вопрос</a></li>
    @if($thisUserRole == 'admin')
            <li><a href="{{ url('/users') }}">Пользователи</a></li>
            <li><a href="{{ url('/themes') }}">Темы</a></li>
            <li><a href="{{ url('/home') }}">Вопросы</a></li>
    @endif
    </ul> <!-- cd-faq-categories -->
</div>