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
	$(document).ready(function() {
    $('#add-person-to').select2({
    	minimumInputLength: 1,
    	ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
        type: 'POST',
        url: "<?php echo base_url('admin/getuser') ?>",
        dataType: 'json',
        data: function (params) {
	      return {
	        search: params.term
	      }
	    },
	    processResults: function (data, page) {
		    return {
		        results: data
		    };
		},
    }
    }).on('select2:select', function (evt) {
         var data = $("#add-person-to option:selected").text();
    });


    $('#semua').change(function() {
            if ($(this).is(":checked")) {
            	var a = 'semua';
            	$(this).val(a);
            	$("#dummysemuauser").prop("disabled", true);
  				$("#add-person-to").prop("disabled", true);
            }else{
            	$("#dummysemuauser").prop("disabled", false);
            	$("#add-person-to").prop("disabled", false);
            	var a = 'pemilihan';
            	$(this).val(a);
            }
        })

});

	//proses input data berita gambar dan video
       function inputnotif(){

                event.preventDefault();

                var form = $('#prosesing_notif')[0];

                var data = new FormData(form);
                var m = $('#semua').val();
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: '<?php echo base_url(); ?>admin/inputdatanotif',
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    dataType : 'json',
                  success: function (data) {
                    $.each(data,function(pesan){
                      if (data.pesan.match(/alert-danger.*/)){
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                      }else{
                        $('#add-person-to').val(null).trigger('change');
                        $('#goreadme').summernote('code', '');
                        $('#jdl-notif').val('');
                        $('#popupvalidate').modal('show');
                        $('#pops').html(data.pesan);
                      }
                      
                  });
                    }
       			 });
            }

	$('#goreadme').summernote({
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


</script>