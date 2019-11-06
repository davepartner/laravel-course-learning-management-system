   <?php if(!empty($course->promo_video_url)){ ?>

       <?php 
            $matches = array();
            $url =   $course->promo_video_url ;
            $ret = preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);

       ?>

 @if($ret > 0)
 
 <div class="row">
	 <br/>
	 <h3 class="text-danger col-md-9" style="padding-left: 15px;"> 
            <i class="glyphicon glyphicon-warning-sign"></i> 
       [Watch till end] Do not skip this video! </h3>
        
                <iframe 
				height="450px" 
                class="col-md-9" 
                src="https://www.youtube.com/embed/<?php echo  $matches[0]; ?>?&autoplay=1&controls=0&showinfo=0&loop=1" 
                frameborder="0" 
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
 </div>
        @else

                {{-- Watch <a href="{{ $course->promo_video_url }}" target="_blank"> Promo Video</a> --}}

        @endif
<?php } ?>







<!-- Description Field -->
<div class="form-group col-md-8">
   <h3>
       <i class="glyphicon glyphicon-align-justify"></i> {!! Form::label('description', 'Description:') !!}
   </h3>
    <p>{!! $course->description !!}</p>
</div>

{{-- @include('courses.payment-options') --}}

<!-- About Instructor Field -->
<div class="form-group col-md-12">
   <h3> <i class="glyphicon glyphicon-user"></i> {!! Form::label('about_instructor', 'About Instructor:') !!}</h3>
    <p>{!! $course->about_instructor !!}</p>
</div>


<!-- Tags Field -->
{{-- <div class="form-group col-md-12">
    <i class="glyphicon glyphicon-resize-small"></i> {!! Form::label('tags', 'Tags:') !!}
    <p>{!! $course->tags !!}</p>
</div> --}}

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
<div class="form-group col-md-12">
   <h3><i class="glyphicon glyphicon-education"></i> 
    {!! Form::label('what_will_students_learn', 'What Will Students Learn:') !!}</h3>
    <p>{!! $course->what_will_students_learn !!}</p>
</div>

<!-- Target Students Field -->
<div class="form-group col-md-12">
   <h3><i class="glyphicon glyphicon-user"></i><i class="glyphicon glyphicon-user"></i> 
    {!! Form::label('target_students', 'Target Students:') !!} </h3>
    <p>{!! $course->target_students !!}</p>
</div>

<!-- Requirements Field -->
<div class="form-group col-md-12">
    <h3><i class="glyphicon glyphicon-pushpin"></i> {!! Form::label('requirements', 'Requirements:') !!} </h3>
    <p>{!! $course->requirements !!}</p>
</div>

<!-- Faq Field -->
<div class="form-group col-md-12">
   <h3> <i class="glyphicon glyphicon-question-sign"></i> {!! Form::label('faq', 'Frequently asked questions:') !!}</h3>
    <p>{!! $course->faq !!}</p>
</div>


<div class="form-group col-md-12">
 @include('courses.payment-options')
</div>

   
