<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Akun | Profil</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <link href="<?php echo base_url('assets/') ?>css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Loading -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/loading2.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <div class="container">
  <div class="modal fade" id="modalfotoprofil" role="dialog">
   <div class="subtab_left">
        <div class="modal-dialog modal-dialog-centered">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Foto Profil  </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form class="form-horizontal" id="fotoupdate">
          <div class="modal-body">
             <div class="form-group row">
                          <div class="col-sm-10">
                            <input id="id_users" name="id_users" type="hidden" value="" class="form-control" required="" readonly="">
                          </div>
           </div>
           <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Masukan Foto Profil (.jpg.png)</label>
                      <div class="col-sm-10">
                    <input id="file-foto-p" name="fotoprofil" class="file" type="file">
                </div>
            </div>
          </div>
      <div class="modal-footer">
            <button type="button" id="updatingfotoprofil" class="btn btn-primary" data-dismiss="modal">Upload FOTO PROFIL</button>
          </div>
          </form>
          </div>
        </div>
       
      </div>
  </div>
  </div>

  <div class="container">
  <div class="modal fade" id="popupvalidate" style="z-index: 100000;" role="dialog">
   <div class="subtab_left">
        <div class="modal-dialog modal-dialog-centered">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">  Form Validasi  </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
           <center><div id="pops"></div></center>
          </div>
          </div>
        </div>
       
      </div>
  </div>
  </div>