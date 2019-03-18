<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Is Subscribed</th>
        <th>Email Verified At</th>
        <th>View Count</th>
        <th>Role </th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->name !!}</td>
            <td>
  <a href="{!! route('users.show', [$user->id]) !!}" >
      {!! $user->email !!}
  </a>
                  

            </td>
            <td>{!! $user->gender !!}</td>
            <td>{!! $user->is_subscribed !!}</td>
            <td>{!! $user->email_verified_at !!}</td>
            <td>{!! $user->view_count !!}</td>
            <td>{!! $user->role['name'] !!}</td>
            <td>
                
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>