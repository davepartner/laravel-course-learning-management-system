<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{!! route('categories.index') !!}"><i class="fa fa-edit"></i><span>
        Course Categories</span></a>
</li>




<li class="{{ Request::is('courseUsers*') ? 'active' : '' }}">
    <a href="{!! route('courseUsers.index') !!}"><i class="fa fa-edit"></i><span>Subscriptions</span></a>
</li>

    
<li class="{{ Request::is('courses*') ? 'active' : '' }}">
    <a href="{!! route('courses.index') !!}"><i class="fa fa-edit"></i><span>Courses</span></a>
</li>

<li >
    <a href="#"><i class="fa fa-user"></i><span>ADMIN MENU</span></a>
</li>
{{-- Moderator 
@if (Auth::user()->role_id < 4)
<li class="{{ Request::is('courses*') ? 'active' : '' }}">
    <a href="{!! route('courses.index') !!}"><i class="fa fa-edit"></i><span>My Courses</span></a>
</li>
@endif--}}

{{-- Admin section --}}

@if (Auth::user()->role_id < 3)
    
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
