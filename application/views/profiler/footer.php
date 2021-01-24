<!-- jQuery -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
  $('.modal').css('overflow-y', 'auto');
  tampil_profiler();
  //UPDATE DATA PROFIL GETTER AND SETTER
      function tampil_profiler(){
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('akun/user'); ?>",
                async : true,
                dataType : 'json',
                success: function(data){
                var html = '';
              $.each(data,function(username, nama, jenis_kelamin, email, foto_profil){
                  var pp = (data.foto_profil == 'a') ? "<img src='#' alt='...' class='img-fluid rounded-circle'>" : "<img src='<?php echo base_url('assets/img/foto-profil/'); ?>"+data.foto_profil+"' alt='...' class='img-fluid rounded-circle'>";
                  $('[name="id_users"]').val(data.username);
                  $('[name="nama-usr"]').val(data.nama);
                  $('[name="username-usr"]').val(data.username);
                  $('[name="email-usr"]').val(data.email);
                  $('#edt-klmn-usr').val(data.jenis_kelamin).trigger('change');
                  $('#foto1').html(pp);

                  });
                }
            });
            return false;
        };

        //GANTI FOTO PROFIL
      $('.ganti_foto').on('click',function(){
        $('#modalfotoprofil').modal('show');
      });

      //file input Foto Profil
      $("#file-foto-p").fileinput({
                theme: 'fas',
                showUpload: false,
                allowedFileExtensions: ["png","jpg","jpeg"],
                maxImageWidth: 260,
                maxImageHeight: 260,
                resizePreference: 'height',
                maxFileCount: 1,
                resizeImage: true
        });

            //UPDATE FOTO PROFIL EXEC
        $('#updatingfotoprofil').on('click',function(){
          event.preventDefault();
            var form = $('#fotoupdate')[0];
            var data = new FormData(form);
            $('#loadings').modal('show');
          $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: '<?php echo base_url('akun/update_foto_profil'); ?>',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            dataType : 'json',
              success: function(data){
                 $.each(data,function(pesan){
                  var foto1 = "<img src='<?php echo base_url('assets/img/foto-profil/'); ?>"+data.detrox+"' alt='...' class='img-fluid rounded-circle'>"
                  var ids = '<img src="<?php echo base_url('assets/img/foto-profil/'); ?>'+data.detrox+'" class="img-circle elevation-2" alt="User Image">';
                  if (data.pesan.match(/alert-danger.*/)){
                    $('#loadings').modal('hide');
                    $('#popupvalidate').modal('show');
                    $('#pops').html(data.pesan);
                    $('#loadings').modal('hide');
                  }else{
                    $('#loadings').modal('hide');
                    $('#modalfotoprofil').modal('hide');
                    document.getElementById('fotoupdate').reset();
                    $('#popupvalidate').modal('show');
                    $('#foto1').html(foto1);
                    $('#foto2').html(ids);
                    $('#pops').html(data.pesan);
                    $('#loadings').modal('hide');
                  }
                 });   
                }
            });
            return false;
        });

              //Update DATA PROFIL EXEC
        $('#updating-data-user').on('click',function(){
          event.preventDefault();
            var form = $('#updatingprofiler')[0];
            var data = new FormData(form);
            $('#loadings').modal('show');
          $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: '<?php echo base_url('akun/update_profil'); ?>',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            dataType : 'json',
              success: function(data){
                 $.each(data,function(pesan){
                  if (data.pesan.match(/alert-danger.*/)){
                    $('#loadings').modal('hide');
                    $('#popupvalidate').modal('show');
                    $('#pops').html(data.pesan);
                    $('#loadings').modal('hide');
                  }else{
                    $('#loadings').modal('hide');
                    $('#popupvalidate').modal('show');
                    $('#pops').html(data.pesan);
                    document.getElementById('updatingprofiler').reset();
                    tampil_profiler();
                    $('#loadings').modal('hide');
                  }
                 });   
                }
            });
            return false;
        });
</script>