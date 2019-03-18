<table class="table table-responsive" id="comments-table">
    <thead>
        <tr>
        <th></th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($comments as $comment)
        <tr>
            <td>
                <div> <a href="/users/{{$comment->user['id'] }}}}" class="text-bold">
                    {{ $comment->user['name'] }} </a> - 
                    <span class="text-muted"> {{ $comment->created_at->format('h:i a - D d M Y') }} </span> </div>
                {!! $comment->body !!}</td>
            <td>
                @if(Auth::check() AND (Auth::user()->id == $comment->user_id || Auth::user()->role_id < 3 ) )
                {!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('comments.edit', [$comment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>