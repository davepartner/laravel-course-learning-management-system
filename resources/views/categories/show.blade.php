@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Course categories 
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row "  style="padding-left: 20px;
                padding-top: 30px;
                padding-right: 20px;" >
                    @include('categories.show_fields')

<h2 class="text-center w-100"> Courses </h2>
                    @include('courses.table')
                </div>
            </div>
        </div>
    </div>
@endsection
