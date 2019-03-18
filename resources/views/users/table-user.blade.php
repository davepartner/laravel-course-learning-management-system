
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
            <td>${!! $user->pivot->paid_amount !!}</td>
            <td>
                   @if(Auth::check() AND  Auth::user()->role_id < 3  )
             
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}

                  @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

