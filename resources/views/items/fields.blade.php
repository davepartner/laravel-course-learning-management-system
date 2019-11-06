

<input type="hidden" name="course_id" value="{{ $course_id }}" >
<!-- Url Field -->
<div class="col-md-12" >
<div class="form-group col-md-6">
<h3> Course: <a href="/courses/{{$course->id}}"> {{ $course->title }} </a></h3></div>

</div>
</div>

<div class="col-md-12" >
<div class="form-group col-md-6">
<h4>  Add or modify item </h4>
</div>
</div>

<!-- Url Field -->
<div class="col-md-12" >
<div class="form-group col-md-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','required']) !!}
</div>
</div>

<!-- Url Field -->
<div class="col-md-12" > 
<div class="form-group col-md-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="col-md-12" > 
    <div class="form-group col-md-6">
    <label for="sel1">Status:</label>
    <select class="form-control" id="sel1" name="is_free">

        @if(isset($item))
        <option value="{{ $item->is_free }}">
            @if($item->is_free  == 0)
            Paid 
            @elseif($item->is_free  == 1)
            Free 
            @endif </option>
  @endif
        <option value="1">Free</option>
        <option value="0">Paid</option>
    </select>
    </div>
</div>


<!-- Description Field -->
<div class="form-group col-md-12 ">
  {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>  

<!-- Submit Field -->
<div class="form-group col-md-12">
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
</div>
