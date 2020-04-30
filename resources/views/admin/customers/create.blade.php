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
                        <li class="breadcrumb-item active">@lang('templates.add new customer')</li>
                    </ol>
                </div>
                <h4 class="page-title">@lang('templates.add new customer')</h4>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="pt-4 pl-4">
            <a href="{{ route('admin.customers.index') }}"><i class="mdi mdi-arrow-left-drop-circle"></i> @lang('templates.back to customers') </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.customers.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label text-right" for="name">@lang('templates.name')</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" maxlength="50">
                                @if ($errors->has('name'))
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label text-right" for="color">@lang('templates.color scheme')</label>
                            <div class="col-md-9">
                                <select class="form-control" name="color">
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
                                @if ($errors->has('logo'))
                                    <strong class="text-danger">{{ $errors->first('logo') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-0 justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-block btn-primary waves-effect waves-light">@lang('templates.save customer')</button>
                            </div>
                        </div>                        
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

