@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                @can('users_manage')
                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-users"></i>
                        <span> @lang('templates.user control') </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.customers.index') }}">@lang('templates.customers')</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}">@lang('templates.users')</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="{{ route('admin.templates.index') }}">
                        <i class="icon-note"></i>
                        <span> @lang('templates.tables') </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.logs.index') }}">
                        <i class="fe-clock"></i>
                        <span> @lang('templates.logs') </span>
                    </a>
                </li>
                @endcan

                <li>
                    <a href="{{ route('datas.index') }}">
                        <i class="icon-pencil"></i>
                        <span> @lang('templates.datas') </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
    <button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}
