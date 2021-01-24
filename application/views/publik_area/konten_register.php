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
<section class="content">
  <div class="container-fluid">
            <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><b>FORMULIR PENDAFTARAN</b></h3>
              </div>
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Program yang dipilih</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#information-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Biodata</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#login-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="login-part" id="login-part-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Login Data</span>
                      </button>
                    </div>
                  </div>
                  <div class="bs-stepper-content">
                    <!-- your steps content here -->
                     <form action="<?php echo base_url('member/register/auth/'.$_SERVER['REMOTE_ADDR'].'/'.md5(rand())); ?>" method="post">
                      <?php
                         echo $this->session->flashdata('errors');
                          ?>
                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                      <?php 
                      $this->db->from('paket_bimbel');
                      $this->db->where('status', 'Aktif');
                      $this->db->order_by('id_paket', 'ASC');
                      $query = $this->db->get();
                      $paket = $query->result_array();

                      ?>
                      <?php foreach ($paket as $row) {
                      
                       ?>
                      <div class="form-group">
                        <div class="col-sm-10 form-control-label">
                      <div class="mt-1" style="background: none; border:none;">
                        <div class="icheck-success d-inline">
                          <input type="checkbox" class="list_menu" id="<?php echo $row['id_paket']; ?>" name="program[]" value="<?php echo $row['id_paket']; ?>" <?php if ($this->session->flashdata('program') != null) {foreach($this->session->flashdata('program') AS $key => $val) { echo ($row['id_paket'] == $val  ? 'checked' : ''); } } ?>>
                          <label for="<?php echo $row['id_paket']; ?>"><?php echo $row['nama_paket']; ?></label>
                        </div>
                      </div>
                      </div>
                      </div>
                    <?php } ?>

                      <button class="btn btn-primary tes" onclick="stepper.next()">Selanjutnya</button>
                    </div>
                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">Nama Lengkap</label>
                          <div class="col-sm-10">
                          <input id="nama" placeholder="Nama Lengkap" name="nama" type="text" class="form-control" value="<?php echo $this->session->flashdata('nama'); ?>">
                          </div>
                      </div>
                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">Tempat Lahir</label>
                          <div class="col-sm-10">
                          <input id="tl" name="tl" placeholder="Tempat Lahir Anda" type="text" class="form-control" value="<?php echo $this->session->flashdata('tl'); ?>">
                          </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Tanggal Lahir</label>
                          <div class="col-sm-10">
                          <input value="<?php echo $this->session->flashdata('tgllahir'); ?>" id="datemask" type="text" class="form-control" name="tgllahir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                        </div>   
                        <!-- /.input group -->
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 form-control-label">JENIS KELAMIN</label>
                          <div class="col-sm-10">
                          <select name="jenis_kel" required data-msg="Input Jenis Kelamin" class="form-control is-valid" aria-invalid="false">
                          <option value="">--Pilih Jenis Kelamin--</option>
                          <option value="1" <?php echo ('1' == $this->session->flashdata('jenis_kel') ? ' selected="selected"' : ''); ?>>Perempuan</option>
                          <option value="2" <?php echo ('2' == $this->session->flashdata('jenis_kel') ? ' selected="selected"' : ''); ?>>Laki-Laki</option>
                      </select>
                        </div>   
                        <!-- /.input group -->
                      </div>
                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">SEKOLAH</label>
                          <div class="col-sm-10">
                          <input id="sekolah" placeholder="Nama Sekolah" name="sekolah" type="text" class="form-control" value="<?php echo $this->session->flashdata('sekolah'); ?>">
                          </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 form-control-label">KELAS</label>
                          <div class="col-sm-10">
                       <select name="kelas" required data-msg="Input kelas" class="form-control is-valid" aria-invalid="false">
                        <option value="">--Pilih Kelas--</option>
                        <option value="BELUM SEKOLAH" <?php echo ('BELUM SEKOLAH' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>BELUM SEKOLAH</option>
                        <option value="TK A"  <?php echo ('TK A' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>TK A</option>
                        <option value="TK B" <?php echo ('TK B' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>TK B</option>
                        <option value="1" <?php echo ('1' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>1</option>
                        <option value="2" <?php echo ('2' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>2</option>
                        <option value="3" <?php echo ('3' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>3</option>
                        <option value="4" <?php echo ('4' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>4</option>
                        <option value="5" <?php echo ('5' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>5</option>
                        <option value="6" <?php echo ('6' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>6</option>
                        <option value="7" <?php echo ('7' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>7</option>
                        <option value="8" <?php echo ('8' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>8</option>
                        <option value="9" <?php echo ('9' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>9</option>
                        <option value="10" <?php echo ('10' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>10</option>
                        <option value="11" <?php echo ('11' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>11</option>
                        <option value="12" <?php echo ('12' == $this->session->flashdata('kelas') ? ' selected="selected"' : ''); ?>>12</option>
                      </select>
                        </div>   
                        <!-- /.input group -->
                      </div>
                       <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">Nomor Telepon Anak (BISA DIISI NOMOR ORANG TUA)</label>
                          <div class="col-sm-10">
                          <input id="nohpanak" placeholder="+62123456789" name="nohpanak" type="text" class="form-control" value="<?php echo $this->session->flashdata('nohpanak'); ?>">
                          </div>
                      </div>
                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">INSTAGRAM</label>
                          <div class="col-sm-10">
                          <input id="ig" name="ig" placeholder="@namaig" value="<?php echo $this->session->flashdata('ig'); ?>" type="text" class="form-control">
                          </div>
                      </div>
                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">ALAMAT</label>
                          <div class="col-sm-10">
                            <textarea id="alamat" placeholder="alamat lengkap" name="alamat" class="form-control"><?php echo $this->session->flashdata('alamat'); ?></textarea>
                          </div>
                      </div>
                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">ANAK KE</label>
                          <div class="col-sm-10">
                          <input id="anake" placeholder="2,3,4,..." name="anake" type="text" class="form-control" value="<?php echo $this->session->flashdata('anake'); ?>">
                          </div>
                      </div>
                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">NAMA AYAH</label>
                          <div class="col-sm-10">
                          <input id="namaayah" placeholder="nama ayah" name="namaayah" type="text" class="form-control" value="<?php echo $this->session->flashdata('namaayah'); ?>">
                          </div>
                      </div>
                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">NAMA IBU</label>
                          <div class="col-sm-10">
                          <input id="namaibu" placeholder="nama ibu" name="namaibu" type="text" class="form-control" value="<?php echo $this->session->flashdata('namaibu'); ?>">
                          </div>
                      </div>
                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">ALAMAT ORANG TUA</label>
                          <div class="col-sm-10">
                            <textarea id="alamatortu" placeholder="alamat orang tua sekarang" name="alamatortu" class="form-control"><?php echo $this->session->flashdata('alamatortu'); ?></textarea>
                         
                          </div>
                      </div>
                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">NOMOR PONSEL AYAH</label>
                          <div class="col-sm-10">
                          <input id="nomorhpayah" placeholder="+621234567890" name="nomorhpayah" type="text" class="form-control" value="<?php echo $this->session->flashdata('nomorhpayah'); ?>">
                          </div>
                      </div>
                       <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">NOMOR PONSEL IBU</label>
                          <div class="col-sm-10">
                          <input id="nomorhpibu" placeholder="+621234567890" name="nomorhpibu" type="text" class="form-control" value="<?php echo $this->session->flashdata('nomorhpibu'); ?>">
                          </div>
                      </div>
                       <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">PEKERJAAN AYAH</label>
                          <div class="col-sm-10">
                          <input id="pekerjaanayah" placeholder="wiraswasta,karyawan,buruh,...." name="pekerjaanayah" type="text" class="form-control" value="<?php echo $this->session->flashdata('pekerjaanayah'); ?>">
                          </div>
                      </div>
                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">PEKERJAAN IBU</label>
                          <div class="col-sm-10">
                          <input id="pekerjaanibu" placeholder="wiraswasta,karyawan,buruh,...." name="pekerjaanibu" type="text" class="form-control" value="<?php echo $this->session->flashdata('pekerjaanibu'); ?>">
                          </div>
                      </div>
                      <div class="form-group row" style="">
                        <center><label class=" form-control-label">----- INFORMASI DARI ----</label></center>
                      
                      </div>
                      <?php 
                      $this->db->from('informan');
                      $query = $this->db->get();
                      $informasi = $query->result_array();
                      
                      ?>
                      <?php foreach ($informasi as $ro) { ?>
                      <div class="form-group">
                        <div class="col-sm-10 form-control-label">
                      <div class="mt-1" style="background: none; border:none;">
                        <div class="icheck-success d-inline">
                          <input type="checkbox" class="list_menu" id="<?php echo $ro['id_informasi']; ?>" name="informasidari[]" value="<?php echo $ro['id_informasi']; ?>" <?php if ($this->session->flashdata('informasidari') != null) {foreach($this->session->flashdata('informasidari') AS $key => $val) { echo ($ro['id_informasi'] == $val  ? 'checked' : ''); } } ?>>
                          <label for="<?php echo $ro['id_informasi']; ?>"><?php echo $ro['informasi']; ?></label>
                        </div>
                      </div>
                      </div>
                      </div>
                    <?php } ?>

                    <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">HARI DAN SESI JADWAL PROGRAM 1</label>
                          <div class="col-sm-10">
                          <input id="hspr1" name="hspr1" placeholder="contoh: Hari kamis,jam 7.00 AM,dst" type="text" class="form-control" value="<?php echo $this->session->flashdata('hspr1'); ?>">
                          </div>
                      </div>

                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">HARI DAN SESI JADWAL PROGRAM 2</label>
                          <div class="col-sm-10">
                          <input id="hspr2" placeholder="contoh: Hari kamis,jam 7.00 AM,dst" name="hspr2" type="text" class="form-control" value="<?php echo $this->session->flashdata('hspr2'); ?>">
                          </div>
                      </div>

                      <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">HARI DAN SESI JADWAL PROGRAM 3</label>
                          <div class="col-sm-10">
                          <input id="hspr3" placeholder="contoh: Hari kamis,jam 7.00 AM,dst" name="hspr3" type="text" class="form-control" value="<?php echo $this->session->flashdata('hspr3'); ?>">
                          </div>
                      </div>

                     <div class="form-group row" style="">
                        <label class="col-sm-2 form-control-label">Kode REFERAL(JIKA MEMILIKI MAKA BIAYA PENDAFTARAN HANYA 50.000 DARI 250.000)</label>
                          <div class="col-sm-10">
                          <input id="referalid" placeholder="Kode Referal" name="referalid" type="text" class="form-control" value="<?php echo $this->session->flashdata('referalid'); ?>">
                          </div>
                      </div>
                       <button class="btn btn-primary tes" onclick="stepper.previous()">Kembali</button>
                       <button class="btn btn-primary tes" onclick="stepper.next()">Selanjutnya</button>
                    </div>

                    <div id="login-part" class="content" role="tabpanel" aria-labelledby="login-part-trigger">

                      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

                       <div id="message"></div>
                        <div class="input-group mb-3">
                          <input type="email" id="email" required data-msg="Input Email" name="email" class="form-control" placeholder="Email" value="<?php echo $this->session->flashdata('email'); ?>">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-envelope"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" id="username" required data-msg="Input Username" name="username" class="form-control" placeholder="Username" value="<?php echo $this->session->flashdata('username'); ?>">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-envelope"></span>
                            </div>
                          </div>
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
                        <br>
                        <br>
                      <a style="float:right;" href="<?php echo base_url('member/login') ?>" class="text-center">Saya Sudah Mempunyai Akun</a>
                      <button class="btn btn-primary tes" onclick="stepper.previous()">Kembali</button>
                      
                    </div>
                  </form>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
               Harap isi data dengan benar dan lengkap untuk pendataan
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
  </div>
</section>