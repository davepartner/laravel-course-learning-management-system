







<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
            <th></th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
     @foreach($categories as $category)
        <tr>
            <td>
                <h3 style="margin-bottom: 0px;">
       <a href="{!! route('categories.show', [$category->id]) !!}" >
            {!! $category->name !!}  ({!! $category->courses_count !!})
       </a> 
               </h3>
                          
               
<div>          <small class="text-muted"> 
    Views: {!! number_format($category->view_count) !!}</small>
       </div>
<div>  {!! str_limit($category->description, $limit = 150, $end = '...') !!} </div>

            </td>
        
            <td>
                 @if (Auth::check() AND Auth::user()->role_id < 3)
                {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('categories.edit', [$category->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}

                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>