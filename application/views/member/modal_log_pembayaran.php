    <div class="modal fade" id="modal-pembayaran-cek">
        <div class="modal-dialog modal-lg">
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">Informasi Pembayaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="overflow-y: scroll;">
              <table id="informasi_pembayaran" class="table table-bordered table-striped">
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