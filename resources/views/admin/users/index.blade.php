@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}"><i class="fe-user-plus"></i><span> @lang('templates.user control') </span></a>
                        </li>
                        <li class="breadcrumb-item active">@lang('templates.users')</li>
                    </ol>
                </div>
                <h4 class="page-title">@lang('templates.users')</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="pt-4 pl-4">
            <a href="{{ route('admin.users.create') }}" class="btn btn-success"><i class="icon-plus"></i> @lang('templates.add new') </a>
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
                                    <th>@lang('templates.email')</th>
                                    <th>@lang('templates.roles')</th>
                                    <th>@lang('templates.customer')</th>
                                    <th>@lang('templates.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $index = 0 @endphp
                                @foreach ($users as $user)
                                    @php $index ++ @endphp
                                    <tr data-entry-id="{{ $user->id }}">
                                        <td>{{ $index }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles()->pluck('name') as $role)
                                                @if ($role == "Administrator")
                                                    <span class="badge badge-danger">{{ $role }}</span>
                                                @else
                                                    <span class="badge badge-warning">{{ $role }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ App\Models\Customer::find($user->customer_id)['name'] }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info"><i class="mdi mdi-square-edit-outline"></i> @lang('templates.edit')</a>
                                            {!! Form::open(array(
                                                'class' => 'needs-validation',
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'route' => ['admin.users.destroy', $user->id])) !!}
                                            {{ Form::button('<i class="fa fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger'] ) }}
                                            {!! Form::close() !!}
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
        var flag = false;

        window.route_mass_crud_entries_destroy = '{{ route('admin.users.mass_destroy') }}';
        $(document).ready(function(){            
            $('.needs-validation').on('submit', function(evt) {
                var form = this;
                if (flag) {
                    flage = false;
                    return true;
                }
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
                        flag = true;
                        $(form).submit();
                    }
                });
                return false;
            });
        });
    </script>
@endsection