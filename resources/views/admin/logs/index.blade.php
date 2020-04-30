@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.logs.index') }}"><i class="fe-clock"></i><span> @lang('templates.logs') </span></a>
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">@lang('templates.logs')</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-md-3 pt-4 pl-3">
            <!-- <input type="text" id="range-datepicker" class="form-control flatpickr-input" placeholder="2019-10-03 to 2019-10-10" readonly="readonly"> -->
        </div>
        <div class="card-body">
            <div class="responsive-table-plugin">
                <div class="table-rep-plugin">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dt-responsive table-striped nowrap dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('templates.username')</th>
                                    <th>@lang('templates.email')</th>
                                    <th>@lang('templates.login time')</th>
                                    <!-- <th>@lang('templates.action')</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php $index = 0 @endphp
                                @foreach ($logs as $log)
                                    @php $index ++ @endphp
                                    <td>{{ $index }}</td>
                                    <td>{{ $log->user_name }}</td>
                                    <td>{{ $log->user_email }}</td>
                                    <td>{{ $log->created_at }}</td>
                                    <!-- <td> -->
                                        <!-- <a href="{{ url('/admin/logs/' . $log->id . '/edit') }}" class="btn btn-warning btn-xs waves-effect waves-light"><i class="mdi mdi-square-edit-outline"></i> @lang('templates.edit') </a> -->
                                        <!-- <button type="button" class="btn btn-danger btn-xs waves-effect waves-light" onclick="del({{ $log->id }})"><i class="mdi mdi-delete"></i> @lang('templates.delete') </button> -->
                                    <!-- </td> -->
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
        // $('document').ready(function(){
        //     $("#range-datepicker").change(function(){
        //         var date = $("#range-datepicker").val();
        //         alert(date);
        //         $.ajax({
        //             url: "{{ url('/admin/logs/getData') }}",
        //             data: date,
        //             type: 'post',
        //             dataType: 'text',
        //             success: function(data) {
        //                 window.location="{{ route('admin.logs.index') }}";
        //             }
        //         });
        //     });
        // });

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
                        url: "{{ url('/admin/logs/destroy') }}" + "/" + id,
                        type: 'post',
                        dataType: 'text',
                        success: function(data) {
                            window.location="{{ route('admin.logs.index') }}";
                        }
                    });
                }
            });
        }
    </script>
@endsection