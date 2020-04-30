<meta charset="utf-8">
<title>
    {{ trans('global.global_title') }}
</title>

<meta http-equiv="X-UA-Compatible"
      content="IE=edge">
<meta content="width=device-width, initial-scale=1.0"
      name="viewport"/>
<meta http-equiv="Content-type"
      content="text/html; charset=utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<link rel="shortcut icon" href="/assets/images/favicon.ico">

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" rel="stylesheet" />
<!-- Plugins css -->
<link href="{{ url('assets/libs/jquery-nice-select/nice-select.css" rel="stylesheet') }}" type="text/css" />
<link href="{{ url('assets/libs/switchery/switchery.min.css" rel="stylesheet') }}" type="text/css" />
<link href="{{ url('assets/libs/multiselect/multi-select.css" rel="stylesheet') }}" type="text/css" />
<link href="{{ url('assets/libs/select2/select2.min.css" rel="stylesheet') }}" type="text/css" />
<link href="{{ url('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.css') }}" rel="stylesheet" type="text/css" />

<!-- App css -->
<link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

<link href="/assets/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />

<link href="{{ url('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/libs/clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ url('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="/assets/libs/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />

<style>
    label.error{
        color:#d85c41
    }
    input[type=text].error {
        border-color:#d85c41
    }
</style>

