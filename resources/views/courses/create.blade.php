@extends('layouts.app',['title'=>'Create a course'])

@section('content')
    <section class="content-header">
        <h1>
            Course
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="col-md-8">
                    {!! Form::open(['route' => 'courses.store']) !!}

                        @include('courses.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
