  <div class="col-md-8">



<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Amount</th>
    </thead>
    <tbody>
    @foreach($course->users as $user)
        <tr>
            <td>{!! $user->name !!}</td>
            <td>
  <a href="{!! route('users.show', [$user->id]) !!}" >
      {!! $user->email !!}
  </a>
                  

            </td>
            <td>{!! $user->gender !!}</td>
            <td>N{!! $user->pivot->paid_amount !!}</td>
            <td>
                   @if(Auth::check() AND  Auth::user()->role_id < 3  )
             
                        {!! Form::open(['route' => ['courseUsers.destroy', $user->pivot->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('courseUsers.show', [$user->pivot->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{!! route('courseUsers.edit', [$user->pivot->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Delete this subscription?')"]) !!}
                        </div>
                        {!! Form::close() !!}

                  @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>













  </div>