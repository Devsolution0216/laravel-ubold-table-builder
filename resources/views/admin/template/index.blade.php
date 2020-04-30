@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.templates.index') }}"><i class="icon-note"></i><span> @lang('templates.tables') </span></a>
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">@lang('templates.tablelist')</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="p-4">
            <a href="{{ route('admin.templates.create') }}" class="btn btn-success"><i class="icon-plus"></i> @lang('templates.add new') </a>
        </div>
        <div class="card-body">
            <div class="responsive-table-plugin">
                <div class="table-rep-plugin">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dt-responsive table-striped nowrap dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('templates.name')</th>
                                    <th>@lang('templates.col count')</th>
                                    <!-- <th>Fixed Row Count</th> -->
                                    <th>@lang('templates.customer')</th>
                                    <th>@lang('templates.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @foreach ($templates as $template)
                                    @php $index ++ @endphp
                                    <tr data-entry-id="{{ $template->id }}">
                                        <td>{{ $index }}</td>
                                        <td>{{ $template->name }}</td>
                                        <td>{{ $template->col_cnt }}</td>
                                        <!-- <td>{{ $template->fix_row_cnt }}</td> -->
                                        @php
                                            $customers = App\Models\Customer::find(explode(',', $template->customer_ids))->pluck('name');
                                        @endphp
                                        <td>
                                            @foreach ($customers as $customer)
                                                <span class="badge badge-blue">{{ $customer }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <!-- <a href="{{ url('/admin/templates/show').'/'.$template->id }}" class="btn btn-warning btn-xs waves-effect waves-light"><i class="mdi mdi-eye"></i> @lang('templates.view') </a> -->
                                            <a href="{{ url('/admin/templates').'/'.$template->id.'/edit' }}" class="btn btn-warning btn-xs waves-effect waves-light"><i class="mdi mdi-square-edit-outline"></i> @lang('templates.edit') </a>
                                            <button type="button" class="btn btn-danger btn-xs waves-effect waves-light" onclick="del({{ $template->id }})"><i class="mdi mdi-delete"></i> @lang('templates.delete') </button>
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
        var g_id = 0;
        
        function editModal(data) {
            $('#edit_name').val(data['name']);
            g_id = data['id'];
            $('#edit_modal').modal('show');
        }

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
                        url: "{{ url('/admin/templates/destroy') }}" + "/" + id,
                        type: 'post',
                        dataType: 'text',
                        success: function(data) {
                            window.location="{{ route('admin.templates.index') }}";
                        }
                    });
                }
            });
        }
    </script>
@endsection
