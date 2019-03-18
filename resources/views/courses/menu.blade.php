<div class="col-md-12">
<ul class="nav nav-pills text-bold ">
  <li role="presentation" 

        @if(isset($description) AND $description == 'yes')
          class="active"
        @endif
  >
      <a href="{{ route('courses.show',['id' => $course->id]) }}">Course Home</a></li>
  <li role="presentation" 
    @if(isset($contents) AND $contents == 'yes')
          class="active"
        @endif
  
  >
    <a href="{{ route('courses.contents',['course_id' => $course->id]) }}">Contents ({{$course->items_count}}) </a></li>
  

  @if(Auth::check() AND (Auth::user()->id == $course->user_id || Auth::user()->role_id < 3 ) ) 
  <li role="presentation"
      @if(isset($subscribers) AND $subscribers == 'yes')
          class="active"
        @endif
  
  ><a href="{{ route('courses.subscribers',['course_id' => $course->id]) }}">Subsribers ({{$course->users_count}})
    </a></li>
  @endif

  <li role="presentation"
      @if(isset($comments) AND $comments == 'yes')
          class="active"
        @endif
  
  ><a href="{{ route('courses.comments',['course_id' => $course->id]) }}">Comments ({{$course->comments_count}})
    </a></li>


</ul>
</div>