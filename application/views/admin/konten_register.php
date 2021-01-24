<div class="modal fade" id="modal-sk">
        <div class="modal-dialog">
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">Syarat dan Ketentuan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>isi syarat</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?php echo base_url(); ?>" class="h1"><b>Rumah Belajar</b>Smart Indonesia</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Registrasi Member Baru</p>

      <form action="<?php echo base_url('admin/register/auth/'.$_SERVER['REMOTE_ADDR'].'/'.md5(rand())); ?>" method="post">
        <?php
              echo validation_errors();
          if (isset($success))
              echo '<p>'.$success.'</p>';
            ?>
        <div id="message"></div>
        <div class="input-group mb-3">
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
          <input type="text" name="nama" required data-msg="Input Nama Lengkap" class="form-control" placeholder="Nama lengkap">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" id="email" required data-msg="Input Email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" id="username" required data-msg="Input Username" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select name="jenis_kel" required data-msg="Input Jenis Kelamin" class="form-control is-valid" aria-invalid="false">
          <option value="">--Jenis Kelamin--</option>
          <option value="1">Wanita</option>
          <option value="2">Pria</option>
        </select>
        </div>
        <div class="input-group mb-3">
          <select name="hak" required data-msg="Input Hak" class="form-control is-valid" aria-invalid="false">
          <option value="">--Hak Akses--</option>
          <option value="1">STAF</option>
          <option value="2">MEMBER</option>
          <option value="3">SUPERADMIN</option>
        </select>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" required data-msg="Input Password" class="form-control" placeholder="Password. Contoh: Budi123#">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="re_password" required data-msg="Input Ulangi" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" required data-msg="harap diisi" id="agreeTerms" name="terms" value="">
              <label for="agreeTerms">
               Saya setuju dengan <a href="#" data-toggle="modal" data-target="#modal-sk">S&K</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="<?php echo base_url('member/login') ?>" class="text-center">Saya Sudah Mempunyai Akun</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->