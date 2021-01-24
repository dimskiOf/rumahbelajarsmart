     <div class="modal fade" id="modal-buat-mapel">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Buat Mata Pelajaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="buatmapel">
             <div class="form-group row">
                <label class="col-sm-2 form-control-label">Nama Mata Pelajaran</label>
                  <div class="col-sm-10">
                  <input id="namamapel" placeholder="Misal Bhs.Indonesia., dll"  name="namamapel" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Status</label>
                <div class="col-sm-10">
                <select name="statusmapel" class="form-control">
                  <option value="Aktif">Aktif</option>
                  <option value="Tidak">Tidak</option>
                </select>  
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
              <button id="submitbuatmapel" class="btn btn-outline-dark">Simpan MAPEL</button>
            </div>
            </form>
            </div>
          </div>
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

     <div class="modal fade" id="modal-edit-mapel">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Edit Mata Pelajaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="editmapel">
                <div class="form-group row">
                  <div class="col-sm-10">
                  <input id="id_mapel" name="id_mapel" type="text" class="form-control" readonly="" hidden="">
                  </div>
              </div>
             <div class="form-group row">
                <label class="col-sm-2 form-control-label">Nama Mata Pelajaran</label>
                  <div class="col-sm-10">
                  <input id="editnamamapel" placeholder="Misal Bhs.Indonesia., dll"  name="editnamamapel" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Status</label>
                <div class="col-sm-10">
                <select id="editstatusmapel" name="editstatusmapel" class="form-control">
                  <option value="Aktif">Aktif</option>
                  <option value="Tidak">Tidak</option>
                </select>  
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
              <button id="editsubmitbuatmapel" class="btn btn-outline-dark">Simpan Perubahan</button>
            </div>
            </form>
            </div>
          </div>
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

     <div class="modal fade" id="modal-view-mapelonpaket">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Kelola Pengelompokan Mata Pelajaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <button id="addmapelonpaket" class="btn btn-success" data-toggle="modal" data-target="#inputmapelonpaket" style="float:right;"><i class="fas fa-plus">Tambah MAPEL</i></button>
                 <br>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Matapelajaran</th>
                    <th>status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="mapeltempel">
                  
                </tbody>
              </table>
            </div>
             <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
            </div>
          </div>
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="inputmapelonpaket">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Masukan MAPEL</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="inputmapelpaket">
              <div class="form-group row">
                  <div class="col-sm-10">
                  <input id="idpaketurus" readonly="" hidden="" name="idpaketurus" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Nama MAPEL</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="mapelid">
                    <?php foreach ($mapel as $row) { ?>
                    <option value="<?php echo $row['id_mapel']; ?>"><?php echo $row['nama_mapel']; ?></option>
                  <?php } ?>
                  </select>
                  </div>
              </div>
             
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
              <button id="submitinputmapelpaket" class="btn btn-outline-dark">Input Mapel</button>
            </div>
            </form>
            </div>
          </div>
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

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