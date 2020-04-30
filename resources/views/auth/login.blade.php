@extends('layouts.auth')

@section('content')
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">
                        
                        <div class="text-center w-75 m-auto">
                            <a href="index.html">
                                <span><img src="assets/images/logo-dark.png" alt="" height="50"></span>
                            </a>
                        </div>
                        
                        @if (count($errors) > 0)
                            <div class="alert alert-warning bg-warning text-white border-0">
                                <strong>@lang('templates.whoops')!</strong> @lang('templates.there were problems with input'):
                                <br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form role="form" method="POST" action="{{ url('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group mb-3">
                                <label for="emailaddress">@lang('templates.email address')</label>
                                <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="@lang('templates.enter your email')">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">@lang('templates.password')</label>
                                <input class="form-control" type="password" name="password" placeholder="@lang('templates.enter your password')">
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control checkbox checkbox-warning">
                                    <!-- <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                    <label class="custom-control-label" for="checkbox-signin">@lang('templates.remember me')</label> -->
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-warning btn-block" type="submit"> @lang('templates.log in') </button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <!-- <p> <a href="{{ route('auth.password.reset') }}" class="text-white-50 ml-1">Forgot your password?</a></p> -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<footer class="footer footer-alt">
    
</footer>

<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>
@endsection