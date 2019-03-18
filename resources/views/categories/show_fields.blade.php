
<!-- View Count Field -->
<div class="form-group w-100 small text-muted text-right">
    {!! Form::label('view_count', 'Page Views:') !!} {!! $category->view_count !!}
   
</div>


<h1> {!! $category->name !!} </h1>
<!-- Description Field -->
<div class="form-group w-100">
    <p>{!! $category->description !!}</p>
</div>
<br>


<br/>
<!-- Created At Field -->
<div class="form-group w-100 small text-muted">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $category->created_at->format('h:m a - D d M Y')  !!}</p>
</div>
<br/>
<!-- Updated At Field -->
<div class="form-group w-100 small text-muted ">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $category->updated_at->format('h:m a - D d M Y') !!}</p>
</div>

