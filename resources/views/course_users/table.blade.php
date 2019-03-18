<table class="table table-responsive" id="courseUsers-table">
    <thead>
        <tr>
        <th>Course</th>
        <th>Paid Date</th>
        <th>Expiry Date</th>
        <th>Plan</th>
        <th>Paid Amount</th>
        <th>Status</th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($courseUsers as $courseUser)
        <tr>
            <td><a class="text-bold" href="{{ route('courses.contents',['course_id' => $courseUser->course_id, 'contents'=> 'yes']) }}"> 
                    {!! $courseUser->course['title'] !!}
                  </a> 
            </td>
            <td>
                @if($courseUser->paid_date != null)
                      {!! $courseUser->paid_date->format('D d M Y') !!}
                @endif
            </td>
            <td>
                @if($courseUser->expiry_date != null)
                     {!! $courseUser->expiry_date->format('D d M Y') !!}
                @endif
            </td>
            <td>{!! $courseUser->plan !!}</td>
            <td>₦{!! number_format($courseUser->paid_amount) !!}</td>
            <td>

                @if($courseUser->status == 1)
                     active
                @else 
                     inactive
                @endif
            </td>
            <td>
                @if(Auth::check() AND Auth::user()->role_id < 3)
                    {!! Form::open(['route' => ['courseUsers.destroy', $courseUser->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('courseUsers.edit', [$courseUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>