<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Student Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('student_id', 'Student Id:') !!}
    {!! Form::text('student_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Course Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('course_id', 'Course Id:') !!}
    {!! Form::number('course_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category Id:') !!}
    {!! Form::number('category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Account Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_account_id', 'User Account Id:') !!}
    {!! Form::number('user_account_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Available On Course Page Field -->
<div class="form-group col-sm-6">
    {!! Form::label('available_on_course_page', 'Available On Course Page:') !!}
    {!! Form::text('available_on_course_page', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Deadline Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deadline', 'Deadline:') !!}
    {!! Form::date('deadline', null, ['class' => 'form-control']) !!}
</div>

<!-- Coundown Timer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coundown_timer', 'Coundown Timer:') !!}
    {!! Form::number('coundown_timer', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Available Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_available', 'Total Available:') !!}
    {!! Form::number('total_available', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Remaining Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_remaining', 'Total Remaining:') !!}
    {!! Form::number('total_remaining', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('coupons.index') !!}" class="btn btn-default">Cancel</a>
</div>
