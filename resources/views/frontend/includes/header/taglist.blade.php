@forelse($tags as $tag)
    <li class=""><a class="search-keyword" href="{{url('search?q='.$tag)}}">{{$tag}}</a>
    </li>
@empty
@endforelse