<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

@if (auth()->user()->customer_id == 0)
    @php $body_class = "hold-transition skin-blue sidebar-mini" @endphp
@else
    @if (App\Models\Customer::find(auth()->user()->customer_id)['color'] == 1)
        @php $body_class = "" @endphp
    @elseif (App\Models\Customer::find(auth()->user()->customer_id)['color'] == 2)
        @php $body_class = "left-side-menu-dark" @endphp
    @else
        @php $body_class = "" @endphp
    @endif
@endif

<body class="{{ $body_class }}">
<div id="wrapper">

    @include('partials.topbar')
    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                @if(isset($siteTitle))
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ $siteTitle }}</h4>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- end page title --> 
                <div class="row">
                    <div class="col-md-12">
                        @if (Session::has('message'))
                            <div class="note note-info">
                                <p>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                @yield('content')

            </div> <!-- container -->
        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2019 &copy; MC
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>

</div>

{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}

@include('partials.javascripts')
</body>
</html>