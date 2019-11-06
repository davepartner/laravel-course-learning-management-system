
   @if(Auth::check() AND (Auth::user()->id == $course->user_id || 
        Auth::user()->role_id < 3))
            <div class="pull-left col-md-8"> 
                    <a class="btn btn-lg btn-primary" 
                    href="{{ route('items.create', ['course_id'=> $course->id ]) }}"> 
                        <i class="glyphicon glyphicon-plus"> </i>
                        Add Item </a>
           
        <button class="btn btn-lg btn-danger ml-3" data-toggle="modal" data-target="#importYoutubeModal"> 
            <i class="glyphicon glyphicon-plus"> </i>
            Import from youtube </button>

 

<!-- Youtube Modal -->
<div class="modal fade" id="importYoutubeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
       
        <h4 class="modal-title text-left" id="myModalLabel">Import videos from youtube playlist</h4>

 <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
      </div>
      {!! Form::open(['route' => 'items.import-youtube']) !!}

 <div class="modal-body">
        
    
        <input type="hidden" name="course_id" value="{{ $course->id }}" >
            <!-- Url Field -->
        <div class="form-group col-md-12 text-left">
            {!! Form::label('youtube_playlist_url', 'Youtube Playlist Url:') !!}
            {!! Form::text('youtube_playlist_url', $course->playlist_url, ['class' => 'form-control', 'placeholder'=> 'eg. https://youtube.com...']) !!}
        </div>
      </div>
      <div class="modal-footer">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

      {!! Form::close() !!}

    </div>
  </div>
</div>





<!-- Payment Modal -->
<div class="modal fade" id="paymentOptions" tabindex="-1" role="dialog" aria-labelledby="paymentOptionsLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
       
        <h4 class="modal-title text-left" id="paymentOptionsLabel">Complete payment to access this course</h4>

 <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
      </div>
      

 <div class="modal-body">
        
    @include('courses.payment-options')
    
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>


    </div>
  </div>
</div>










            </div>
    @endif
<h2 class="col-md-8 text-center">Course contents</h2>

<div class="col-md-8">
<table class="table table-responsive"  id="items-table">
    <thead>
        <tr>
        
        <th></th>
        <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
      <style>
          /* A link that has been visited */
         .greywhenvisited a:visited {
              color: grey;
          }

      </style>
         
    @foreach($course->items as $item)
        <tr>
            {{-- {!! $item->url !!} --}}
            <td data-toggle="modal" data-target="#modal-default" class="greywhenvisited">
                
                  {{-- @if(isset($item->thumbnail))
                 <a href="{{ route('courses.items', ['course_id'=> $course->id, 'item_id'=>$item->id ] ) }}"> 
               
                  <img class="col-md-3" src="{{ $item->thumbnail }}"  style="margin-top: 30px; padding-right: 0px; padding-left: 0px;">
                 </a>
                  @endif --}}
                 
                        
                
                <div class="col-md-9" style="padding-left: 5px;padding-right: 5px;">
                        <div data-toggle="modal" data-target="#modal-default" > 
                       <i style="margin-right:10px; font-size: 18px; " class="pull-left glyphicon glyphicon-play-circle"></i> 
                          
                       <b>
                       @if(isset($getSubscription->created_at) || Auth::user()->id == $course->user_id || Auth::user()->role_id < 3 || $item->is_free == 1) 
                                    
<a href="{{ route('courses.items', ['course_id'=> $course->id, 'item_id'=>$item->id ] ) }}"> 
                            {{ $item->title }} </a> 
                            <small>
                                @if($item->is_free == 0 && Auth::user()->role_id < 3)
                                    [not free]
                                @endif 
                            </small>
                            @else
                            <a href="#" style="color:brown" data-toggle="modal" data-target="#paymentOptions"> 
                            {{ $item->title }} </a> 
                              @endif

                            </b>
                            </div>
                        @if(Auth::user()->role_id < 3)
                          <div class="text-muted">{!! $item->view_count !!} views </div>
                        @endif

                        {!! $item->description !!}
                        {{-- {!! mb_strimwidth($item->description, 0, 150, '...') !!} --}}
                  </div>
            </td>
            <td>
                @if(Auth::check() AND (Auth::user()->role_id < 3 || Auth::user()->id == $course->id ))
                {!! Form::open(['route' => ['items.destroy', $item->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('items.edit', [$item->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}

                @endif
            </td>
        </tr>




    


    @endforeach
    </tbody>
</table>

</div>

