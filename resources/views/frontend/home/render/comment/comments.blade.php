@forelse($comments as $comment)
    @include('frontend.home.render.comment.single-comment')
@empty
    {{--<li class="empty">No comments yet</li>--}}
@endforelse