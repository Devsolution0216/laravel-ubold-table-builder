@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}"><i class="fe-users"></i><span> @lang('templates.user control') </span></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.customers.index') }}"> @lang('templates.customers') </a>
                        </li>
                        <li class="breadcrumb-item active">@lang('templates.edit customer')</li>
                    </ol>
                </div>
                <h4 class="page-title">@lang('templates.edit customer')</h4>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="pt-4 pl-4">
            <a href="{{ route('admin.customers.index') }}"><i class="mdi mdi-arrow-left-drop-circle"></i> @lang('templates.back to customers') </a>
        </div>
        <div class="card-body">
            <form action="{{ url('/admin/customers/' . $customer->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label text-right" for="name">@lang('templates.name')</label>
                            <div class="col-md-9">
                                <input type="text" maxlength="50" class="form-control" name="name" value="{{ $customer->name }}">
                                @if ($errors->has('name'))
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label text-right" for="color">@lang('templates.color scheme')</label>
                            <div class="col-md-9">
                                <select class="form-control" id="color" name="color">
                                    <option value="1">@lang('templates.preloader')</option>
                                    <option value="2">@lang('templates.dark side bar')</option>
                                    <option value="3">@lang('templates.light top bar')</option>
                                </select>
                                @if ($errors->has('color'))
                                    <strong class="text-danger">{{ $errors->first('color') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label text-right" for="logo">@lang('templates.logo')</label>
                            <div class="col-md-9">
                                <input type="file" class="dropify" data-height="70" name="logo"/>
                            </div>
                        </div>

                        <div class="form-group mb-0 justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-block btn-primary waves-effect waves-light">@lang('templates.save change customer')</button>
                            </div>
                        </div>                        
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        $('document').ready(function(){
            init();
        });

        function init(){
            $("#color").val("{{ $customer->color }}");
        }
    </script>
@endsection