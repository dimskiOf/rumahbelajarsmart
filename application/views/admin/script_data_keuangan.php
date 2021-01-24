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
        table = $('#data_keuangan').DataTable({ 
 			"responsive": true,
      		"lengthChange": false, 
      		"autoWidth": false,
      		dom: 'Bfrtip',
     		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/getkeuangandatamember')?>",
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
                	return '<tr><td><button class="btn btn-sm btn-info text-white" onclick=view_tagihan("'+full[5]+'"); title="view Tagihan"><i class="fas fa-search-plus"></i></button></td>  <td><button class="btn btn-sm btn-success text-white" onclick=buattagihan("'+full[5]+'","'+full[3]+'","'+full[6]+'"); title="Buat Tagihan"><i class="fa fa-arrow-right"></i></button></td></tr>';
                }
            }]
 
        }).buttons().container().appendTo('#data_keuangan_wrapper .col-md-6:eq(0)');

    });

        $(document).ready(function () {
          $("#kirimtagihan").click(function (event) {
              event.preventDefault();
              var form = $('#kirimtagihanform')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url(); ?>admin/kirimdatatagihanmember",
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
                      	$('#data_invoice').DataTable().ajax.reload();
                      	$('#modal-buat-tagihan').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }
                      
                  })
                  }
              });

          });
       });

    function buattagihan(uid,status,fotoprof,nama){
      view_paket(uid);
    	$.ajax({
                    url: "<?php echo base_url('admin/getkirimtagihan') ?>/",
                    method: "POST",
                    data: {
                        usr: uid
                    },
                    dataType:"json",
                    success: function(data) {
                    var html = '';
                    var html2 = '';
                    var i; 
                    if (fotoprof == 'w'){
                    html2 += '<div id="mediass"><img src="#" alt="Tidak ada Foto Profil"></div>';
                    }else if (fotoprof == 'l') {
                    html2 += '<div id="mediass"><img src="#" alt="Tidak ada Foto Profil"></div>';
                    }else{
                    html2 += '<div id="mediass"><img src="<?php echo base_url('assets/') ?>img/foto-profil/'+fotoprof+'" style="width:100%"></div>';
                    }
                    for(i=0; i<data.length; i++){
                    $('#idtagihanuser').val(uid);
                    $('#orgtagihan').val(data[i].nama);
                    $('#alamattagihan').val(data[i].alamat);
                    $('#referal').val(data[i].kode_referal);
                    $('#potongan').val(data[i].potongan);
                    $('#tagihan').val(data[i].subtot);
                    }
                    $('#fotomember').html(html2);
                    $('#modal-buat-tagihan').modal('show');
                }

    		});
    }

    var table;
    $(document).ready(function() {
        //datatables
        table = $('#data_invoice').DataTable({ 
 			"responsive": true,
      		"lengthChange": false, 
      		"autoWidth": false,
      		dom: 'Bfrtip',
     		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/getinvoiceall')?>",
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
                	return '<tr><td><button class="btn btn-sm btn-info text-white" onclick=getkonfirm_tagihan("'+full[8]+'","'+full[9]+'","'+full[10]+'","'+full[7]+'"); title="Konfirmasi Tagihan"><i class="fa fa-exchange-alt"></i></button></td>  <td><button class="btn btn-sm btn-danger text-white" onclick=hapustagihan("'+full[8]+'","'+full[9]+'"); title="Hapus Tagihan"><i class="fa fa-remove-format"></i></button></td></tr>';
                }
            }]
 
        }).buttons().container().appendTo('#data_invoice_wrapper .col-md-6:eq(0)');

    });

        var table;
    $(document).ready(function() {
        //datatables
        table = $('#data_pembayaran').DataTable({ 
 			"responsive": true,
      		"lengthChange": false, 
      		"autoWidth": false,
      		dom: 'Bfrtip',
     		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/getpembayaran')?>",
                "type": "POST"
            }
           
 
        }).buttons().container().appendTo('#data_pembayaran_wrapper .col-md-6:eq(0)');

    });
    
      function view_paket(uid){
      $(".list_paket").prop('checked', false);
      $.ajax({
            url: "<?php echo base_url('admin/getdatapaketmember') ?>",
            method: "POST",
            data: {
                usr: uid
            },
            dataType:"json",
            success: function(data) {
            var html = '';
          for(i=0; i<data.length; i++){
           $('#paket' + data[i].id_paket).prop("checked", true);
          }
          }

      });
    }

    function view_tagihan(uid){
    	$.ajax({
                    url: "<?php echo base_url('admin/getinvoice') ?>/",
                    method: "POST",
                    data: {
                        usr: uid
                    },
                    success: function(data) {
                    $('#datatagihan').html(data);
                    $('#modal-view-status').modal('show');
                }

    		});
    }

