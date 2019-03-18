
   @if(Auth::check() AND (Auth::user()->id == $course->user_id || 
        Auth::user()->role_id < 3))
            <div class="text-right col-md-12"> 
                    <a class="btn btn-lg btn-primary" 
                    href="{{ route('items.create', ['course_id'=> $course->id ]) }}"> 
                        <i class="glyphicon glyphicon-plus"> </i>
                        Add Item </a>
           
                    <button class="btn btn-lg btn-danger ml-3" data-toggle="modal" data-target="#importYoutubeModal"> 
                        <i class="glyphicon glyphicon-plus"> </i>
                        Import from youtube </button>

 

<!-- Modal -->
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
            {!! Form::text('youtube_playlist_url', null, ['class' => 'form-control', 'placeholder'=> 'eg. https://youtube.com...']) !!}
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
         
    @foreach($course->items as $item)
        <tr>
            {{-- {!! $item->url !!} --}}
            <td data-toggle="modal" data-target="#modal-default">
                
               <h3 data-toggle="modal" data-target="#modal-default"> 
                   
                <a href="{{ route('courses.items', ['course_id'=> $course->id, 'item_id'=>$item->id ] ) }}"> {{ $item->title }} </a> 
            
            </h3>
            <div class="text-muted">{!! $item->view_count !!} views </div>
                
            {!! mb_strimwidth($item->description, 0, 150, '...') !!}
          
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

