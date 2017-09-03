<ul id="basics" class="cd-faq-group">
    @foreach($themes as $theme)
        <li class="cd-faq-title"><h2>{{$theme['name']}}</h2></li>
        @foreach($questions as $question)
            @if($theme['id'] == $question['theme_id'])
                <li @if($question['moderate'] == 'reject') class="reject" @elseif($question['moderate'] == 'moderate') class="moderate" @endif >
                    <a class="cd-faq-trigger" href="#">{{$question['name']}}</a>
                    <div class="cd-faq-content">
                        <div class="header">
                            <a href="#"><p class="name-author">{{$question['user_name']}}</p></a>
                            <p class="date-create"> / {{$question['created_at']}}</p>
                            <hr>
                        </div>
                        <p>{{$question['text']}}</p>
                        <hr>
                        @foreach($question['answers'] as $answer)
                            <div class="answer">
                                <div class="header">
                                    <p class="ans">Ответил:</p>
                                    <a href="#"><p class="name-author">{{$answer['user_name']}}</p></a>
                                    <p class="date-create"> / {{$answer['created_at']}}</p>
                                    <hr>
                                </div>
                                <div class="text">
                                    <p>{{$answer['answer']}}</p>
                                </div>
                            </div>
                        @endforeach

                        <div class="open-forms reply-btn">
                            <a href="{{ url('/faq-reply') }}?question_id={{$question['id']}}">
                                <p>Ответить</p>
                            </a>
                        </div>
                        <div class="open-forms reply-btn">
                            <a href="{{ route('editQuestion') }}?question_id={{$question['id']}}">
                                <p>Редактировать</p>
                            </a>
                        </div>

                        @if($thisUserRole == 'admin' || $thisUserRole == 'moderator' )
                            <hr>
                            <form action="{{ url('/admQuestion') }}?question_id={{$question['id']}}" method="post">
                                {{ csrf_field() }}
                                <p>Модерация</p>
                                <select name="moderate" id="moderate">
                                    <option value="confirm">Подтвердить</option>
                                    <option value="reject">Отклонить</option>
                                    <option value="moderate">На модерацию</option>
                                </select>
                                <button type="submit" class="btn btn-primary">
                                    Подтвердить
                                </button>
                            </form>
                            <hr>

                            <form action="{{ url('/admQuestion') }}?question_id={{$question['id']}}" method="post">
                                {{ csrf_field() }}
                                <p>Перенести в другую тему</p>
                                <select name="transfer" id="">
                                    @foreach($themesAll as $th)
                                        <option value="{{$th['id']}}">{{$th['name']}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">
                                    Переместить
                                </button>
                            </form>
                        @endif
                    </div> <!-- cd-faq-content -->
                </li>
            @endif
        @endforeach
    @endforeach
</ul>