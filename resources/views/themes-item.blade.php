<ul class="cd-faq-group cd-faq-group-users cd-faq-group-theme">
    @foreach($themes as $theme)
        <li><a href="{{route ('themeEdit')}}?theme_id={{$theme['id']}}">{{$theme['name']}}</a>
                <ul>
                        <li>Вопросов в теме: {{$theme['questions']}}</li>
                        <li>Опубликованных: {{$theme['visible_questions']}}</li>
                        <li>Без ответов: {{$theme['answers']}}</li>
                </ul>
        </li>
    @endforeach
</ul>