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
        table = $('#data_referal').DataTable({ 
 			"responsive": true,
      		"lengthChange": false, 
      		"autoWidth": false,
      		dom: 'Bfrtip',
     		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/getreferal')?>",
                "type": "POST"
            },
             
            "columnDefs": [
            { 
                "targets": [ -1 ], 
                "orderable": false,
                "data": null,
                "mRender" : function(data, type, full){
                	return '<tr><td><button class="btn btn-sm btn-info text-white" onclick=editreferal("'+full[1]+'"); title="Edit Data"><i class="fas fa-edit"></i></button></td><td><button class="btn btn-sm btn-info text-white" onclick=detailreferal("'+full[1]+'"); title="Detail Referal"><i class="fas fa-search-plus"></i></button></td><td><button class="btn btn-sm btn-danger text-white" onclick=hapusreferal("'+full[1]+'"); title="Hapus Referal"><i class="fa fa-trash"></i></button></td></tr>';
                }
            }]
 
        }).buttons().container().appendTo('#data_referal_wrapper .col-md-6:eq(0)');
    });

    function hapusreferal(kdr)
    {
    	$data = confirm('Hapus Kode Ini?');
        if ($data == true){
          $('#loadings').modal('show');
    	$.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>admin/hapusreferal",
                  data: {kod : kdr},
                  dataType:"json",
                  success: function (data) {
 					$.each(data,function(pesan){
                      if (data.pesan.match(/alert-danger.*/)){
                        $('#loadings').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }else{
                        $('#loadings').modal('hide');
                      	$('#data_referal').DataTable().ajax.reload();
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }  
                  })
                  }
              });
    	}else{

    	}
    }

    function detailreferal(kdr)
    {	
    	$.ajax({
            url: "<?php echo base_url('admin/getreferalbyid') ?>/",
            method: "POST",
            data: {
                kod: kdr
            },
            dataType:"json",
            success: function(data) {
            	for(i=0; i<data.length; i++){ 
            	
            	$('#kodereferal').val(kdr);
            	$('#jmlreferal').val(data[i].jumlah);
            	$('#potonganreferal').val(data[i].potongan);
		    	$('#modal-view-referal').modal('show');

            	}
            }
        })
    }

    function editreferal(kdr)
    {	
    	$.ajax({
                    url: "<?php echo base_url('admin/getreferalbyid') ?>/",
                    method: "POST",
                    data: {
                        kod: kdr
                    },
                    dataType:"json",
                    success: function(data) {
                    	for(i=0; i<data.length; i++){ 
                    	
                    	$('#kodereferal1').val(kdr);
                    	$('#jmlreferal1').val(data[i].jumlah);
                    	$('#potonganreferal1').val(data[i].potongan);
				    	$('#modal-edit-referal').modal('show');

                    	}
                    }
                })
    }

     $(document).ready(function () {
          $("#submiteditreferal").click(function (event) {
              event.preventDefault();
              var form = $('#editreferal')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url(); ?>admin/editdatareferal",
                  data: data,
                  processData: false,
                  contentType: false,
                  cache: false,
                  timeout: 600000,
                  dataType:"json",
                  success: function (data) {
 					$.each(data,function(pesan){
                      if (data.pesan.match(/alert-danger.*/)){
                      	$('#loadings').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('show');
                      }else{
                      	$('#loadings').modal('hide');
                      	$('#data_referal').DataTable().ajax.reload();
                      	$('#modal-edit-referal').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }  
                  })
                  }
              });

          });
       

   
    
     	$("#addreferal").click(function (event) {
            $('#modal-buat-referal').modal('show');
      	})

             $("#submitbuatreferal").click(function (event) {
              event.preventDefault();
              var form = $('#buatreferal')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url(); ?>admin/inputreferal",
                  data: data,
                  processData: false,
                  contentType: false,
                  cache: false,
                  timeout: 600000,
                  dataType:"json",
                  success: function (data) {
          $.each(data,function(pesan,detrox){
                      if (data.pesan.match(/alert-danger.*/)){
                      	$('#loadings').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }else{
                        $('#loadings').modal('hide');
                        document.getElementById('buatreferal').reset();
                        $('#data_referal').DataTable().ajax.reload();
                        $('#modal-buat-referal').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }  
                  })
                  }
              });

          });

         

	$('.modal').css('overflow-y', 'auto');

 	})
</script>