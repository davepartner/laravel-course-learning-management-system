@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            View
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($view, ['route' => ['views.update', $view->id], 'method' => 'patch']) !!}

                        @include('views.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection