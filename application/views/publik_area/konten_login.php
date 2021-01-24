<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?php echo base_url() ?>" class="h1"><b>Rumah Belajar</b>Smart Indonesia</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Silahkan Login Bila Sudah Memiliki Akun</p>

      <form action="<?php echo base_url('member/auth/'.$_SERVER['REMOTE_ADDR'].'/'.md5(rand())) ?>" method="post">
        <?php
          if ($this->session->flashdata('pesan')){
          echo '<p>'.$this->session->flashdata('pesan').'</p>';
      }
      ?>
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
        <div class="input-group mb-3">
          <input type="text" name="usem" class="form-control" placeholder="Username atau email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="<?php echo base_url('member/password') ?>">Lupa Password?</a>
      </p>
      <p class="mb-0">
        <a href="<?php echo base_url('member/register') ?>" class="text-center">Register Member</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->