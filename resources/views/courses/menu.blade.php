<div class="col-md-2 pull-right">
<ul class="nav nav-pills text-bold nav-stacked ">
  <li role="presentation" 

        @if(isset($description) AND $description == 'yes')
          class="active"
        @endif
  >
      <a href="{{ route('courses.show',['id' => $course->id]) }}"><i class="glyphicon glyphicon-home"></i>Course Home</a></li>
  <li role="presentation" 
    @if(isset($contents) AND $contents == 'yes')
          class="active"
        @endif
  
  >
    <a href="{{ route('courses.contents',['course_id' => $course->id]) }}">
      <i class="glyphicon glyphicon-align-right"></i>Contents ({{$course->items_count}}) </a></li>
  
  <li role="presentation"
      @if(isset($comments) AND $comments == 'yes')
          class="active"
        @endif
  
  ><a href="{{ route('courses.comments',['course_id' => $course->id]) }}">
    <i class="glyphicon glyphicon-cloud"></i>Comments ({{$course->comments_count}})
    </a></li>



  @if(Auth::check() AND (Auth::user()->id == $course->user_id || Auth::user()->role_id < 3 ) ) 
  <li role="presentation"
      @if(isset($subscribers) AND $subscribers == 'yes')
          class="active"
        @endif
  
  ><a href="{{ route('courses.subscribers',['course_id' => $course->id]) }}">
    <i class="glyphicon glyphicon-thumbs-up"></i>Subsribers ({{$course->users_count}})
    </a></li>

     <li role="presentation">
       <a href="#">
    <i class="glyphicon glyphicon-thumbs-up"></i>
    Views ({{$course->view_count}})
       </a>
    </li>


  @endif


</ul>

<!-- User Id Field -->
<div class="form-group col-md-12" style="margin-bottom:0px;padding-left:0px;padding-right:0px;">
    <p><i class="glyphicon glyphicon-user"></i> <a href="/users/{{$course->user['id']}}"> {!! $course->user['name'] !!}</a></p>
</div>

<!-- Category Id Field -->
<div class="form-group col-md-12" style="margin-bottom:0px;padding-left:0px;padding-right:0px;">
    <p><i class="glyphicon glyphicon-list-alt"></i> <a href="/categories/{!! $course->category['id'] !!}">{{ $course->category['name'] }} </a></p>
</div>            

<!-- Created At Field -->
<div class="form-group col-md-12" style="margin-bottom:0px;padding-left:0px;padding-right:0px;">
    <p></i><b>Created on:</b> {!! $course->created_at->format('h:i a - d M Y') !!}</p>
</div>
<!-- Updated At Field -->
<div class="form-group col-md-12" style="margin-bottom:0px;padding-left:0px;padding-right:0px;">
    <p><b>Last Updated:</b> {!! $course->updated_at->format('h:i a - d M Y') !!}</p>
</div>




@if(Auth::check() AND (Auth::user()->role_id < 3 || Auth::user()->id == $course->user_id))
        <!-- Creator Status Field -->
        <div class="form-group col-md-12">
            {!! Form::label('creator_status', 'Creator Status:') !!}
            <p>
              @if($course->creator_status == 1)
                                Published 
                                       
                                         {!! Form::open(['route' => ['courses.unpublishCourse', $course->id], 'method' => 'post']) !!}
                                               <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Click to Unpublish', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to unpublish?')"]) !!}
                                         {!! Form::close() !!}
                                
                            @else
                                Unpublished 
                                            
                                       {!! Form::open(['route' => ['courses.publishCourse', $course->id], 'method' => 'post']) !!}
                                            <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                            {!! Form::button('<i class="glyphicon glyphicon-thumbs-up"></i> Click to Publish', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('Are you sure you want to publish?')"]) !!}
                                         {!! Form::close() !!}
                                   
                            @endif 
</p>
        </div>
                <!-- Admin Status Field -->
                <div class="form-group col-md-12">
                    {!! Form::label('admin_status', 'Admin Status:') !!}

                    <p>
                        @if(Auth::user()->id == $course->user_id || Auth::user()->role_id < 3) 
                         @if($course->admin_status == 1 )
                                Approved 
                                @if(Auth::user()->role_id < 3)
                                        | 
                                         {!! Form::open(['route' => ['courses.disapprove', $course->id], 'method' => 'post']) !!}
                                               <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Click to disapprove', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure disapprove?')"]) !!}
                                         {!! Form::close() !!}
                                @endif
                            @else
                                Not yet approved 
                                    @if(Auth::user()->role_id < 3)
                                                | 
                                       {!! Form::open(['route' => ['courses.approve', $course->id], 'method' => 'post']) !!}
                                            <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                            {!! Form::button('<i class="glyphicon glyphicon-thumbs-up"></i> Click to approve', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('Are you sure you want to approve?')"]) !!}
                                         {!! Form::close() !!}
                                    @endif 
                            @endif 
                            @endif 

                   </p>
                </div>

@endif






</div>







<div class="form-group col-md-3 pull-right">
     <p>
         <div class="text-muted col-md-3">
             
            {{-- @if($course->subscriber_count > 0)
            | Students : {{ number_format($course->subscriber_count) }}
            @endif
            @if($course->view_count > 0)
            | Views : {{ number_format($course->view_count) }}
            @endif
             --}}




         </div>
     </p>
</div>

