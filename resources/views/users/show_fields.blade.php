

<!-- View Count Field -->
<div class="form-group col-md-12 text-muted text-right">
    <p>Profile viewed {!! $user->view_count !!} times</p>
</div>


<!-- Name Field -->
<div class="form-group col-md-6">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group col-md-6">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $user->email !!}</p>
</div>

<!-- First Name Field -->
<div class="form-group col-md-6">
    {!! Form::label('first_name', 'First Name:') !!}
    <p>{!! $user->first_name !!}</p>
</div>

<!-- Last Name Field -->
<div class="form-group col-md-6">
    {!! Form::label('last_name', 'Last Name:') !!}
    <p>{!! $user->last_name !!}</p>
</div>

<!-- Gender Field -->
<div class="form-group col-md-6">
    {!! Form::label('gender', 'Gender:') !!}
    <p>{!! $user->gender !!}</p>
</div>






<!-- Created At Field -->
<div class="form-group  col-md-6">
    {!! Form::label('created_at', 'Joined:') !!}
    <p>{!! $user->created_at->format('h:i a - D d M Y') !!}</p>
</div>



@if(Auth::check() AND (Auth::user()->user_id == $user->id || Auth::user()->role_id < 3))

<!-- Role Id Field -->
<div class="form-group col-md-6">
    {!! Form::label('role_id', 'Role:') !!}
    <p>{!! $user->role['name'] !!}</p>
</div>
<!-- Date Of Birth Field -->
<div class="form-group col-md-6">
    {!! Form::label('date_of_birth', 'Date Of Birth:') !!}
    <p>{!! $user->date_of_birth !!}</p>
</div>
<!-- Updated At Field -->
<div class="form-group col-md-6">
    {!! Form::label('updated_at', 'Last Updated:') !!}
    <p>{!! $user->updated_at !!}</p>
</div>

@endif



@if(Auth::check() AND Auth::user()->role_id < 3)
<!-- Is Subscribed Field -->
<div class="form-group col-md-6">
    {!! Form::label('is_subscribed', 'Is Subscribed:') !!}
    <p>{!! $user->is_subscribed !!}</p>
</div>

<!-- Email Verified At Field -->
<div class="form-group col-md-6">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    <p>{!! $user->email_verified_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group col-md-6">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $user->deleted_at !!}</p>
</div>

@endif