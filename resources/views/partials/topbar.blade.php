<!-- Topbar Start -->
@php $top_class = ""; $logo = "" @endphp
@if (App\Models\Customer::find(auth()->user()->customer_id)['color'] == 3)
    @php $top_class = "navbar-custom-light" @endphp
@endif

<div class="navbar-custom {{ $top_class }}">
    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{ url('/') }}" class="logo text-center">
            <span class="logo-lg">
                @if (auth()->user()->customer_id == 0)
                    <img src="{{ url('assets/images/logo-light.png') }}" alt="" height="30">
                @else
                    <img src="{{ url('storage/' . App\Models\Customer::find(auth()->user()->customer_id)['logo']) }}" alt="" height="57">
                @endif
            </span>
            <span class="logo-sm">
                @if (auth()->user()->customer_id == 0)
                    <img src="{{ url('assets/images/logo-sm.png') }}" alt="" height="57">
                @endif
            </span>
        </a>
    </div>
    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>

        <!-- avatar menu -->
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ url('assets/images/users/avatar.png') }}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        {{ auth()->user()->name }} 
                        <i class="mdi mdi-chevron-down"></i> 
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <a href="#logout" class="dropdown-item notify-item" onclick="$('#logout').submit();">
                        <i class="fe-log-out"></i>
                        <span>@lang('templates.logout')</span>
                    </a>
                </div>
            </li>
        </ul>
    </ul>
</div>




