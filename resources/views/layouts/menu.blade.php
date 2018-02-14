<li class="{{ Request::is('days*') ? 'active' : '' }}">
    <a href="{!! route('days.index') !!}"><i class="fa fa-edit"></i><span>Days</span></a>
</li>

<li class="{{ Request::is('sessions*') ? 'active' : '' }}">
    <a href="{!! route('sessions.index') !!}"><i class="fa fa-edit"></i><span>Sessions</span></a>
</li>

<li class="{{ Request::is('sessions*') ? 'active' : '' }}">
    <a href="{!! route('sessions.index') !!}"><i class="fa fa-edit"></i><span>Sessions</span></a>
</li>

