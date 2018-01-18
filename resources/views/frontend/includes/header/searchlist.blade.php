@forelse($search_sugstns as $sugstn)
    <li class=""><a class="search-keyword" href="javascript://">{{$sugstn->search_text}}</a>
    </li>
@empty
@endforelse
@forelse($users as $user)
    <li><a class="user" href="{{route('frontend.user.profile',$user->id)}}">{{$user->name}}</a></li>
@empty
@endforelse
@forelse($posts as $post)
    <li><a class="post" href="{{route('frontend.post.details',$post->id)}}">{{$post->post_details}}</a></li>
    {{--    <li><a class="post" href="{{route('frontend.home')."#post_id_$post->id"}}">{{$post->post_details}}</a></li>--}}
@empty
@endforelse