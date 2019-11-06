
<li class="{{ Request::is('courses*') ? 'active' : '' }}">
    <a href="{!! route('courses.index') !!}"><i class="fa fa-edit"></i><span>Courses</span></a>
</li>

<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{!! route('categories.index') !!}">
            <i class="glyphicon glyphicon-list"></i><span>
        Course Categories</span></a>
</li>

 
<li class="{{ Request::is('payments*') ? 'active' : '' }}">
    <a href="{!! route('payments.index') !!}">
        <i class="fa">₦</i><span>My Payments</span></a>
</li>
<br/>
<br/>
<br/>
<li class="">
 <a href="{!! url('/logout') !!}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="glyphicon glyphicon-off"></i><span> Logout out
</a>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
</form>
</li>

<br>                     <br>

@if (Auth::user()->role_id < 3)
<li >
    <a href="#"><i class="fa fa-user"></i><span>ADMIN MENU</span></a>
</li>
   
<li class="{{ Request::is('courseUsers*') ? 'active' : '' }}">
    <a href="{!! route('courseUsers.index') !!}"><i class="glyphicon glyphicon-thumbs-up"></i><span>My Subscriptions</span></a>
</li>

{{-- Moderator 
@if (Auth::user()->role_id < 4)
<li class="{{ Request::is('courses*') ? 'active' : '' }}">
    <a href="{!! route('courses.index') !!}"><i class="fa fa-edit"></i><span>My Courses</span></a>
</li>
@endif--}}

{{-- Admin section --}}
    
<li class="{{ Request::is('courses*') ? 'active' : '' }}">
    <a href="{!! route('courses.index') !!}"><i class="fa fa-edit"></i><span>Admin Courses</span></a>
</li>


<li class="{{ Request::is('coupons*') ? 'active' : '' }}">
    <a href="{!! route('coupons.index') !!}"><i class="fa fa-edit"></i><span>Admin Coupons</span></a>
</li>

<li class="{{ Request::is('comments*') ? 'active' : '' }}">
    <a href="{!! route('comments.index') !!}"><i class="fa fa-edit"></i><span>Admin Comments</span></a>
</li>

<li class="{{ Request::is('items*') ? 'active' : '' }}">
    <a href="{!! route('items.index') !!}"><i class="fa fa-edit"></i><span>Admin Items</span></a>
</li>

<li class="{{ Request::is('payments*') ? 'active' : '' }}">
    <a href="{!! route('payments.index') !!}"><i class="fa fa-edit"></i><span>Admin Payments</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Admin Users</span></a>
</li>

<li class="{{ Request::is('views*') ? 'active' : '' }}">
    <a href="{!! route('views.index') !!}"><i class="fa fa-edit"></i><span>Admin Views</span></a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Admin Roles</span></a>
</li>


@endif
