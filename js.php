<!-- jQuery -->
<!-- <script src="./node_modules/jquery/dist/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<!-- <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- AdminLTE App -->
<!-- <script src="./node_modules/admin-lte/dist/js/adminlte.min.js"></script> -->

<!-- jQuery UI 1.11.4 -->
<!-- <script src="./node_modules/jquery-ui-dist/jquery-ui.min.js"></script> -->

<!-- Bootstrap4 Duallistbox -->
<!-- <script src="./node_modules/bootstrap4-duallistbox/dist/jquery.bootstrap-duallistbox.min.js"></script> -->
<!-- InputMask -->
<!-- <script src="./node_modules/moment/min/moment.min.js"></script> -->
<!-- <script src="./node_modules/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script> -->
<!-- bootstrap color picker -->
<!-- <script src="./node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script> -->
<!-- Bootstrap Switch -->
<!-- <script src="./node_modules/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script> -->
<!-- overlayScrollbars -->
<!-- <script src="./node_modules/overlayscrollbars/js/jquery.overlayScrollbars.min.js"></script> -->

<!-- DataTables -->
<!-- <script src="./node_modules/datatables.net/js/jquery.dataTables.js"></script>
<script src="./node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script> -->

<!-- AdminLTE App -->
<!-- <script src="./node_modules/admin-lte/dist/js/adminlte.js"></script> -->

<!-- AdminLTE for demo purposes -->
<!-- <script src="./node_modules/admin-lte/dist/js/demo.js"></script> -->



<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>

<!-- Sweetalert2 -->
<script src="./node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

<!-- DataTables -->
<script src="./plugins/datatables/jquery.dataTables.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- InputMask -->
<script src="./plugins/moment/moment.min.js"></script>
<script src="./plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<!-- chart -->
<script src="./plugins/chart.js/Chart.min.js"></script>
<!-- <script src="dist/js/demo.js"></script> -->
<!-- <script src="dist/js/pages/dashboard3.js"></script> -->

<script>
    $(function() {

        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>

<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });

        $('#tanggal_order').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

        $('#tanggal_garansi').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    });
</script>


<script type="text/javascript">
$(document).ready(function(){
    $('.btn-danger').click(function(e) {
        var a = $(this).attr('href');
        console.log(a);
        e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You wont be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                // console.log(result);
                
                if (result.value) {
                    // Swal.fire({
                    //     title: "Deleted!",
                    //     text: "Has been deleted.",
                    //     icon: "success",
                    //     showConfirmButton: false,
                    //     timer: 1000,
                    //     onAfterClose: () => {
                            window.location.href = a;
                    //     }
                    // })
                    
                } 
            });
            
    });

    $('#product').on('change',function() {
        var p_harga = $('#product').find(':selected').attr('harga');
        var p_income = $('#product').find(':selected').attr('income');
        // console.log(p_harga);
        $('#harga').val(p_harga);
        $('#income').val(p_income);
        
    })

    $('#status_income').on('change',function() {
        if ($('#traffic_source').val()=="Tokopedia" && $('#status_income').val()=="N" && $('#keterangan').val()=="" ) {
            $('#keterangan').val("income belum masuk dari tokpednya, garansi hangus apabila tidak beri rating 5 pada tokped.");
        }
    })

});
</script>

