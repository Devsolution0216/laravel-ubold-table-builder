<script src="{{ url('assets/js/vendor.min.js') }}"></script>

<script src="{{ url('assets/libs/jquery-nice-select/jquery.nice-select.min.js') }}"></script>
<script src="{{ url('assets/libs/switchery/switchery.min.js') }}"></script>
<script src="{{ url('assets/libs/multiselect/jquery.multi-select.js') }}"></script>
<script src="{{ url('assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ url('assets/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
<script src="{{ url('assets/libs/autocomplete/jquery.autocomplete.min.js') }}"></script>
<script src="{{ url('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ url('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ url('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

<!-- <script src="{{ url('assets/js/pages/form-advanced.init.js') }}"></script> -->
<script src="{{ url('assets/js/app.min.js') }}"></script>

<script src="/assets/libs/dropzone/dropzone.min.js"></script>
<script src="/assets/libs/dropify/dropify.min.js"></script>

<!-- Init js-->
<script src="/assets/js/pages/form-fileuploads.init.js"></script>

<script src="{{ url('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ url('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ url('assets/libs/clockpicker/bootstrap-clockpicker.min.js') }}"></script>

<!-- <script src="{{ url('assets/js/pages/form-pickers.init.js') }}"></script> -->

<script src="{{ url('assets/libs/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ url('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/libs/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ url('assets/libs/datatables/buttons.flash.min.js') }}"></script>
<script src="{{ url('assets/libs/datatables/buttons.print.min.js') }}"></script>
<script src="{{ url('assets/libs/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ url('assets/libs/datatables/dataTables.select.min.js') }}"></script>
<script src="/assets/libs/rwd-table/rwd-table.min.js"></script>
<script src="{{ url('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('assets/libs/pdfmake/vfs_fonts.js') }}"></script>
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="/assets/libs/jquery-toast/jquery.toast.min.js"></script>
<script src="/assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
<script src="/assets/libs/autonumeric/autoNumeric-min.js"></script>
<script src="/assets/js/pages/form-masks.init.js"></script>


<script src="https://cdn.jsdelivr.net/npm/es6-promise@4.2.5/dist/es6-promise.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2pdf.js@0.9.0/dist/html2pdf.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //dataTable init
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

    // many date and time in date table...
    $(".flatpickr-input-date").flatpickr();
    $(".flatpickr-input-time").flatpickr({ enableTime: !0, noCalendar: !0, dateFormat: "H:i" });
</script>

@yield('javascript')