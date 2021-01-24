<!-- jQuery -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/'); ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- select2 -->
<script src="<?php echo base_url('assets/'); ?>plugins/select2/js/select2.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/'); ?>js/demo.js"></script>
<!-- Toastr -->
 <script src="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>
 <script>
 		  var table;
    $(document).ready(function() {
        //datatables
        table = $('#data_notifikasi').DataTable({ 
 			"responsive": true,
      		"lengthChange": false, 
      		"autoWidth": false,
      		dom: 'Bfrtip',
     		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('notif/getpembaruan')?>",
                "type": "POST"
            },
             
            "columnDefs": [
            {
                "targets":  2, 
                "mRender" : function(data, type, full){ return full[2]; }
            },
            {
                "targets":  3,
                "mRender" : function(data, type, full){ return full[3]; }
            },
            { 
                "targets": [ -1 ], 
                "orderable": false,
                "data": null,
                "mRender" : function(data, type, full){
                	return '<button class="btn btn-sm btn-info text-white" onclick=view("'+full[4]+'"); title="View">Lihat</button>';
                }
            }]
 
        }).buttons().container().appendTo('#data_notifikasi_wrapper .col-md-6:eq(0)');
    });

    function view(id){
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('notif/lihat')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    var html = '';
                    var html2 = '';
                    var i; 
              for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<tr><th>Tentang</th><th>:</th><td class="dont-break-word">'+data[i].tentang_notif+'</td></tr>'+
                                '<tr><th>TANGGAL</th><th>:</th><td>'+data[i].tanggal+'</td></tr>'+ 
                                '<tr><th>ISI</th><th>:</th><td class="dont-break-word">'+data[i].isi_notifikasi+'</td></tr>'+
                                '</tr>'
                          ;
                    $('#data_notifikasi').DataTable().ajax.reload();
                    }
                    $('#shownotif').html(html);
                    $('#viewnotifpopup').modal('show');
                }
            });
            return false;
    }
 </script>