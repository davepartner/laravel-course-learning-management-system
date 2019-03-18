 @if(Auth::check())
        <div class="box box-primary col-md-12">
@include('adminlte-templates::common.errors')
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'comments.store']) !!}

                    @if(isset($item->comments))
                    <input type="hidden" name="item_id" value="{{$item->id}}" />
                    @elseif($course->comments)
                     <input type="hidden" name="course_id" value="{{$course->id}}" />
                     @endif
                        <!-- Body Field -->
                    <div class="form-group col-sm-12 col-lg-12">
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows'=>'4']) !!}
                    </div>

                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Add comment', ['class' => 'btn btn-primary']) !!}
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endif







<table class="table table-responsive" id="comments-table">
    <thead>
        <tr>
        <th></th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if(isset($course->comments)){
            $mainComment = $course->comments;
        }

        if(isset($item->comments)){
            $mainComment = $item->comments;
        }

        ?>
    @foreach($mainComment as $comment)
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