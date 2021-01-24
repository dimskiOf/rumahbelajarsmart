<div class="modal fade" id="modal-pembayaran">
        <div class="modal-dialog">
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">Upload Bukti Pembayaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
        <form class="form-horizontal" id="kirimpembayaran">
              <div class="form-group row">
                  <div class="col-sm-10">
                  <input id="idinv" readonly="" hidden="" name="idinv" type="text" class="form-control">
                  <input id="nm" readonly="" hidden="" name="nm" type="text" class="form-control">
                  <input type="hidden" readonly="" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                  </div>
              </div>
              <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Masukan Foto (.jpg,.png,.jpeg)</label>
                      <div class="col-sm-10">
                    <input id="fotobukti" name="fotobukti" class="file" type="file">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
              <button id="submitpembayaran" class="btn btn-outline-dark">Kirim</button>
            </div>
            </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->