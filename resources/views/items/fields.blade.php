

<input type="hidden" name="course_id" value="{{ $course_id }}" >
<!-- Url Field -->
<div class="form-group col-md-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>
<!-- Url Field -->
<div class="form-group col-md-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-md-8">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-md-12">
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
</div>
