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
<!-- SweetAlert2 -->
<script src="<?php echo base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
 <script src="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>

<script>
	 $(document).ready(function() {
        //datatables
        table = $('#data_invoicetracking').DataTable({ 
 			"responsive": true,
      		"lengthChange": false, 
      		"autoWidth": false,
      		dom: 'Bfrtip',
     		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('member/getinvoiceall')?>",
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
                	return '<tr><td><button class="btn btn-sm btn-info text-white" onclick=getkonfirm_tagihan("'+full[8]+'","'+full[9]+'","'+full[10]+'","'+full[7]+'"); title="Detail"><i class="fa fa-exchange-alt"></i></button></td> </tr>';
                }
            }]
 
        }).buttons().container().appendTo('#data_invoicetracking_wrapper .col-md-6:eq(0)');

    });


        /* Rupiah Boskoeh */
        function formatRupiah(angka, prefix) {
          var number_string = angka.toString().replace(/[^,\d]/g, ""),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

          // ribuan
          if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
          }

          rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
          return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "Rp. ";
        }

	     function getkonfirm_tagihan(invid,tghan,ptngan,uid){
            $('#loadings').modal('show');
              $.ajax({
                    url: "<?php echo base_url('member/getkonfirmtagihan') ?>/",
                    method: "POST",
                    data: {
                        inv: invid,
                        ids: uid
                    },
                    dataType:"json",
                    success: function(data) {
                    var html = '';
                    var no = 1;
                  for(i=0; i<data.length; i++){
                    var stat3 =  (data[i].status_pembayaran == 'Belum ada pembayaran') ? '<div class="form-group row"><label class="col-sm-10 form-control-label"><font>Belum Ada Pembayaran</font></label></div>' : '<div class="form-group row"><label class="col-sm-10 form-control-label"><font color="yellow">Belum Dikonfirmasi</font></label></div>';

                    var stat2 =  (data[i].status_pembayaran == 'Gagal') ? '<div class="form-group row"><label class="col-sm-10 form-control-label"><font color="red">Pembayaran Gagal</font></label></div>' : stat3;

                    var stat = (data[i].status_pembayaran == 'Terbayar') ? '<div class="form-group row"><label class="col-sm-10 form-control-label"><font color="green">Sudah Dikonfirmasi</font></label></div>' : stat2;

                    html += '<tr><td>'+
                 'Pembayaran ke '+no+++'</td>'+'<td>'+stat+'</td>'+'<td>'+formatRupiah(data[i].jml_pembayaran,'Rp ')+'</td>'+'<td>'+'<img id="imgbk" alt="belum ada pembayaran" src="<?php echo base_url('assets/') ?>img/bukti_pembayaran/'+data[i].bukti_pembayaran+'" style="width:30%" alt="tidak ada gambar" onclick= previewimg("<?php echo base_url('assets/') ?>img/bukti_pembayaran/'+data[i].bukti_pembayaran+'")>'+'</td>'+'<td>'+data[i].tgl_pembayaran+'</td>'+'</tr>';
                     $('#loadings').modal('hide');
                    $('#tampilbukti').html(html);
                    $('#modal-pembayaran-cek').modal('show');
                    }
                }

        });
    }

 function previewimg(data){
  $('.imagepreview').attr('src', data);
      $('#imagemodal').modal('show');   
}

 	$('.modal').css('overflow-y', 'auto');

</script>