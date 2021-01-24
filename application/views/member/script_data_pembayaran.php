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
 <!-- file input -->
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/js/piexif.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/js/sortable.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/js/purify.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>js/fileinput.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/fa/theme.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/fas/theme.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/explorer-fas/theme.js" type="text/javascript"></script>
 <script>
 	tagihan();
 	pembayaran();
 	rekapitulasi();
 	function tagihan(){
 		    	$.ajax({
                    url: "<?php echo base_url('member/gettagihan') ?>/",
                    method: "POST",
                    dataType:"json",
                    success: function(data) {
                    var html = '';
                    for(i=0; i<data.length; i++){
                    html += '<tr><td>'+data[i].nama_paket+'</td>'+'<td class="counting">'+formatRupiah(data[i].harga_paket,'')+'</td><tr>';
                    var datak = data[i].tagihan;
                    var datak2 = data[i].id_invoice;
                    var datak3 = data[i].potongan;
                    var datak4 = data[i].total;
                    var datak5 = data[i].nama;
                    }
                    $('#idinv').val(datak2);
                    $('#nm').val(datak5);
                    $('#tagihan').html(html);
                    document.getElementById('tagihan').innerHTML += '<tr><td colspan="2"><b>Subtotal : </b>' + formatRupiah(datak,'')  + '</td></tr>';
                    document.getElementById('tagihan').innerHTML += '<tr><td colspan="2"><b>Potongan : </b>' + formatRupiah(datak3,'')  + '</td></tr>';
                    document.getElementById('tagihan').innerHTML += '<tr><td colspan="2"><b>Total Kewajiban : </b>' + formatRupiah(datak4,'')  + '</td></tr>';
         
                }
            })
 	}

 	$('.modal').css('overflow-y', 'auto');

 	 $("#fotobukti").fileinput({
                theme: 'fas',
                showUpload: false,
                allowedFileExtensions: ["png","jpg","jpeg"],
                maxImageWidth: 260,
                maxImageHeight: 260,
                resizePreference: 'height',
                maxFileCount: 1,
                resizeImage: true
        });

 	$(document).ready(function () {
 		  var Toast = Swal.mixin({
		      toast: true,
		      position: 'top-end',
		      showConfirmButton: false,
		      timer: 3000
		    });



          $("#submitpembayaran").click(function (event) {
              event.preventDefault();
              var form = $('#kirimpembayaran')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url(); ?>member/submit",
                  data: data,
                  processData: false,
                  contentType: false,
                  cache: false,
                  dataType:"json",
                  success: function (data) {
 					$.each(data,function(pesan){
                      if (data.pesan.match(/alert-danger.*/)){
                      	$('#loadings').modal('hide');
                        Toast.fire({
        				        icon: 'error',
        				        title: data.pesan
        				      	})
                        $('#loadings').modal('show');
                      }else{
                        
                      }
                  })
                  },
                  complete:function(data)
                   {
                    $('#fotobukti').fileinput('clear');
                      $('#loadings').modal('hide'); 
                        Toast.fire({
                        icon: 'success',
                        title: 'Bukti pembayaran telah dikirim'
                        });
                        $('#loadings').modal('hide');
                        $('#modal-pembayaran').modal('hide');
                        pembayaran();
                        rekapitulasi();
                   }
              });

          });
      })

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
          return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
        }

        function pembayaran(){
 		    	$.ajax({
                    url: "<?php echo base_url('member/getpembayaran') ?>",
                    method: "POST",
                    dataType:"json",
                    success: function(data) {
                    var html = '';
                    var html2 = '';
                    for(i=0; i<data.length; i++){
                    var pem1 = (data[i].status_pembayaran == 'Menunggu Konfirmasi') ? '<font color="Yellow">'+data[i].status_pembayaran+'</font>' : '<font color="Green">'+data[i].status_pembayaran+'</font>';
                    var pem2 = (data[i].status_pembayaran == 'Gagal') ? '<font color="Red">'+data[i].status_pembayaran+'</font>' : pem1 ;

                    html += '<tr>'+
                    '<td>Pem - '+data[i].id_invoice+'</td>'+
                    '<td> '+pem2+'</td>'+
                    '<td> '+data[i].tgl_pembayaran+'</td>'+
                    '<td class="countings"> '+formatRupiah(data[i].jml_pembayaran,'')+'</td>'
                    +'<tr>';
                    }
                    $('#pembayaran').html(html);
                    totalpembayaran();
                }
            })
 	}

 	function totalpembayaran(){
		 var TotalValue = 0;

	       $("tr .countings").each(function(index,value){
	         currentRow = parseFloat($(this).text().replace('.',''));
	         TotalValue += currentRow
	       });

    		document.getElementById('pembayaran').innerHTML += '<tr><td colspan="4"><b>Total : </b>' + formatRupiah(TotalValue,'')  + '</td></tr>';
 	}

 	function rekapitulasi(){
 		    	$.ajax({
                    url: "<?php echo base_url('member/getrekapitulasi') ?>/",
                    method: "POST",
                    dataType:"json",
                    success: function(data) {
                    var html = '';
                    for(i=0; i<data.length; i++){
                    html += '<tr><td>'+formatRupiah(data[i].tagihan,'')+'</td>'+'<td>'+formatRupiah(data[i].subtot,'')+'</td>'
                    +'<td>'+formatRupiah(data[i].potongan,'')+'</td>'+
                    '<tr>'+
                    '<td colspan="4"><b> Pembayaran Lain-lain : </b>'+formatRupiah(data[i].total,'')+
                    '</td>'+
                    '<tr>'
                    ;
                    }
                    $('#rekapitulasi').html(html);
                    
                }
            })
 	}

 </script>