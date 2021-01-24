      <div class="modal fade" id="modal-view-status">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Cek Tagihan Aktif</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered table-striped">
                <tbody id="datatagihan">
               
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

      <div class="modal fade" id="modal-buat-tagihan">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Kirim Tagihan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="kirimtagihanform">
              <div id="fotomember"></div>
              <br>
              <input id="idtagihanuser" name="idtagihanuser" type="hidden" class="form-control">
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Nama</label>
                  <div class="col-sm-10">
                  <input id="orgtagihan" readonly="" name="orgtagihan" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea id="alamattagihan" name="alamattagihan" readonly="" class="form-control"></textarea>
                  </div>
              </div>
              <div class="form-group row" style="">
                  <center><label class=" form-control-label">----- PAKET YANG DIAMBIL----</label></center>
                      
              </div>
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
                    <input type="checkbox" class="list_paket" id="paket<?php echo $row['id_paket']; ?>" name="program[]" value="<?php echo $row['id_paket']; ?>" readonly disabled>
                    <label for="paket<?php echo $row['id_paket']; ?>"><?php echo $row['nama_paket']; ?></label>
                  </div>
                </div>
                </div>
                </div>
              <?php } ?>
              <div class="form-group row">
                 <label class="col-sm-2 form-control-label">Tagihan</label>
                  <div class="col-sm-10">
                  <input id="tagihan" value="0" name="tagihan" type="text" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                 <label class="col-sm-2 form-control-label">Kode Referal</label>
                 <div class="col-sm-10">
                  <input id="referal" readonly="" name="referal" type="text" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                 <label class="col-sm-2 form-control-label">Potongan</label>
                 <div class="col-sm-10">
                  <input id="potongan" readonly="" name="potongan" type="text" value="0" class="form-control">
                </div>
              </div>
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
              <button id="kirimtagihan" class="btn btn-outline-dark" >Kirim Tagihan</button>
            </div>
          </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modal-get-konfirmasi">
        <div class="modal-dialog modal-lg">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Informasi Konfirmasi Tagihan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="overflow-y: scroll;">
              <div class="form-group row">
                 <label class="col-sm-2 form-control-label">Tagihan - Potongan</label>
                  <div class="col-sm-10">
                  <input id="tagihan_potongan" value="0" readonly="" name="tagihan_potongan" type="text" class="form-control">
                </div>
              </div>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th>Pembayaran</th>
                  <th>Status Pembayaran</th>
                  <th>Jumlah Pembayaran</th>
                  <th>Bukti Pembayaran</th>
                  <th>Tanggal Pembayaran</th>
                  </tr>
                </thead>
                <tbody id="tampilbukti">
                  
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

       <div class="modal fade" id="modal-konfirmasi">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Konfirmasi Tagihan pembayaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="konfirmasitagihanform">
              <input id="uid" name="uid" type="hidden" class="form-control">
              <input id="namas" name="namas" type="hidden" class="form-control">
              <input id="kd_inv" name="kd_inv" type="hidden" class="form-control">
               <input id="kd_pem" name="kd_pem" type="hidden" class="form-control">
               <input id="kalkulasi" name="kalkulasi" type="hidden" class="form-control">
               <div class="form-group row">
                 <label class="col-sm-2 form-control-label">Status Konfirmasi</label>
                 <div class="col-sm-10">
                  <select class="form-control" id="statuspem" name="statuspem">
                    <option value="Terbayar">
                      Terbayar
                    </option>
                    <option value="Gagal">
                      Gagal
                    </option>
                  </select>
                </div>
              </div>
              <div class="form-group row"><label class="col-sm-2 form-control-label">Nominal di Foto</label><div class="col-sm-10">
                <input id="jml_pem"  name="jml_pem" type="text" placeholder="silahkan input sesuai bukti foto" class="form-control">
                </div>
              </div>
              
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Batalkan</button>
              <button id="konfirmtagihanmember" class="btn btn-outline-dark" >Konfirmasi Tagihan</button>
            </div>
          </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->     

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
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