<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Notifikasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manajemen Data Notifikasi</li>
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

              <!-- notif add -->
              <div class="card" id="form-berita">

                <div class="card-header d-flex align-items-center">
                  <h4>Tambah Notifikasi</h4>
                </div>
                
                <div class="card-body">
                  <form class="form-horizontal" id="prosesing_notif">
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Judul Notifikasi</label>
                      <div class="col-sm-10">
                        <input id="jdl-notif" name="judul-name" type="text" class="form-control" required="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Jenis Notifikasi</label>
                      <div class="col-sm-10">
                         <select id="add-jenis" name="add-jenis-name" class="form-control" data-placeholder="Select a Jenis" style="width: 100%">
                          <option value="1">PEMBARUAN</option>
                          <option value="2">PEMBAYARAN</option>
                          <option value="3">PENGUMUMAN</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Kirim Ke:</label>
                      <div class="col-sm-10 form-control-label">
                      <div class="mt-1" style="background: none; border:none;">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" class="list_menu" id="semua" name="semua" value="pemilihan">
                      <input id='dummysemuauser' type='hidden' value='pemilihan' name='semua'>
                      <label for="semua">semua User</label>
                    </div>
                  </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Ditentukan :</label>
                      <div class="col-sm-10">  
                         <select id="add-person-to" name="add-person-name[]" multiple="multiple" class="form-control" data-placeholder="Username atau nama" style="width: 100%">
                          <option value="disabled" disabled>MEMBER/SUPERADMIN</option>

                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Isi Notif</label>
                      <div class="col-sm-10">
                        <textarea id="goreadme" name="kontens" class="textarea" placeholder="Place some text here"></textarea>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <button id="berhenti" onclick="inputnotif();" type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
          
        <!-- end notif -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
   
  </div>
  <!-- /.content-wrapper -->