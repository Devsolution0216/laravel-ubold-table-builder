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
                        <li class="breadcrumb-item active">@lang('templates.add new table')</li>
                    </ol>
                </div>
                <h4 class="page-title">@lang('templates.add new table')</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="p-4">
            <a href="{{ route('admin.templates.index') }}"><i class="mdi mdi-arrow-left-drop-circle"></i> @lang('templates.back to tables') </a>
        </div>
        <div class="card-body">
            <form id="form" action="{{ route('admin.templates.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="form-group row mb-3">
                            {!! Form::label('name', trans('templates.name'), ['class' => 'col-md-3 col-form-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'true']) !!}
                                @if ($errors->has('name'))
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            {!! Form::label('col_cnt', trans('templates.col count'), ['class' => 'col-md-3 col-form-label']) !!}
                            <div class="col-md-9">
                                {!! Form::number('col_cnt', old('col_cnt') == null ? 0 : old('col_cnt'), ['id'=>'col_cnt', 'class' => 'form-control', 'step'=>1, 'required'=>'true', 'min'=>1, 'max'=>30, 'editable'=>20]) !!}
                                @if ($errors->has('col_cnt'))
                                    <strong class="text-danger">{{ $errors->first('col_cnt') }}</strong>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="form-group row mb-3">
                            {!! Form::label('fix_row_cnt', trans('templates.fix row count'), ['class' => 'col-md-3 col-form-label']) !!}
                            <div class="col-md-9">
                                {!! Form::number('fix_row_cnt', old('fix_row_cnt') == null ? 0 : old('fix_row_cnt'), ['id'=>'fix_row_cnt', 'class' => 'form-control', 'step'=>1, 'required'=>'true', 'min'=>0, 'max'=>30, 'editable'=>20]) !!}
                                @if ($errors->has('fix_row_cnt'))
                                    <strong class="text-danger">{{ $errors->first('fix_row_cnt') }}</strong>
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group row mb-3">
                            {!! Form::label('customer_ids', trans('templates.customers'), ['class' => 'col-md-3 col-form-label']) !!}
                            <div class="col-md-9">
                                {!! Form::select('customer_ids[]', $customers, old('customer_ids'), ['id' => 'customer_ids', 'multiple'=>'multiple', 'class' => 'form-control js-example-basic-multiple']) !!}
                                @if($errors->has('customer_ids'))
                                    <strong class="text-danger">{{ $errors->first('customer_ids') }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="card bg-soft-dark">
                                    <div class="card-body">
                                        <h4 class="card-title">@lang('templates.detail info')</h4>
                                        <div class="element">
                                            @for($ind = 1; $ind < intval(old('col_cnt')) + 1; $ind++)
                                                <div class="row colnumber" id="colnumber{{ $ind }}">
                                                    <div class="form-group col-md-auto ml-3 mb-0">
                                                        <h5 class="card-title col-form-label">@lang("templates.col"){{ $ind }} :</h5>
                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <div class="row">
                                                            <label for="col_name{{ $ind }}" class="col-md-auto col-form-label">@lang("templates.name")</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control col_name" value="{{ old('col_name'.$ind) }}" name="col_name{{ $ind }}" id="col_name{{ $ind }}" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <div class="row">
                                                            <label for="col_type{{ $ind }}" class="col-md-auto col-form-label">@lang("templates.type")</label>
                                                            <div class="col-md-8">
                                                                <select name="col_type{{ $ind }}" id="col_type{{ $ind }}" class="form-control" onchange="changeType({{ $ind }})" required >
                                                                    <option {{ old('col_type'.$ind)=="Text"?'selected':'' }}>Text</option>
                                                                    <option {{ old('col_type'.$ind)=="Integer"?'selected':'' }}>Integer</option>
                                                                    <option {{ old('col_type'.$ind)=="Date"?'selected':'' }}>Date</option>
                                                                    <option {{ old('col_type'.$ind)=="DateTime"?'selected':'' }}>Time</option>
                                                                    <option {{ old('col_type'.$ind)=="CheckBox"?'selected':'' }}>CheckBox</option>
                                                                    <option {{ old('col_type'.$ind)=="SelectDown"?'selected':'' }}>SelectDown</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(old('col_type'.$ind)=="SelectDown")
                                                    <div class="row col_value{{ $ind }}" style="display:flex; width:100%; margin-left:0px; margin-right:0px;">
                                                        <label for="col_value{{ $ind }}"  class="col-md-2 col-form-label text-right">SelectDown Value</label>
                                                        <div class="form-group col-md-8">
                                                            <input type="text" class="form-control col_name" value="{{ old('col_value'.$ind) }}" name="col_value{{ $ind }}" id="col_value{{ $ind }}" placeholder="ex. Male,Female" class="form-control" required />
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if(intval(old('fix_row_cnt')) > 0)
                                                    <div style="width: 100%">
                                                    @for($ind_row = 1; $ind_row < intval(old('fix_row_cnt')) + 1; $ind_row++)
                                                        <div class="row row_col_css row{{ $ind_row }}_col{{ $ind }}_value" style=" margin-left:0px; margin-right:0px;">
                                                            <label for="row{{ $ind_row }}_col{{ $ind }}_value" class="col-md-2 col-form-label text-right">Row{{ $ind_row }} Value</label>
                                                            <div class="form-group col-md-8">
                                                                @php
                                                                    $key = 'row'.$ind_row.'_col'.$ind.'_value';
                                                                @endphp
                                                                <input type="text" class="form-control" required name="row{{ $ind_row }}_col{{ $ind }}_value" id="row{{ $ind_row }}_col{{ $ind }}_value" value="{{ old($key) }}" class="form-control" />
                                                            </div>
                                                        </div>
                                                    @endfor
                                                    </div>
                                                    @endif
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div> <!-- end card-box-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 text-right">
                                {!! Form::submit(trans('templates.save table'), ['class' => 'btn btn-primary waves-effect']) !!}
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
        var validator;
        $("document").ready(function(){
            $('.js-example-basic-multiple').select2();

            $('#col_cnt').change(function(e){
                makeElement();
            });
            $('#fix_row_cnt').change(function(e){
                makeElement();
            });
            $('#col_cnt').keyup(function(e){
                if (e.keyCode == 13)
                {
                    makeElement();
                }
            });
            $('#fix_row_cnt').keyup(function(e){
                if (e.keyCode == 13)
                {
                    makeElement();
                }
            });
        });
        function makeElement() {
            var cnt = $('#col_cnt').val();
            var fix_row_cnt = $('#fix_row_cnt').val();
            var textHTML='';
            var oldcnt = $('.colnumber').length;
            if (cnt > oldcnt) {
                for (var i = oldcnt + 1; i < parseInt(cnt) + 1; i++)
                {
                    textHTML += '<div class="row colnumber" id="colnumber'+i+'">' +
                        '                                            <div class="form-group col-md-auto ml-3 mb-0">\n' +
                        '                                                <h5 class="card-title col-form-label">@lang("templates.col")'+i+' :</h5>\n' +
                        '                                            </div>\n' +
                        '                                            <div class="form-group col-md-5">\n' +
                        '                                                <div class="row">\n' +
                        '                                                    <label for="col_name'+i+'" class="col-md-auto col-form-label">@lang("templates.name")</label>\n' +
                        '                                                    <div class="col-md-8">\n' +
                        '                                                        <input type="text" class="form-control col_name" name="col_name'+i+'" id="col_name'+i+'" class="form-control" required />\n' +
                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '                                            </div>\n' +
                        '                                            <div class="form-group col-md-5">\n' +
                        '                                                <div class="row">\n' +
                        '                                                    <label for="col_type'+i+'" class="col-md-auto col-form-label">@lang("templates.type")</label>\n' +
                        '                                                    <div class="col-md-8">\n' +
                        '                                                        <select name="col_type'+i+'" id="col_type'+i+'" onchange="changeType('+i+');" class="form-control col-type" required >\n' +
                        '                                                            <option>Text</option>\n' +
                        '                                                            <option>Integer</option>\n' +
                        '                                                            <option>Date</option>\n' +
                        '                                                            <option>Time</option>\n' +
                        '                                                            <option>CheckBox</option>\n' +
                        '                                                            <option>SelectDown</option>\n' +
                        '                                                        </select>\n' +
                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '                                            </div>\n' +
                        '                                                <div class="row col_value'+i+'" style="display:none; width:100%; margin-left:0px; margin-right:0px;">\n' +
                        '                                                    <label for="col_value'+i+'" class="col-md-2 col-form-label text-right">SelectDown Value</label>\n' +
                        '                                                    <div class="form-group col-md-8">\n' +
                        '                                                        <input type="text" class="form-control col_name" name="col_value'+i+'" id="col_value'+i+'" placeholder="ex. Male,Female" class="form-control" />\n' +
                        '                                                    </div>\n' +
                        '                                                </div>\n';

                    textHTML += '</div>';
                }
                $('.element').append(textHTML);
            }else if (cnt < oldcnt && cnt > 0){
                for (var i = oldcnt; i > cnt; i--)
                {
                    $('#colnumber' + i).remove();
                }
            }
            for (var i = 1; i < parseInt(cnt) + 1; i++)
            {
                var textHTML = '<div style="width: 100%">';
                var old_fix_cnt = $( "#colnumber"+ i ).find( ".row_col_css" ).length;
                if (fix_row_cnt > old_fix_cnt) {
                    for (var j = old_fix_cnt+1; j < parseInt(fix_row_cnt) + 1; j++) {
                        textHTML += '<div class="row row_col_css row' + j + '_col' + i + '_value" style=" margin-left:0px; margin-right:0px;">' +
                            '<label for="row' + j + '_col' + i + '_value" class="col-md-2 col-form-label text-right">Row' + j + ' Value</label>' +
                            '<div class="form-group col-md-8">' +
                            '<input type="text" class="form-control" required name="row' + j + '_col' + i + '_value" id="row' + j + '_col' + i + '_value" class="form-control" />' +
                            '</div>' +
                            '</div>';
                    }
                    textHTML += '</div>'
                    $('#colnumber'+i).append(textHTML);
                }else if (old_fix_cnt > fix_row_cnt && fix_row_cnt >= 0)
                {
                    for (var j = old_fix_cnt; j > fix_row_cnt; j--)
                    {
                        $('.row' + j + '_col' + i + '_value').remove();
                        // console.log('.row' + j + '_col' + i + '_value');
                    }
                }
            }
        }
        function changeType(ind) {
            var text = $('#col_type'+ind+' option:selected').text();
            if (text == "SelectDown"){
                $('.col_value'+ind).css('display', 'flex');
                $('#col_value'+ind).attr('required', 'true');
            }else {
                $('.col_value'+ind).css('display', 'none');
                $('#col_value'+ind).removeAttr('required');
            }
            var fix_cnt = $( "#colnumber"+ ind ).find( ".row_col_css" ).length;
            for (var i = 1; i < parseInt(fix_cnt) + 1; i++)
            {
                if (text == "Integer"){
                    $('#row' + i + '_col' + ind + '_value').attr('type', 'number');
                }else if (text == "Date"){
                    $('#row' + i + '_col' + ind + '_value').attr('type', 'date');
                }else if (text == "Time"){
                    $('#row' + i + '_col' + ind + '_value').attr('type', 'time');
                }else{
                    $('#row' + i + '_col' + ind + '_value').attr('type', 'text');
                }
                if (text == "CheckBox"){
                    $('#row' + i + '_col' + ind + '_value').attr('placeholder', 'ex. if true is 1 else 0');
                    $('#row' + i + '_col' + ind + '_value').attr('type', 'number');
                    $('#row' + i + '_col' + ind + '_value').attr('min', '0');
                    $('#row' + i + '_col' + ind + '_value').attr('max', '1');
                    $('#row' + i + '_col' + ind + '_value').attr('step', '1');
                }else{
                    $('#row' + i + '_col' + ind + '_value').attr('placeholder', '');
                    $('#row' + i + '_col' + ind + '_value').removeAttr('min');
                    $('#row' + i + '_col' + ind + '_value').removeAttr('max');
                    $('#row' + i + '_col' + ind + '_value').removeAttr('step');
                }
            }
        }
    </script>
@endsection
