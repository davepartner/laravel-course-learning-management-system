<div class="col-md-8">

    <div class="col-md-12">
        @if(Auth::check() AND (Auth::user()->id == $item->user_id || Auth::user()->role_id < 3))
               <h2 class="text-right">
                  
                <a href="{{ route('items.edit', ['item_id'=> $item->id ]) }}" class="btn btn-xs btn-primary">
                     <i class="glyphicon glyphicon-new-window"></i>  Edit item</a></h2>
        @endif
               <h2> {{ $item->title }} 
            <br>
            <small> Views: {{  $item->view_count }} </small>
        </h2>
       {{-- Main video --}}

       <?php if(!empty($item->url)){ ?>

       <?php 
            $matches = array();
            $url =   $item->url ;
            $ret = preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);


       ?>



  @if(!isset($paymentShowing))

        @if($ret > 0)
                <iframe 
                width="100%" 
                height="450px" 
                src="https://www.youtube.com/embed/<?php echo  $matches[0]; ?>?&autoplay=1" 
                frameborder="0" 
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>

        @else

                <a href="{{ $item->url }}" target="_blank"> {{ $item->url  }} </a>

        @endif

        @if(isset($prevItem) && $prevItem > 0)
        <a href="/courses/items/{{$course->id}}/{{$prevItem}}" 
            class="pull-left btn btn-xs btn-default">
        << watch previous video
        </a>
        @endif 

         @if(isset($nextItem) && $nextItem > 0)
        <a href="/courses/items/{{$course->id}}/{{$nextItem}}"
             class="pull-right btn btn-xs btn-success">
        watch next video >>
        </a>
        @else 
        Congratulations, you have come to the end of this course. 
        Please do check back occassionally, the creator of this course might add more content in future.
        @endif 

   @endif





<?php } ?> 

         
    </div>

   
</div>




            






 <div class="col-md-4 pull-right">
        {{-- list of other videos --}}
        <h3> Playlist </h3> 
        
        <div class="list-group">
                    @foreach($course->items as $newItem)
                    <a href="{{ route('courses.items', ['course_id'=> $course->id, 'item_id'=> $newItem->id] ) }}" 
                        class="list-group-item 
                        @if($item->id == $newItem->id)
                            active text-bold 
                        @endif
                        " style="font-size:15px;"> 
                                <i class="glyphicon glyphicon-play"> </i>
                                {{ $newItem->title }} 
                            </a> 
                    @endforeach
         </div>
    </div>
    <div class="col-md-8 pull-left">
  <h2>Comments and Reviews</h2>
                        @include('comments.table')
    </div>