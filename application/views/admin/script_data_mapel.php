<!-- jQuery -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
        table = $('#data_mapel').DataTable({ 
 			"responsive": true,
      		"lengthChange": false, 
      		"autoWidth": false,
      		dom: 'Bfrtip',
     		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/getmapel')?>",
                "type": "POST"
            },
             
            "columnDefs": [
            { 
                "targets": [ -1 ], 
                "orderable": false,
                "data": null,
                "mRender" : function(data, type, full){
                	return '<tr><td><button class="btn btn-sm btn-info text-white" onclick=editmapel("'+full[3]+'"); title="Edit Data"><i class="fas fa-edit"></i></button></td></tr>';
                }
            }]
 
        }).buttons().container().appendTo('#data_mapel_wrapper .col-md-6:eq(0)');
    });

    	$(document).ready(function () {
          $("#submitbuatmapel").click(function (event) {
              event.preventDefault();
              var form = $('#buatmapel')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url('admin/inputmapel'); ?>",
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
                        $('#loadings').modal('hide');
                      }else{
                        $('#loadings').modal('hide');
                        $('#namamapel').val('');
                        $('#data_mapel').DataTable().ajax.reload();
                      	$('#modal-buat-mapel').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }
                      
                  })
                  }
              });

          });
       });


    function editmapel(id){
     $.ajax({
        url: "<?php echo base_url('admin/mapel_getbyid') ?>",
        method: "POST",
        data: {
            idm: id
        },
        dataType:"json",
        success: function(data) {
        for(i=0; i<data.length; i++){
        $('#id_mapel').val(data[i].id_mapel);
        $('#editnamamapel').val(data[i].nama_mapel);
        $('#editstatusmapel').val(data[i].status);
        }
        $('#modal-edit-mapel').modal('show');
    	}
		})
    }

      $(document).ready(function () {
          $("#editsubmitbuatmapel").click(function (event) {
              event.preventDefault();
              var form = $('#editmapel')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url('admin/submiteditmapel'); ?>",
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
                        $('#loadings').modal('hide');
                      }else{
                        $('#loadings').modal('hide');
                        $('#data_mapel').DataTable().ajax.reload();
                      	$('#modal-edit-mapel').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }
                      
                  })
                  }
              });

          });
       });

 	 var table;
    $(document).ready(function() {
        //datatables
        table = $('#data_pengelompokan').DataTable({ 
 			"responsive": true,
      		"lengthChange": false, 
      		"autoWidth": false,
      		dom: 'Bfrtip',
     		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/getpaket')?>",
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
                	return '<tr><td><button class="btn btn-sm btn-info text-white" onclick=detailpaketmapel("'+full[5]+'"); title="Detail MAPEL"><i class="fas fa-search-plus"></i></button></td></tr>';
                }
            }]
 
        }).buttons().container().appendTo('#data_pengelompokan_wrapper .col-md-6:eq(0)');

    });

    function detailpaketmapel(idpak){
        $.ajax({
        url: "<?php echo base_url('admin/detailpaketmapel') ?>",
        method: "POST",
        data: {
            idp: idpak
        },
        dataType:"json",
        success: function(data) {
        var html = "";
        var no = 1 ;
        for(i=0; i<data.length; i++){
        html += '<tr>'+
        '<td>'+no+++'</td>'+
        '<td>'+data[i].nama_mapel+'</td>'+
        '<td>'+data[i].status+'</td>'+
        '<td>'+'<button class="btn btn-sm btn-danger text-white" onclick=hapusmapelonpaket("'+data[i].id_mapel+'","'+idpak+'"); title="Hapus Mapel"><i class="fa fa-trash"></i></button>'+'</td>'+
        '</tr>';
        }
        $('#mapeltempel').html(html);
        $('#idpaketurus').val(idpak);
        $('#modal-view-mapelonpaket').modal('show');
    	}
		})
    }

          $(document).ready(function () {
          $("#submitinputmapelpaket").click(function (event) {
              event.preventDefault();
              var form = $('#inputmapelpaket')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url('admin/submitaddmapelonpaket'); ?>",
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
                        $('#loadings').modal('hide');
                      }else{
                        $('#loadings').modal('hide');
   						var a = $('#idpaketurus').val();
   						detailpaketmapel(a);
                      	$('#inputmapelonpaket').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }
                      
                  })
                  }
              });

          });
       });

       function hapusmapelonpaket(idm,idp){
       	$data = confirm('Hapus Mapel dari Paket Ini?');
		if ($data == true){
	      $('#loadings').modal('show');
    		$.ajax({
                    url: "<?php echo base_url('admin/hapusmapelonpaket') ?>",
                    method: "POST",
                    data: {
                        idmapel: idm,
                        idpaket: idp
                    },
                    dataType:"json",
                    success: function(data) {
                     $.each(data,function(pesan){
		        	 if (data.pesan.match(/alert-danger.*/)){
                        $('#loadings').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }else{
                        $('#loadings').modal('hide');
                        detailpaketmapel(idp);
                        $('#pops').html(data.pesan);
                        $('#popupvalidate').modal('show');
                        $('#loadings').modal('hide');
                      }
		        	   })
                }

    		});
    	}else{

    	}
       }
       $('.modal').css('overflow-y', 'auto');
 </script>