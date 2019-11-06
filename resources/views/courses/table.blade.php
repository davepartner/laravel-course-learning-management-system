<table class="table table-responsive" id="courses-table">
    <thead>
        <tr>
        <th></th>
        <th></th>
        <th></th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($courses as $course)
        <tr>
            <td>{!! $course->photo !!}</td>
            <td width="80%">
                <h4  style="margin-bottom: 0px;">
            <i class="glyphicon glyphicon-education text-muted"></i>  Click here <i class="glyphicon glyphicon-hand-right"></i>     
              &nbsp; <a href="{!! route('courses.show', [$course->id]) !!}" >
                     {!! $course->title !!}
                    </a>
                </h4> 
           <div class="text-muted"> 
               <i class="glyphicon glyphicon-user"></i> 
               &nbsp;  &nbsp; &nbsp;{{ $course->user['name'] }} 
              &nbsp;  &nbsp; &nbsp; <i class="glyphicon glyphicon-eye-open"></i> 
               &nbsp; Views: {{ $course->view_count }} 

            @if($course->subscriber_count > 0)
            <i class="glyphicon glyphicon-education"> Students : {{ number_format($course->subscriber_count) }}
            @endif

           </div>
            
            <i class="glyphicon glyphicon-align-right text-muted"></i>  &nbsp; &nbsp; &nbsp; {!! $course->sub_title !!}
            </td>
            <td>
                <h3 style="margin-bottom: 0px;">${{ number_format($course->discount_price/360) }}
                    <small>
                         (₦{!! number_format($course->discount_price) !!})
                    </small>
                  
                    
                </h3>
               
            
            </td>

            <td>
                @if(Auth::check() AND (Auth::user()->role_id < 3 
                || $course->user_id == Auth::user()->id))
                {!! Form::open(['route' => ['courses.destroy', $course->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                   <a href="{!! route('courses.edit', [$course->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
                @endif
            </td>

        </tr>
    @endforeach
    </tbody>
</table>