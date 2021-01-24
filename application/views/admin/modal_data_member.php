

      <div class="modal fade" id="modal-edit-member">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Member</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="fotomember"></div>
              <form class="form-horizontal" id="updatingmember">
                 <div class="form-group row">
                      <div class="col-sm-10">
                        <input id="id" name="id" type="hidden" class="form-control" required="">
                      </div>
                      <div class="col-sm-10">
                        <input id="idus" name="usr" type="hidden" class="form-control" required="">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Nama</label>
                      <div class="col-sm-10">
                        <input id="nama_member" name="nama_member" type="text" readonly="" class="form-control" required="">
                      </div>
                    </div>
                  <center><a class="dropdown-item" onclick=appendpaketmember(); href="javascript:;">Tambah Paket</a></center>
                  <br>
                  <div id="tambahpaket"></div>
                  <br>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>
                          Nama Paket
                        </th>
                        <th>
                          Gambar Paket
                        </th>
                        <th>
                          Harga Paket
                        </th>
                        <th>
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody id="datapaket">
                      
                    </tbody>
                  </table>

            <div class="modal-footer justify-content-between">
              <button id="clear-updating-data-member" type="submit" class="btn btn-outline-dark" data-dismiss="modal">Batalkan</button>
              <button id="updating-data-member" type="submit" class="btn btn-outline-dark">Simpan Perubahan</button>
            </div>
            </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modal-view-member">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Data Member</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="fotomemberview"></div>
                  <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Nama</label>
                      <div class="col-sm-10">
                        <input id="nama_memberview" name="nama_memberview" type="text" readonly="" class="form-control">
                      </div>
                  </div>
                   <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea readonly="" class="form-control" name="alamat_memberview" id="alamat_memberview"></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 form-control-label">jenis kelamin</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="jenis_kelaminview" id="jenis_kelaminview">
                          <option disabled="" value="Pria">Pria</option>
                          <option disabled="" value="Wanita">Wanita</option>
                        </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Email</label>
                      <div class="col-sm-10">
                        <input id="email_memberview" type="email" name="email_memberview" readonly="" type class="form-control">
                      </div>
                  </div>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>
                          Nama Paket
                        </th>
                        <th>
                          Gambar Paket
                        </th>
                        <th>
                          Harga Paket
                        </th>
                      </tr>
                    </thead>
                    <tbody id="datapaketmember">
                      
                    </tbody>
                  </table>

            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
            </div>
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