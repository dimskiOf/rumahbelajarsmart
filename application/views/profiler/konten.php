  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Akun</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Akun Profil</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Akun</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 
                <center><div id="foto1" class="msg-profile"></div>
                  <a href="#" class="ganti_foto"><span class="badge badge-info">Ganti Foto</span></a></center>
                  <form class="form-horizontal" id="updatingprofiler">
                     <div class="form-group row">
                          <div class="col-sm-10">
                            <input id="id_users" name="id_users" type="hidden" class="form-control" required="" readonly="">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Nama</label>
                          <div class="col-sm-10">
                            <input id="edt-nama-usr" name="nama-usr" type="text" class="form-control" required="">
                          </div>
                        </div>
                      <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Username</label>
                          <div class="col-sm-10">
                            <input id="edt-username-usr" name="username-usr" type="text" class="form-control" readonly="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Email</label>
                          <div class="col-sm-10">
                            <input id="edt-email-usr" name="email-usr" type="Email" class="form-control" readonly="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Password Baru</label>
                          <div class="col-sm-10">
                            <input id="edt-password-usr" name="password" type="Password" class="form-control" required="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Ulangi Password</label>
                          <div class="col-sm-10">
                            <input id="edt-password-usr2" name="password2" type="Password" class="form-control" required="">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Jenis Kelamin</label>
                          <div class="col-sm-10">
                             <select id="edt-klmn-usr" name="klmn-usr" class="form-control" style="width: 100%">
                              <option>Pria</option>
                              <option>Wanita</option>
                            </select>
                          </div>
                        </div>
                      <button id="updating-data-user" type="submit" class="btn btn-primary">Simpan</button>
      
                </form>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
   
  </div>
  <!-- /.content-wrapper -->  <!-- /.content-wrapper -->