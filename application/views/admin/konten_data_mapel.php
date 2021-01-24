<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mata Pelajaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengelolaan Mata Pelajaran</li>
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
                <h3 class="card-title">Data Mapel & Pengelompokan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 
                 <!-- Content Wrapper. Contains page content -->
                 <h2><font color="brown">Tabel Mata Pelajaran</font></h2>
                 <br>
                 <button id="addmapel" data-toggle="modal" data-target="#modal-buat-mapel" class="btn btn-success" style="float:right;"><i class="fas fa-plus">Buat MAPEL</i></button>
                 <br>
                <table id="data_mapel" name="data_mapel" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama MAPEL</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama MAPEL</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                </tfoot>
                </table>

                <br>
                <h2><font color="brown">Tabel Pengelompokan MAPEL</font></h2>
                 <br>
                <table id="data_pengelompokan" name="data_pengelompokan" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Status</th>
                      <th>Gambar</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Status</th>
                      <th>Gambar</th>
                      <th>Action</th>
                    </tr>
                </tfoot>
                </table>
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
  <!-- /.content-wrapper -->