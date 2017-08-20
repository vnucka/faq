<ul class="cd-faq-group cd-faq-group-users">
    @foreach($users as $user)
        @if($thisUser != $user['id'] && $user['name'] != 'admin')
                <li><a href="{{route ('userEdit')}}?user_id={{$user['id']}}">{{$user['name']}} / {{$user['email']}} / {{$user['role']}}</a></li>
        @endif
    @endforeach
</ul>