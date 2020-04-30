@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('datas.index') }}"><i class="icon-pencil"></i><span> @lang('templates.datas') </span></a>
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">@lang('templates.datas')</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="pt-4 pl-4 pr-4">
            <div class="row">
                <div class="col-md-4">
                    <button onclick="create();" class="btn btn-success"><i class="icon-plus"></i> @lang('templates.add new') </button>
                </div>

                <div class="col-md-3">
                    <select name="" id="select_customer" class="form-control" {{ Auth()->user()->customer_id != 0 ? 'hidden' : '' }}>
                        <option value="0" {{ Auth()->user()->customer_id == 0 ? 'selected' : '' }}>Admin</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{ Auth()->user()->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button onclick="saveDefault();" class="btn btn-success" {{ Auth()->user()->customer_id == 0 ? 'hidden' : '' }}><i class=""></i> @lang('templates.make default') </button>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <select name="" id="select_template" class="form-control">
                            @if (Auth()->user()->default_table != 0)
                                @php $templates = App\Models\Template::where('customer_ids', 'LIKE', '%,'. Auth()->user()->customer_id .',%')->get(); @endphp
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id }}" {{ Auth()->user()->default_table == $template->id ? 'selected' : '' }}>{{ $template->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="responsive-table-plugin">
                <div class="table-rep-plugin">
                    <div id="table" class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        $('document').ready(function(){
            init();

            $('#select_customer').change(function(e){
                var customerId = $(this).val();
                getTemplates(customerId);
            });

            $('#select_template').change(function(e){
                var templateId = $(this).val();
                var customerId = $('#select_customer').val();
                if (templateId)
                    getDetails(customerId, templateId);
                else
                    initTable("");
            });
        });

        function init(){
            var customerId = $('#select_customer').val();
            @if (session('customerId'))
            customerId = {{ session('customerId') }};
                $('#select_customer').val(customerId);
            @endif

            @if (Auth()->user()->default_table == 0)
                getTemplates(customerId);
            @endif
            
            var templateId = $('#select_template').val();
            customerId = $('#select_customer').val();
            if (templateId)
                getDetails(customerId, templateId);
            else
                initTable("");
        }

        function getTemplates(customerId){
            $.ajax({
                url: "{{ url('/getTemplates') }}" + "/" + customerId,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    var templateHtml = '';
                    $.each(data, function(key, value) {
                        templateHtml += '<option value="'+ value.id +'">'+ value.name +'</option>';
                    });
                    $('#select_template')
                    .empty()
                    .append(templateHtml);
                    @if (session('templateId'))
                        $('#select_template').val({{ session('templateId') }});
                    @endif
                    $("select[id^='select_template']").change();
                }
            });
        }

        function getDetails(customerId, templateId){
            $.ajax({
                url: "{{ url('/getDetails') }}" + '/' + customerId + '/' + templateId,
                type: 'get',
                dataType: 'text',
                success: function(data) {
                    initTable(data);
                }
            });
        }

        function initTable(htmlTable){
            $('#table').html(htmlTable);
            $('#dataTable').DataTable({
                language:{
                    "sEmptyTable":   	"Ningún dato disponible en esta tabla",
                    "sInfo":         	"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":    	"Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": 	"(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":  	"",
                    "sInfoThousands":  	".",
                    "sLengthMenu":   	"Mostrar _MENU_ registros",
                    "sLoadingRecords": 	"Cargando...",
                    "sSearch":       	"Buscar",
                    "sZeroRecords":  	"No se encontraron resultados",
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                paginate:{
                    previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"
                },
                },drawCallback:function(){
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }
            });
        }

        function create(){
            var customerId = $('#select_customer').val();
            var templateId = $('#select_template').val();
            if (templateId == null){
                return;
            }
            window.location="{{ url('/datas') }}" + "/" + customerId + "/create/" + templateId;
        }

        function del(id) {
            var templateId = $('#select_template').val();
            var userId = $('#select_customer').val();

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
                        url: "{{ url('/datas') }}" + "/" + id + "/destroy/" + templateId,
                        type: 'post',
                        dataType: 'text',
                        success: function(data) {
                            getDetails(userId, templateId);
                        }
                    });
                }
            });
        }

        function saveDefault() {
            var templateId = $('#select_template').val();
            if (templateId == null){
                return;
            }

            $.ajax({
                url: "{{ url('/saveDefault') }}",
                type: 'post',
                dataType: 'text',
                data: {
                    'templateId': templateId,
                },
                success: function(data) {
                    if (data == "Success") {
                        swal({
                            title: "{{ trans('templates.success') }}",
                            text: "{{ trans('templates.the table is setted to default') }}",
                            type: "success",
                            confirmButtonClass: "btn btn-confirm mt-2",
                        });
                    }
                }
            });
        }
    </script>
@endsection