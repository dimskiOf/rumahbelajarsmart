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
        table = $('#data_biodata').DataTable({ 
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
                	return '<tr><td><button class="btn btn-sm btn-info text-white" onclick=view_biodata("'+full[6]+'"); title="Detail"><i class="fas fa-search-plus"></i></button></td> </tr>';
                }
            }]
 
        }).buttons().container().appendTo('#data_biodata_wrapper .col-md-6:eq(0)');

    });

    function view_biodata(uid){
    	$('#loadings').modal('show');
    	view_informan(uid);
    	$.ajax({
            url: "<?php echo base_url('admin/getbiodatabyid') ?>/",
            method: "POST",
            data: {
                usr: uid
            },
            dataType:"json",
            success: function(data) {
            for(i=0; i<data.length; i++){
            $('#loadings').modal('hide');
            var html = '<center><div class="image" id="foto2"><img src="<?php echo base_url('assets/img/foto-profil/'); ?>'+data[i].foto_profil+'" class="img-circle elevation-2" alt="Member Foto" style=width:60%;></div></center>';
            $('#fotomember').html(html); 
            $('#nama').val(data[i].nama);
           	$('#username').val(data[i].username);
           	$('#jenis_kelamin').val(data[i].jenis_kelamin);
           	$('#tgl_daftar').val(data[i].tgl_daftar);
           	$('#email').val(data[i].email);
           	$('#sekolah').val(data[i].sekolah);
           	$('#alamat').val(data[i].alamat);
           	$('#tempat_lahir').val(data[i].tempat_lahir);
           	$('#tgl_lahir').val(data[i].tgl_lahir);
           	$('#kelas').val(data[i].kelas);
           	$('#no_hp').val(data[i].no_hp);
           	$('#instagram').val(data[i].instagram);
           	$('#anak_ke').val(data[i].anak_ke);
           	$('#alamat_ortu').val(data[i].alamat_ortu);
           	$('#no_hp_ayah').val(data[i].no_hp_ayah);
           	$('#no_hp_ibu').val(data[i].no_hp_ibu);
           	$('#nama_ayah').val(data[i].nama_ayah);
           	$('#nama_ibu').val(data[i].nama_ibu);
           	$('#pekerjaan_ayah').val(data[i].pekerjaan_ayah);
           	$('#pekerjaan_ibu').val(data[i].pekerjaan_ibu);
           //	$('#informasi_dari').val(data[i].informasi_dari);
           	$('#hari_dan_sesi_pr1').val(data[i].hari_dan_sesi_pr1);
           	$('#hari_dan_sesi_pr2').val(data[i].hari_dan_sesi_pr2);
           	$('#hari_dan_sesi_pr3').val(data[i].hari_dan_sesi_pr3);
           	$('#kode_referal').val(data[i].kode_referal);
           	$('#loadings').modal('hide');
            $('#modal-view-biodata').modal('show');
        	}
        	}

    		});
    }

    function view_informan(uid){
      $(".list_informan").prop('checked', false);
    	$.ajax({
            url: "<?php echo base_url('admin/getinformanmember') ?>/",
            method: "POST",
            data: {
                usr: uid
            },
            dataType:"json",
            success: function(data) {
           	var html = '';
        	for(i=0; i<data.length; i++){
        	 $('#informan' + data[i].id_informasi).prop("checked", true);
        	}
        	}

    	});
    }
    $('.modal').css('overflow-y', 'auto');
 </script>
 