$('.modal').css('overflow-y', 'auto');

function previewimg(data){
  $('.imagepreview').attr('src', data);
      $('#imagemodal').modal('show');   
}
    
     $('#statuspem').on('change',function() {
            if ((this.value) == 'Gagal') {
              $("#jml_pem").prop("disabled", true);
              $("#jml_pem").val('0');
            }else{
              $("#jml_pem").val('');
              $("#jml_pem").prop("disabled", false);
            }
        })

    $(document).ready(function () {
          $("#konfirmtagihanmember").click(function (event) {
              event.preventDefault();
              var form = $('#konfirmasitagihanform')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url(); ?>admin/konfirmasipembayaran",
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
                        $('#data_invoice').DataTable().ajax.reload();
                        $('#data_pembayaran').DataTable().ajax.reload();
                        $('#modal-get-konfirmasi').modal('hide');
                        $('#modal-konfirmasi').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }
                      
                  })
                  }
              });

          });
       });
    
    function getkonfirm_tagihan(invid,tghan,ptngan,uid){
              $.ajax({
                    url: "<?php echo base_url('admin/getkonfirmtagihan') ?>/",
                    method: "POST",
                    data: {
                        inv: invid
                    },
                    dataType:"json",
                    success: function(data) {
                    var html = '';
                    var no = 1;
                  for(i=0; i<data.length; i++){
                    var stat2 =  (data[i].status_pembayaran == 'Gagal') ? '<div class="form-group row"><label class="col-sm-10 form-control-label"><font color="red">Pembayaran Gagal</font></label></div>' : '<div class="form-group row"><label class="col-sm-2 form-control-label"><button class="btn btn-sm btn-info text-white" onclick=konfirm("'+data[i].id_invoice+'","'+data[i].id_pembayaran+'","'+data[i].jml_pembayaran+'","'+(tghan-ptngan)+'","'+uid+'","'+encodeURIComponent(data[i].nama)+'"); title="Konfirmasi"><i class="fa fa-exchange-alt"></i></button></label><div class="col-sm-10"></div></div>';

                    var stat = (data[i].status_pembayaran == 'Terbayar') ? '<div class="form-group row"><label class="col-sm-10 form-control-label"><font color="green">Sudah Dikonfirmasi</font></label></div>' : stat2;

                    html += '<tr><td>'+
                  'Pembayaran ke '+no+++'</td>'+'<td>'+stat+'</td>'+'<td>'+data[i].jml_pembayaran+'</td>'+'<td>'+'<img id="imgbk" onclick=previewimg("<?php echo base_url('assets/') ?>img/bukti_pembayaran/'+data[i].bukti_pembayaran+'"); src="<?php echo base_url('assets/') ?>img/bukti_pembayaran/'+data[i].bukti_pembayaran+'" style="width:30%" alt="tidak ada pembayaran">'+'</td>'+'<td>'+data[i].tgl_pembayaran+'</td></tr>';  
                    }
                    $('#tampilbukti').html(html);
                    $('#tagihan_potongan').val(tghan-ptngan);
                    $('#modal-get-konfirmasi').modal('show');
                }

        });
    }

    function konfirm(invid,idpem,jmlpem,kalk,uid,namas){
      $data = confirm('Konfirmasi Tagihan Ini?');
        if ($data == true){
          $('#namas').val(namas);
          $('#uid').val(uid);
          $('#kalkulasi').val(kalk);
          
          $('#kd_inv').val(invid);
          $('#kd_pem').val(idpem);
          $('#modal-konfirmasi').modal('show');
        }else{

        }
    }

    function hapustagihan(invid,tghan){
    		$data = confirm('Hapus Tagihan Ini?');
     		if ($data == true){
          $('#loadings').modal('show');
    		$.ajax({
                    url: "<?php echo base_url('admin/hapustagihan') ?>/",
                    method: "POST",
                    data: {
                        inv: invid
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
                        $('#data_invoice').DataTable().ajax.reload();
                        $('#data_pembayaran').DataTable().ajax.reload();
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
 </script>