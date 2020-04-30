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
                        <li class="breadcrumb-item active">@lang('templates.view')</li>
                    </ol>
                </div>
                <h4 class="page-title">@lang('templates.table')</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="p-4">
            <a href="{{ route('admin.templates.index') }}"><i class="mdi mdi-arrow-left-drop-circle"></i> @lang('templates.back to tables') </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="form-group row mb-3">
                        {!! Form::label('name', trans('templates.name'), ['class' => 'col-md-3 col-form-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('name', $template->name, ['class' => 'form-control', 'readonly'=>'true']) !!}
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        {!! Form::label('col_cnt', trans('templates.col count'), ['class' => 'col-md-3 col-form-label']) !!}
                        <div class="col-md-9">
                            {!! Form::number('col_cnt', $template->col_cnt, ['id'=>'col_cnt', 'class' => 'form-control', 'readonly'=>'true', 'step'=>1, 'min'=>0, 'max'=>20, 'editable'=>20]) !!}
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        {!! Form::label('fix_row_cnt', 'Fixed Row Count', ['class' => 'col-md-3 col-form-label']) !!}
                        <div class="col-md-9">
                            {!! Form::number('fix_row_cnt', $template->fix_row_cnt, ['id'=>'fix_row_cnt', 'class' => 'form-control', 'readonly'=>'true', 'step'=>1, 'min'=>0, 'max'=>20, 'editable'=>20]) !!}
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        {!! Form::label('customer_ids', trans('templates.customers'), ['class' => 'col-md-3 col-form-label']) !!}
                        <div class="col-md-9">
                            @php
                                $customers = '';
                                $customers_ary = App\Models\Customer::find(explode(',', $template->customer_ids))->pluck('name');
                                foreach ($customers_ary as $one)
                                {
                                    $customers .= $customers==''?'<span class="badge" style="background-color:#6658dd;">'.$one.'</span>':' <span class="badge" style="background-color:#6658dd;">'.$one.'</span>';
                                }
                            @endphp
                            <label class="col-md-9 " style="font-size: 22px">@php echo $customers @endphp</label>
{{--                            {!! Form::text('name', $customers, ['class' => 'form-control', 'readonly'=>'true']) !!}--}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="card bg-soft-dark">
                                <div class="card-body">
                                    <h4 class="card-title">@lang('templates.detail info')</h4>
                                    <div class="element">
                                        @php
                                            $ind = 0;
                                        @endphp
                                        @foreach($details as $detail)
                                            <div class="row colnumber-{{ ++$ind }}">
                                                <div class="form-group col-md-auto ml-3 mb-0">
                                                        <h5 class="card-title col-form-label">@lang("templates.col"){{ $ind }} :</h5>
                                                    </div>
                                                <div class="form-group col-md-5">
                                                    <div class="row">
                                                        <label for="col_name{{ $ind }}" class="col-md-auto col-form-label">@lang("templates.name")</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control col_name" readonly="" value="{{ $detail->name }}" name="col_name{{ $ind }}" id="col_name{{ $ind }}" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <div class="row">
                                                        <label for="col_type{{ $ind }}" class="col-md-auto col-form-label">@lang("templates.type")</label>
                                                        <div class="col-md-8">
                                                            <select name="col_type{{ $ind }}" id="col_type{{ $ind }}" disabled="" class="form-control" >
                                                                <option {{ $detail->type=="Text"?'selected':'' }}>Text</option>
                                                                <option {{ $detail->type=="Integer"?'selected':'' }}>Integer</option>
                                                                <option {{ $detail->type=="Date"?'selected':'' }}>Date</option>
                                                                <option {{ $detail->type=="DateTime"?'selected':'' }}>Time</option>
                                                                <option {{ $detail->type=="CheckBox"?'selected':'' }}>CheckBox</option>
                                                                <option {{ $detail->type=="SelectDown"?'selected':'' }}>SelectDown</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($detail->value != "")
                                                    <div class="row" style="display:flex; width:100%; margin-left:0px; margin-right:0px;">
                                                        <label for="col_value{{ $ind }}"  class="col-md-2 col-form-label text-right">SelectDown Value</label>
                                                        @php
                                                            $strValue = $detail->value;
                                                            $strValue = str_replace(", ", ',', $strValue);
                                                            $arrValue = explode(",", $strValue);
                                                        @endphp
                                                        <label class="col-md-9 " style="font-size: 20px">
                                                        @foreach($arrValue as $value)
                                                            <span class="badge" style="background-color:#6658dd;">
                                                                {{ $value }}
                                                            </span>
                                                        @endforeach
                                                        </label>
                                                    </div>
                                                @endif
                                                @if($detail->rows_value != "")
                                                    @php
                                                        $strValue = $detail->rows_value;
                                                        $strValue = str_replace(", ", ',', $strValue);
                                                        $arrValue = explode(",", $strValue);
                                                    @endphp
                                                <div style="width: 100%">
                                                    @for($ind_row = 0; $ind_row < intval($template->fix_row_cnt); $ind_row++)
                                                        <div class="row row_col_css row{{ $ind_row+1 }}_col{{ $ind }}_value" style=" margin-left:0px; margin-right:0px;">
                                                            <label for="row{{ $ind_row+1 }}_col{{ $ind_row+1 }}_value" class="col-md-2 col-form-label text-right">Row{{ $ind_row+1 }} Value</label>
                                                            <div class="form-group col-md-8">
                                                                @php
                                                                    $key = 'row'.($ind_row+1).'_col'.$ind.'_value';
                                                                @endphp
                                                                <input type="text" class="form-control" readonly required name="row{{ $ind_row }}_col{{ $ind }}_value" id="row{{ $ind_row+1 }}_col{{ $ind }}_value" value="{{ $arrValue[$ind_row] }}" class="form-control" />
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> <!-- end card-box-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')

    <script>
        $("document").ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
