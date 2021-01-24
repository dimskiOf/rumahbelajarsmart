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
        table = $('#data_user').DataTable({ 
 			"responsive": true,
      		"lengthChange": false, 
      		"autoWidth": false,
      		dom: 'Bfrtip',
     		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('admin/getdatamember')?>",
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
                	return '<tr><td><button class="btn btn-sm btn-warning text-white" onclick=edit_member("'+full[5]+'","'+encodeURIComponent(full[1])+'","'+full[6]+'"); title="Edit Data"><i class="fa fa-edit"></i></button></td> <td><button class="btn btn-sm btn-info text-white" onclick=view_member("'+full[5]+'","'+full[6]+'","'+encodeURIComponent(full[1])+'","'+full[7]+'","'+full[8]+'","'+encodeURIComponent(full[9])+'"); title="view Data"><i class="fas fa-search-plus"></i></button></td>  <td><button class="btn btn-sm btn-danger text-white" onclick=nonaktifmember("'+full[5]+'","'+full[3]+'"); title="Ubah Status"><i class="fa fa-arrow-left"></i></button></td></tr>';
                }
            }]
 
        }).buttons().container().appendTo('#data_user_wrapper .col-md-6:eq(0)');

    });

     function nonaktifmember(uid,stat){
     	$data = confirm('Ganti Status Member?');
     	if (stat == 'Aktif'){
     		var status = 'NonAktif';
     	}else{
     		var status = 'Aktif';
     	}
		if ($data == true){
      $('#loadings').modal('show');
			   $.ajax({
                    url: "<?php echo base_url('admin/nonaktifdatamember') ?>/",
                    method: "POST",
                    data: {
                        usr: uid,
                        stat: status
                    },
                    dataType:"json",
                    success: function(data) {
                    $.each(data,function(pesan){
                $('#loadings').modal('hide');
		        		$('#pops').html(data.pesan);
		        		$('#popupvalidate').modal('show');
		        		$('#data_user').DataTable().ajax.reload();
                $('#loadings').modal('hide');
		        	})
                    }
                })
		}else{
			
		}
     }

    function hapuspaket(idp,uid){
		$data = confirm('Hapus paket ini?');
		if ($data == true){
      $('#loadings').modal('show');
			$.ajax({
                    url: "<?php echo base_url('admin/hapusdatapaketmember') ?>/",
                    method: "POST",
                    data: {
                        usr: uid,
                        ip: idp
                    },
                    dataType:"json",
                    success: function(data) {
                    $.each(data,function(pesan){
                $('#loadings').modal('hide');
		        		$('#pops').html(data.pesan);
		        		$('#modal-edit-member').modal('hide');
		        		$('#popupvalidate').modal('show');
                $('#loadings').modal('hide');
		        	})
                    }
                })
		}else{
			
		}
    }

    $(document).ready(function () {
          $("#updating-data-member").click(function (event) {
              event.preventDefault();
              var form = $('#updatingmember')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url(); ?>admin/inputdatapaketmember",
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
                      	$('#modal-edit-member').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }
                      
                  })
                  }
              });

          });
       });

    function appendpaketmember(){
    	$data = '<div id="ketmem" class="form-group row"><label class="col-sm-2 form-control-label">Tambah Paket</label><label><a href="javascript:;" onclick=removeappendpaket();><i class="fas fa-minus"></i>hapus</a></label><div class="col-sm-10"><select name=paketmember[] class="form-control"><?php foreach ($paketmember as $row){ echo '<option value='.$row['id_paket'].'>'.$row['nama_paket'].'</option>'; } ?></select></div></div>';
    	$('#tambahpaket').append($data);

    }

    function removeappendpaket(){
    	$('#ketmem').remove();
    }

    function view_member(id,fotoprofil,nama,jeniskelamin,email,alamat){
    	$.ajax({
                    url: "<?php echo base_url('admin/getdatapaketmember') ?>/",
                    method: "POST",
                    data: {
                        usr: id
                    },
                    dataType:"json",
                    success: function(data) {
                    var html = '';
                    var html2 = '';
                    var i; 
                    if (fotoprofil == 'w'){
                    html2 += '<div id="mediass"><img src="#" alt="Tidak ada Foto Profil"></div><br>';
                    }else if (fotoprofil == 'l') {
                    html2 += '<div id="mediass"><img src="#" alt="Tidak ada Foto Profil"></div><br>';
                    }else{
                    html2 += '<div id="mediass"><img src="<?php echo base_url('assets/') ?>img/foto-profil/'+fotoprofil+'" style="width:100%"></div><br>';
                    }
                    for(i=0; i<data.length; i++){
                    var sideof = (data[i].id_paket !== null ) ? '<tr>'+'<td>'+data[i].nama_paket+'</td>'+'<td>'+'<img alt="tidak ada gambar" src="<?php echo base_url('assets/') ?>img/Paket/'+data[i].gambar_paket+'" style="width:50%">'+'</td>'+'<td>'+data[i].harga_paket+'</td>'+'</tr>' : '<tr>'+'<td>'+'Tidak ada data'+'</td>'+'<td>'+'tidak ada data'+'</td>'+'<td>'+'tidak ada data'+'</td>'+'</tr>';
		                        html += sideof;
                        var names = data[i].nama;
                        var alamats = data[i].alamat;
                    }

                    $('#fotomemberview').html(html2);
	                $('#nama_memberview').val(names);
	                $('#jenis_kelaminview').val(jeniskelamin);
	                $('#email_memberview').val(email);
	                $('#alamat_memberview').val(alamats);
	                $('#datapaketmember').html(html);
                    $('#modal-view-member').modal('show');
                }

    		});
    	}

    function edit_member(id,nama,fotoprofil){
    	          $.ajax({
                    url: "<?php echo base_url('admin/getdatapaketmember') ?>/",
                    method: "POST",
                    data: {
                        usr: id
                    },
                    dataType:"json",
                    success: function(data) {
                    var html = '';
                    var html2 = '';
                    var i; 
                    if (fotoprofil == 'w'){
                    html2 += '<div id="mediass"><img src="#" alt="Tidak ada Foto Profil"></div>';
                    }else if (fotoprofil == 'l') {
                    html2 += '<div id="mediass"><img src="#" alt="Tidak ada Foto Profil"></div>';
                    }else{
                    html2 += '<div id="mediass"><img src="<?php echo base_url('assets/') ?>img/foto-profil/'+fotoprofil+'" style="width:100%"></div>';
                    }
                      var no = 1;
		              for(i=0; i<data.length; i++){
		                        html += '<tr>'+'<td>'+data[i].nama_paket+'</td>'+'<td>'+'<img alt="tidak ada gambar" src="<?php echo base_url('assets/') ?>img/Paket/'+data[i].gambar_paket+'" style="width:50%">'+'</td>'+'<td>'+data[i].harga_paket+'</td>'+'<td>'+'<a href=javascript:; class="paket_hapus" onclick=hapuspaket("'+data[i].id_paket+'","'+data[i].user_id+'"); id="paket_hapus">Hapus Paket</a>'+'</td>'+'</tr>';
                            var names = data[i].nama;
                            var alamats = data[i].alamat;
		                    }
		                $('#fotomember').html(html2);
		                $('#nama_member').val(names);
                    $('#idus').val(id);
		                $('#id').val(id);
		                $('#datapaket').html(html);
                        $('#modal-edit-member').modal('show');
                    }
                });
    }
    $('.modal').css('overflow-y', 'auto');
 </script>