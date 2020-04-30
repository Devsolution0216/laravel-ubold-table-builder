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
                        <li class="breadcrumb-item active">@lang('templates.edit data')</li>
                    </ol>
                </div>
                <h4 class="page-title">@lang('templates.edit data')</h4>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="pt-4 pl-4">
            <a href="{{ route('datas.index') }}"><i class="mdi mdi-arrow-left-drop-circle"></i> @lang('templates.back to datas') </a>
        </div>
        <div class="card-body">
            <form action="{{ url('/datas/'. $data->id . '/update/' . $customerId . '/' . $templateId) }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-10">
                        @foreach ($details as $detail)
                            @php $name = $detail->name @endphp
                            <div class="form-group row mb-3">
                                @if ($detail->type == 'Text')
                                    <label class="col-md-3 col-form-label text-right" for="{{ $detail->name }}">{{ $detail->name }}</label>
                                    <div class="col-md-9">
                                        <input type="text" maxlength="256" class="form-control" name="{{ $detail->name }}" value="{{ $data->$name }}" required>
                                    </div>
                                @elseif ($detail->type == 'Integer')
                                    <label class="col-md-3 col-form-label text-right" for="{{ $detail->name }}">{{ $detail->name }}</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="{{ $detail->name }}" value="{{ $data->$name }}" min=0 max=99999999999999999999 step=1 retuired>
                                    </div>
                                @elseif ($detail->type == 'Date')
                                    <label class="col-md-3 col-form-label text-right" for="{{ $detail->name }}">{{ $detail->name }}</label>
                                    <div class="col-md-9">
                                        <input type="text" name="{{ $detail->name }}" class="form-control flatpickr-input-date" value="{{ $data->$name }}" readonly="readonly" required>
                                    </div>
                                @elseif ($detail->type == 'Time')
                                    <label class="col-md-3 col-form-label text-right" for="{{ $detail->name }}">{{ $detail->name }}</label>
                                    <div class="col-md-9">
                                        <input type="text" name="{{ $detail->name }}" class="form-control flatpickr-input-time" value="{{ $data->$name }}" readonly="readonly" required>
                                    </div>
                                @elseif ($detail->type == 'CheckBox')
                                    <label class="col-md-3 pt-2 col-form-label text-right" for="{{ $detail->id }}">{{ $detail->name }}</label>
                                    <div class="col-md-9">
                                        <div class="custom-control checkbox checkbox-warning">
                                            <input name="{{ $detail->name }}" type="checkbox" class="custom-control-input" id="{{ $detail->id }}" {{ $data->$name == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="{{ $detail->id }}"></label>
                                        </div>
                                    </div>
                                @elseif ($detail->type == 'SelectDown')
                                    <label class="col-md-3 col-form-label text-right" for="{{ $detail->name }}">{{ $detail->name }}</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="{{ $detail->name }}">
                                            @php $arrayValues = explode(',', $detail->value) @endphp
                                            @foreach ($arrayValues as $arrayValue)
                                                <option value="{{ $arrayValue }}" {{ $data->$name == $arrayValue ? 'selected' : '' }}>{{ $arrayValue }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <div class="form-group mb-0 justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-block btn-primary waves-effect waves-light">@lang('templates.save data')</button>
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

</script>
@endsection
