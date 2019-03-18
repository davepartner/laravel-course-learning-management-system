@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Course User
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($courseUser, ['route' => ['courseUsers.update', $courseUser->id], 'method' => 'patch']) !!}

                        @include('course_users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection