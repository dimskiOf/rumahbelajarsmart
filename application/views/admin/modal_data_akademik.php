  <div class="modal fade" id="modal-view-detailnilai">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Detail Laporan Nilai</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <button id="addnilai" class="btn btn-success" data-toggle="modal" data-target="#inputnilai" style="float:right;"><i class="fas fa-plus">Tambah Nilai</i></button>
                 <br>
              <table id="nilaibyid" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Matapelajaran</th>
                    <th>Nilai</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="nilaitempel">
                  
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

  <div class="modal fade" id="inputnilai">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Input Nilai</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="inputnilaiform">
              <div class="form-group row">
                  <div class="col-sm-10">
                  <input id="userid" readonly="" hidden="" name="userid" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Nama MAPEL</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="mapelid">
                    <?php foreach ($mapel as $row) { ?>
                    <option value="<?php echo $row['id_pengelompokan']; ?>"><?php echo $row['nama_mapel']; ?></option>
                  <?php } ?>
                  </select>
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Nilai</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="text" name="nilaiinput" id="nilaiinput">
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
              <button id="submitinputnilai" class="btn btn-outline-dark">Input Nilai</button>
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