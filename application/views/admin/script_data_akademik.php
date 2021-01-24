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
        table = $('#data_nilai').DataTable({ 
 			"responsive": true,
      		"lengthChange": false, 
      		"autoWidth": false,
      		dom: 'Bfrtip',
     		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/getbiodata')?>",
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
            	"targets":  4,
                "mRender" : function(data, type, full){ return full[4]; }
            },

            { 
                "targets": [ -1 ], 
                "orderable": false,
                "data": null,
                "mRender" : function(data, type, full){
                	return '<tr><td><button class="btn btn-sm btn-info text-white" onclick=view_nilai("'+full[6]+'"); title="Detail Nilai"><i class="fas fa-search-plus"></i></button></td> </tr>';
                }
            }]
 
        }).buttons().container().appendTo('#data_nilai_wrapper .col-md-6:eq(0)');

    });

    function view_nilai(uid){
    	$.ajax({
        url: "<?php echo base_url('admin/nilai_getbyid') ?>",
        method: "POST",
        data: {
            usr: uid
        },
        dataType:"json",
        success: function(data) {
        var html = '';
        var no = 1;
        for(i=0; i<data.length; i++){
        html += '<tr>'+
        '<td>'+no+++'</td>'+
        '<td>'+data[i].nama_mapel+'</td>'+
        '<td>'+data[i].nilai+'</td>'+
        '<td>'+data[i].tgl_nilai+'</td>'+
        '<td>'+'<button class="btn btn-sm btn-danger text-white" onclick=hapusnilai("'+data[i].id_nilai+'","'+uid+'"); title="Hapus Nilai"><i class="fa fa-trash"></i></button>'+'</td>'+
        '</tr>';
        }
        $('#userid').val(uid);
        $('#nilaitempel').html(html);
        $('#modal-view-detailnilai').modal('show');
    	}
		})
	}

	function hapusnilai(idnilai,uid){
		$data = confirm('Hapus Nilai Ini?');
		if ($data == true){
	      $('#loadings').modal('show');
    		$.ajax({
                    url: "<?php echo base_url('admin/hapusnilai') ?>",
                    method: "POST",
                    data: {
                        idn: idnilai
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
                        view_nilai(uid);
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

	$(document).ready(function () {
          $("#submitinputnilai").click(function (event) {
              event.preventDefault();
              var form = $('#inputnilaiform')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url('admin/inputnilai'); ?>",
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
                        var test = $('#userid').val();
                        view_nilai(test);
                        $('#nilaiinput').val('');
                      	$('#inputnilai').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }
                      
                  })
                  }
              });

          });
       });

	$('.modal').css('overflow-y', 'auto');
 </script>