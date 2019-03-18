

<div class="form-group col-md-12">
     <p>{!! $course->sub_title !!}
         <div class="text-muted col-md-6">
             
            @if($course->subscriber_count > 0)
            | Students : {{ number_format($course->subscriber_count) }}
            @endif
            @if($course->view_count > 0)
            | Views : {{ number_format($course->view_count) }}
            @endif
            

            <!-- Created At Field -->
<div class="form-group col-md-6">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $course->created_at->format('h:i a - D d M Y') !!}</p>
</div>
<!-- Updated At Field -->
<div class="form-group col-md-6">
    {!! Form::label('updated_at', 'Last Updated:') !!}
    <p>{!! $course->updated_at->format('h:i a - D d M Y') !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('user_id', 'Author:') !!}
    <p><a href="/users/{{$course->user['id']}}"> {!! $course->user['name'] !!}</a></p>
</div>

<!-- Category Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('category_id', 'Category :') !!}
    <p><a href="/categories/{!! $course->category['id'] !!}">{{ $course->category['name'] }} </a></p>
</div>
         </div>

         @if(!isset($getSubscription->created_at) )
                   
         @include('courses.payment-options')

          @endif

                        
                        </div>

     </p>
</div>



@if(Auth::check() AND (Auth::user()->role_id < 3 || Auth::user()->id == $course->user_id))
        <!-- Creator Status Field -->
        <div class="form-group col-md-6">
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
                <div class="form-group col-md-6">
                    {!! Form::label('admin_status', 'Admin Status:') !!}

                    <p>
                        
                         @if($course->admin_status == 1)
                                Approved 
                                @if(Auth::user()->role_id < 3)
                                        | 
                                         {!! Form::open(['route' => ['courses.disapprove', $course->id], 'method' => 'post']) !!}
                                               <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Click to disapprove', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure disapprove?')"]) !!}
                                         {!! Form::close() !!}
                                @endif
                            @else
                                Disapproved 
                                    @if(Auth::user()->role_id < 3)
                                                | 
                                       {!! Form::open(['route' => ['courses.approve', $course->id], 'method' => 'post']) !!}
                                            <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                            {!! Form::button('<i class="glyphicon glyphicon-thumbs-up"></i> Click to approve', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('Are you sure you want to approve?')"]) !!}
                                         {!! Form::close() !!}
                                    @endif 
                            @endif 

                   </p>
                </div>

@endif







<!-- Description Field -->
<div class="form-group col-md-8">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $course->description !!}</p>
</div>

<!-- About Instructor Field -->
<div class="form-group col-md-8">
    {!! Form::label('about_instructor', 'About Instructor:') !!}
    <p>{!! $course->about_instructor !!}</p>
</div>


<!-- Tags Field -->
<div class="form-group col-md-8">
    {!! Form::label('tags', 'Tags:') !!}
    <p>{!! $course->tags !!}</p>
</div>

<!-- Promo Video Url Field -->
{{-- <div class="form-group">
    {!! Form::label('promo_video_url', 'Promo Video Url:') !!}
    <p>{!! $course->promo_video_url !!}</p>
</div> 


<!-- Playlist Url Field -->
<div class="form-group">
    {!! Form::label('playlist_url', 'Playlist Url:') !!}
    <p>{!! $course->playlist_url !!}</p>
</div>
--}}


<!-- What Will Students Learn Field -->
<div class="form-group col-md-8">
    {!! Form::label('what_will_students_learn', 'What Will Students Learn:') !!}
    <p>{!! $course->what_will_students_learn !!}</p>
</div>

<!-- Target Students Field -->
<div class="form-group col-md-8">
    {!! Form::label('target_students', 'Target Students:') !!}
    <p>{!! $course->target_students !!}</p>
</div>

<!-- Requirements Field -->
<div class="form-group col-md-8">
    {!! Form::label('requirements', 'Requirements:') !!}
    <p>{!! $course->requirements !!}</p>
</div>





