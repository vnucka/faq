@foreach($themes as $theme)
    <ul id="theme_{{$theme['id']}}" class="cd-faq-group">
        <li class="cd-faq-title"><h2>{{$theme['name']}}</h2></li>
        @foreach($questions as $question)
            @if($theme['id'] == $question['theme_id'])
                <li>
                    <a class="cd-faq-trigger" href="#">{{$question['name']}}</a>
                    <div class="cd-faq-content">
                        <div class="header">
                            <a href="#"><p class="name-author">{{$question['user']['name']}}</p></a>
                            <p class="date-create">/ {{$question['created_at']}}</p>
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

                        <div class="open-forms reply-btn" data-form="reply">
                            <a href="{{ url('/faq-reply') }}?question_id={{$question['id']}}">
                                <p>Ответить</p>
                            </a>
                        </div>
                    </div> <!-- cd-faq-content -->
                </li>
            @endif
        @endforeach
    </ul>
@endforeach
