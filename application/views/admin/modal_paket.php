  <div class="modal fade" id="modal-view-paket">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Detail Paket</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="fotopaket"></div>
              <br>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Nama Paket</label>
                  <div class="col-sm-10">
                  <input id="paket_nama" readonly="" name="paket_nama" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Status Paket</label>
                  <div class="col-sm-10">
                  <select name="status_paket" id="status_paket" class="form-control">
                    <option disabled="" value="Aktif">
                      Aktif
                    </option>
                    <option disabled="" value="Tidak">
                      Tidak
                    </option>
                  </select>
              </div>
            </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Harga Paket</label>
                  <div class="col-sm-10">
                  <input id="paket_harga" readonly="" name="paket_harga" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Rincian Paket</label>
                  <div class="col-sm-10">
                  <textarea class="form-control" name="rincian_paket" id="rincian_paket" readonly=""></textarea>
              </div>
            </div>
             <div class="form-group row">
                <label class="col-sm-2 form-control-label">Kurikulum Paket</label>
                  <div class="col-sm-10">
                  <textarea class="form-control" name="kurikulum_paket" id="kurikulum_paket" readonly=""></textarea>
              </div>
            </div>
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


      <div class="modal fade" id="modal-edit-paket">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Edit Paket</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="editpaket">
              <div id="fotopaket1"></div>
              <center><a href="#" id="ganti_fp" class="ganti_fp"><span class="badge badge-info">Ganti Foto</span></a></center>
              <br>
              <input id="idp" name="idp" type="hidden" class="form-control">
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Nama Paket</label>
                  <div class="col-sm-10">
                  <input id="paket_nama1" name="paket_nama1" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Status Paket</label>
                  <div class="col-sm-10">
                  <select name="status_paket1" id="status_paket1" class="form-control">
                    <option value="Aktif">
                      Aktif
                    </option>
                    <option value="Tidak">
                      Tidak
                    </option>
                  </select>
              </div>
            </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Harga Paket</label>
                  <div class="col-sm-10">
                  <input id="paket_harga1" name="paket_harga1" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Rincian Paket</label>
                  <div class="col-sm-10">
                  <textarea class="form-control" name="rincian_paket1" id="rincian_paket1"></textarea>
              </div>
            </div>
             <div class="form-group row">
                <label class="col-sm-2 form-control-label">Kurikulum Paket</label>
                  <div class="col-sm-10">
                  <textarea class="form-control" name="kurikulum_paket1" id="kurikulum_paket1"></textarea>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
              <button id="submiteditpaket" class="btn btn-outline-dark">Simpan Perubahan</button>
            </div>
            </form>
            </div>
          </div>
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  

     <div class="modal fade" id="modal-buat-paket">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Buat Paket</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="buatpaket">
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Nama Paket</label>
                  <div class="col-sm-10">
                  <input id="paket_nama2" name="paket_nama2" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Masukan Paket (.jpg.png.jpeg)</label>
                      <div class="col-sm-10">
                    <input id="fotopaketname2" name="fotopaketname2" class="file" type="file">
                </div>
            </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Status Paket</label>
                  <div class="col-sm-10">
                  <select name="status_paket2" id="status_paket2" class="form-control">
                    <option value="Aktif">
                      Aktif
                    </option>
                    <option value="Tidak">
                      Tidak
                    </option>
                  </select>
              </div>
            </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Harga Paket</label>
                  <div class="col-sm-10">
                  <input id="paket_harga2" name="paket_harga2" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Rincian Paket</label>
                  <div class="col-sm-10">
                  <textarea class="form-control" name="rincian_paket2" id="rincian_paket2"></textarea>
              </div>
            </div>
             <div class="form-group row">
                <label class="col-sm-2 form-control-label">Kurikulum Paket</label>
                  <div class="col-sm-10">
                  <textarea class="form-control" name="kurikulum_paket2" id="kurikulum_paket2"></textarea>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
              <button id="submitbuatpaket" class="btn btn-outline-dark">Simpan Paket</button>
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
  <div class="modal fade" id="modal-edit-foto-paket" role="dialog">
   <div class="subtab_left">
        <div class="modal-dialog modal-dialog-centered">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            
            <h4 class="modal-title">Edit Foto Paket  </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form class="form-horizontal" id="fotopaketupdate">
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-10">
                <input id="id_paket" name="id_paket" type="hidden" class="form-control" required="" readonly="">
              </div>
           </div>
           <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Masukan Paket (.jpg.png)</label>
                      <div class="col-sm-10">
                    <input id="fotopaketname" name="fotopaketname" class="file" type="file">
                </div>
            </div>
          </div>
      <div class="modal-footer">
            <button type="button" id="updatingpaketfoto" class="btn btn-primary" data-dismiss="modal">Upload foto paket</button>
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

  