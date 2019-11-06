@extends('layouts.app', ['title'=> $course->title])

@section('content')
    <section class="content-header">

        @if(Auth::check() && Auth::user()->id == $course->user_id)
        <a href="{!! route('courses.edit', [$course->id]) !!}" 
            class='btn btn-primary btn-lg pull-right'>
            <i class="glyphicon glyphicon-edit"></i> Edit course</a>
        @endif
    </section>


    <div class="content">

        <div class="clearfix"></div>
           @include('flash::message')
        <div class="clearfix"></div>


        <div class="box box-primary">
            
            <div class="box-body">
 
                    @include('courses.header')
                    {{-- Show menu only if person has paid or is owner or is admin --}}
            @if(isset($getSubscription->created_at) || (Auth::check() && (Auth::user()->id == $course->user_id || Auth::user()->role_id < 3)  ) )
               
            @include('courses.menu')
                 
                    @endif

                <div class="row" style="padding-left: 20px; 
                font-size: 15px !important;">

                    @if(isset($items) AND $items == 'yes')
                         @include('courses.show-item')
                    @elseif(isset($subscribers) AND $subscribers == 'yes')
                         @include('courses.subscribers')
                    @elseif(isset($contents) AND $contents == 'yes')
                         @include('courses.contents')
                    @elseif(isset($description) AND $description == 'yes')
                        @include('courses.show_fields')
                    @elseif(isset($comments) AND $comments == "yes")
                     <h2 class="col-md-12">Comments and Reviews</h2>
                        @include('comments.table')
                    @endif


                   
                </div>
            </div>
        </div>
  
@endsection
