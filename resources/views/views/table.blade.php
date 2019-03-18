<table class="table table-responsive" id="views-table">
    <thead>
        <tr>
            <th>User Id</th>
        <th>User Account Id</th>
        <th>Category Id</th>
        <th>Course Id</th>
        <th>Item Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($views as $view)
        <tr>
            <td>{!! $view->user_id !!}</td>
            <td>{!! $view->user_account_id !!}</td>
            <td>{!! $view->category_id !!}</td>
            <td>{!! $view->course_id !!}</td>
            <td>{!! $view->item_id !!}</td>
            <td>
                {!! Form::open(['route' => ['views.destroy', $view->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('views.show', [$view->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('views.edit', [$view->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>