@inject('request', 'Illuminate\Http\Request')
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
                        <li class="breadcrumb-item active">@lang('templates.customers')</li>
                    </ol>
                </div>
                <h4 class="page-title">@lang('templates.customers')</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="pt-4 pl-4">
            <a href="{{ route('admin.customers.create') }}" class="btn btn-success"><i class="icon-plus"></i> @lang('templates.add new') </a>
        </div>
        <div class="card-body">
            <div class="responsive-table-plugin">
                <div class="table-rep-plugin">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dt-responsive table-striped nowrap dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('templates.logo')</th>
                                    <th>@lang('templates.name')</th>
                                    <th>@lang('templates.color scheme')</th>
                                    <th>@lang('templates.api_key')</th>
                                    <th>@lang('templates.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $index = 0 @endphp
                                @foreach ($customers as $customer)
                                    @php $index ++ @endphp
                                    <tr data-entry-id="{{ $customer->id }}">
                                        <td>{{ $index }}</td>
                                        <td><img src="{{ url('/storage/' .  $customer->logo) }}" height="40"></td>
                                        <td>{{ $customer->name }}</td>
                                        @switch ($customer->color)
                                            @case (1)
                                                <td>@lang('templates.preloader')</td>
                                                @break
                                            @case (2)
                                                <td>@lang('templates.dark side bar')</td>
                                                @break
                                            @case (3)
                                                <td>@lang('templates.light top bar')</td>
                                                @break
                                        @endswitch
                                        <td>{{ $customer->api_key }}</td>
                                        <td>
                                            <a href="{{ url('/admin/customers/' . $customer->id . '/edit') }}" class="btn btn-warning btn-xs waves-effect waves-light"><i class="mdi mdi-square-edit-outline"></i> @lang('templates.edit') </a>
                                            <button type="button" class="btn btn-danger btn-xs waves-effect waves-light" onclick="del({{ $customer->id }})"><i class="mdi mdi-delete"></i> @lang('templates.delete') </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        function del(id) {
            swal({
                title: "{{ trans('templates.are you sure?') }}",
                text: "{{ trans('templates.you would not be able to revert this!') }}",
                type: "warning",
                showCancelButton: !0,
                confirmButtonClass: "btn btn-confirm mt-2",
                cancelButtonClass: "btn btn-cancel ml-2 mt-2",
                confirmButtonText: "{{ trans('templates.yes, delete it!') }}",
                cancelButtonText: "{{ trans('templates.cancel') }}",
            }).then(function(e) {
                if (e.value) {
                    $.ajax({
                        url: "{{ url('/admin/customer/destroy') }}" + "/" + id,
                        type: 'post',
                        dataType: 'text',
                        success: function(data) {
                            window.location="{{ route('admin.customers.index') }}";
                        }
                    });
                }
            });
        }
    </script>
@endsection