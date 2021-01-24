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
 <!-- file input -->
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/js/piexif.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/js/sortable.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/js/purify.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>js/fileinput.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/fa/theme.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/fas/theme.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fileinput/explorer-fas/theme.js" type="text/javascript"></script>
 <script>
 	    var table;
    $(document).ready(function() {
        //datatables
        table = $('#data_paket').DataTable({ 
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
            	"targets":  4,
                "mRender" : function(data, type, full){ return full[4]; }
            },

            { 
                "targets": [ -1 ], 
                "orderable": false,
                "data": null,
                "mRender" : function(data, type, full){
                	return '<tr><td><button class="btn btn-sm btn-info text-white" onclick=editpaket("'+full[5]+'"); title="Edit Data"><i class="fas fa-edit"></i></button></td><td><button class="btn btn-sm btn-info text-white" onclick=detailpaket("'+full[5]+'"); title="Detail Paket"><i class="fas fa-search-plus"></i></button></td><td><button class="btn btn-sm btn-danger text-white" onclick=hapuspaket("'+full[5]+'"); title="Hapus Paket"><i class="fa fa-trash"></i></button></td></tr>';
                }
            }]
 
        }).buttons().container().appendTo('#data_paket_wrapper .col-md-6:eq(0)');

    });

    $("#fotopaketname").fileinput({
                theme: 'fas',
                showUpload: false,
                allowedFileExtensions: ["png","jpg","jpeg"],
                maxImageWidth: 260,
                maxImageHeight: 260,
                resizePreference: 'height',
                maxFileCount: 1,
                resizeImage: true
        });

     $("#fotopaketname2").fileinput({
                theme: 'fas',
                showUpload: false,
                allowedFileExtensions: ["png","jpg","jpeg"],
                maxImageWidth: 260,
                maxImageHeight: 260,
                resizePreference: 'height',
                maxFileCount: 1,
                resizeImage: true
        });

    function hapuspaket(idp)
    {
    	$data = confirm('Hapus Paket Ini?');
        if ($data == true){
          $('#loadings').modal('show');
    	$.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>admin/hapuspaket",
                  data: {id : idp},
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
                      	$('#data_paket').DataTable().ajax.reload();
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

    function detailpaket(idp)
    {	
    	$.ajax({
            url: "<?php echo base_url('admin/getpaketbyid') ?>/",
            method: "POST",
            data: {
                idpaket: idp
            },
            dataType:"json",
            success: function(data) {
            	for(i=0; i<data.length; i++){ 
            	var html = '<center><div class="image" id="foto2"><img src="<?php echo base_url('assets/img/Paket/'); ?>'+data[i].gambar_paket+'" class="img-circle elevation-2" alt="Paket Image" style=width:60%;></div></center>';
            	$('#paket_nama').val(data[i].nama_paket);
		    	$('#status_paket').val(data[i].status);
		    	$('#fotopaket').html(html);
		    	$('#paket_harga').val(data[i].harga_paket);
		    	$('#rincian_paket').val(data[i].rincian_paket);
		    	$('#kurikulum_paket').val(data[i].kurikulum_paket);
		    	$('#modal-view-paket').modal('show');

            	}
            }
        })
    }

     function editpaket(idp)
    {	
    	$.ajax({
                    url: "<?php echo base_url('admin/getpaketbyid') ?>/",
                    method: "POST",
                    data: {
                        idpaket: idp
                    },
                    dataType:"json",
                    success: function(data) {
                    	for(i=0; i<data.length; i++){ 
                    	var html = '<center><div class="image" id="foto2"><img src="<?php echo base_url('assets/img/Paket/'); ?>'+data[i].gambar_paket+'" class="img-circle elevation-2" alt="Paket Image" style=width:60%;></div></center>';
                    	$('#idp').val(idp);
                    	$('#paket_nama1').val(data[i].nama_paket);
				    	$('#status_paket1').val(data[i].status).change();
				    	$('#fotopaket1').html(html);
              $('#id_paket').val(idp);
				    	$('#paket_harga1').val(data[i].harga_paket);
				    	$('#rincian_paket1').summernote('code', data[i].rincian_paket);
				    	$('#kurikulum_paket1').summernote('code', data[i].kurikulum_paket);
				    	$('#modal-edit-paket').modal('show');

                    	}
                    }
                })
    }

        $(document).ready(function () {
          $("#submiteditpaket").click(function (event) {
              event.preventDefault();
              var form = $('#editpaket')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url(); ?>admin/editdatapaket",
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
                      	$('#data_paket').DataTable().ajax.reload();
                      	$('#modal-edit-paket').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }  
                  })
                  }
              });

          });
       });

        $(document).ready(function () {
          $("#updatingpaketfoto").click(function (event) {
              event.preventDefault();
              var form = $('#fotopaketupdate')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url(); ?>admin/editfotopaket",
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
                        var html = '<center><div class="image" id="foto2"><img src="<?php echo base_url('assets/img/Paket/'); ?>'+data.detrox+'" class="img-circle elevation-2" alt="Paket Image" style=width:60%;></div></center>';
                        $('#fotopaket1').html(html);
                        $('#data_paket').DataTable().ajax.reload();
                        $('#modal-edit-foto-paket').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }  
                  })
                  }
              });

          });
       });

        $(document).ready(function () { 
        	$('#rincian_paket1').summernote({
            minHeight: 200,
            placeholder: 'Tulis Disini ...',
            focus: false,
            airMode: false,
            fontNames: ['Roboto', 'Calibri', 'Times New Roman', 'Arial'],
            fontNamesIgnoreCheck: ['Roboto', 'Calibri'],
            dialogsInBody: true,
            dialogsFade: true,
            disableDragAndDrop: false,
            callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    },
                    onMediaDelete : function(target) {
                        deleteImage(target[0].src);
                    }
                },
            toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['para', ['style', 'ul', 'ol', 'paragraph']],
              ['fontsize', ['fontsize']],
              ['fontname', ['fontname']],
              ['insert', ['link', 'picture', 'video']],
              ['font', ['strikethrough', 'superscript', 'subscript']],
              ['height', ['height']],
              ['color', ['color']],
              ['misc', ['undo', 'redo', 'codeview', 'print', 'help', 'fullscreen']]
            ],
            popover: {
              image: [
              ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
              ['float', ['floatLeft', 'floatRight', 'floatNone']],
              ['remove', ['removeMedia']]
              ],
              table: [
              ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
              ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
              ],
              air: [
                ['color', ['color']],
                ['font', ['bold', 'underline', 'clear']]
              ]
            },
            print: {
              //'stylesheetUrl': 'url_of_stylesheet_for_printing'
            }
       });

      
        	$('#kurikulum_paket1').summernote({
            minHeight: 200,
            placeholder: 'Tulis Disini ...',
            focus: false,
            airMode: false,
            fontNames: ['Roboto', 'Calibri', 'Times New Roman', 'Arial'],
            fontNamesIgnoreCheck: ['Roboto', 'Calibri'],
            dialogsInBody: true,
            dialogsFade: true,
            disableDragAndDrop: false,
            callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    },
                    onMediaDelete : function(target) {
                        deleteImage(target[0].src);
                    }
                },
            toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['para', ['style', 'ul', 'ol', 'paragraph']],
              ['fontsize', ['fontsize']],
              ['fontname', ['fontname']],
              ['insert', ['link', 'picture', 'video']],
              ['font', ['strikethrough', 'superscript', 'subscript']],
              ['height', ['height']],
              ['color', ['color']],
              ['misc', ['undo', 'redo', 'codeview', 'print', 'help', 'fullscreen']]
            ],
            popover: {
              image: [
              ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
              ['float', ['floatLeft', 'floatRight', 'floatNone']],
              ['remove', ['removeMedia']]
              ],
              table: [
              ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
              ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
              ],
              air: [
                ['color', ['color']],
                ['font', ['bold', 'underline', 'clear']]
              ]
            },
            print: {
              //'stylesheetUrl': 'url_of_stylesheet_for_printing'
            }
       });

          $('#rincian_paket2').summernote({
            minHeight: 200,
            placeholder: 'Tulis Disini ...',
            focus: false,
            airMode: false,
            fontNames: ['Roboto', 'Calibri', 'Times New Roman', 'Arial'],
            fontNamesIgnoreCheck: ['Roboto', 'Calibri'],
            dialogsInBody: true,
            dialogsFade: true,
            disableDragAndDrop: false,
            callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    },
                    onMediaDelete : function(target) {
                        deleteImage(target[0].src);
                    }
                },
            toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['para', ['style', 'ul', 'ol', 'paragraph']],
              ['fontsize', ['fontsize']],
              ['fontname', ['fontname']],
              ['insert', ['link', 'picture', 'video']],
              ['font', ['strikethrough', 'superscript', 'subscript']],
              ['height', ['height']],
              ['color', ['color']],
              ['misc', ['undo', 'redo', 'codeview', 'print', 'help', 'fullscreen']]
            ],
            popover: {
              image: [
              ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
              ['float', ['floatLeft', 'floatRight', 'floatNone']],
              ['remove', ['removeMedia']]
              ],
              table: [
              ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
              ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
              ],
              air: [
                ['color', ['color']],
                ['font', ['bold', 'underline', 'clear']]
              ]
            },
            print: {
              //'stylesheetUrl': 'url_of_stylesheet_for_printing'
            }
       });

          $('#kurikulum_paket2').summernote({
            minHeight: 200,
            placeholder: 'Tulis Disini ...',
            focus: false,
            airMode: false,
            fontNames: ['Roboto', 'Calibri', 'Times New Roman', 'Arial'],
            fontNamesIgnoreCheck: ['Roboto', 'Calibri'],
            dialogsInBody: true,
            dialogsFade: true,
            disableDragAndDrop: false,
            callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    },
                    onMediaDelete : function(target) {
                        deleteImage(target[0].src);
                    }
                },
            toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['para', ['style', 'ul', 'ol', 'paragraph']],
              ['fontsize', ['fontsize']],
              ['fontname', ['fontname']],
              ['insert', ['link', 'picture', 'video']],
              ['font', ['strikethrough', 'superscript', 'subscript']],
              ['height', ['height']],
              ['color', ['color']],
              ['misc', ['undo', 'redo', 'codeview', 'print', 'help', 'fullscreen']]
            ],
            popover: {
              image: [
              ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
              ['float', ['floatLeft', 'floatRight', 'floatNone']],
              ['remove', ['removeMedia']]
              ],
              table: [
              ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
              ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
              ],
              air: [
                ['color', ['color']],
                ['font', ['bold', 'underline', 'clear']]
              ]
            },
            print: {
              //'stylesheetUrl': 'url_of_stylesheet_for_printing'
            }
       });

          $("#ganti_fp").click(function (event) {
            $('#modal-edit-foto-paket').modal('show');
          })

          $("#addpaket").click(function (event) {
            $('#modal-buat-paket').modal('show');
          })

        $("#submitbuatpaket").click(function (event) {
              event.preventDefault();
              var form = $('#buatpaket')[0];
              var data = new FormData(form);
              $('#loadings').modal('show');
              $.ajax({
                  type: "POST",
                  enctype: 'multipart/form-data',
                  url: "<?php echo base_url(); ?>admin/inputpaket",
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
                        document.getElementById('buatpaket').reset();
                        $('#rincian_paket2').summernote('code', '');
                        $('#kurikulum_paket2').summernote('code', '');
                        $('#fotopaketname2').fileinput('clear');
                        $('#data_paket').DataTable().ajax.reload();
                        $('#modal-buat-paket').modal('hide');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                        $('#loadings').modal('hide');
                      }  
                  })
                  }
              });

          });

         })

$('.modal').css('overflow-y', 'auto');
 </script>