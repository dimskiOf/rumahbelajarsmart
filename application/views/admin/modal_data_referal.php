  <div class="modal fade" id="modal-view-referal">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Detail Referal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Kode Referal</label>
                  <div class="col-sm-10">
                  <input id="kodereferal" readonly="" name="kodereferal" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Jumlah Referal</label>
                  <div class="col-sm-10">
                  <input id="jmlreferal" readonly="" name="jmlreferal" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Potongan</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="text" name="potonganreferal" id="potonganreferal" readonly="">
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


      <div class="modal fade" id="modal-edit-referal">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Edit Referal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="editreferal">
              <div class="form-group row">
                  <div class="col-sm-10">
                  <input id="kodereferal1" readonly="" hidden="" name="kodereferal1" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Jumlah Referal</label>
                  <div class="col-sm-10">
                  <input id="jmlreferal1" name="jmlreferal1" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Potongan</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="text" name="potonganreferal1" id="potonganreferal1">
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
              <button id="submiteditreferal" class="btn btn-outline-dark">Simpan Perubahan</button>
            </div>
            </form>
            </div>
          </div>
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  

     <div class="modal fade" id="modal-buat-referal">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Buat Referal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="buatreferal">
             <div class="form-group row">
                <label class="col-sm-2 form-control-label">Kode Referal</label>
                  <div class="col-sm-10">
                  <input id="kodereferal2" placeholder="8 kombinasi angka dan huruf"  name="kodereferal2" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Jumlah Referal</label>
                  <div class="col-sm-10">
                  <input id="jmlreferal2" placeholder="jumlah kode" name="jmlreferal2" type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Potongan</label>
                  <div class="col-sm-10">
                  <input class="form-control" placeholder="potongan rupiah" type="text" name="potonganreferal2" id="potonganreferal2" >
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button  class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
              <button id="submitbuatreferal" class="btn btn-outline-dark">Simpan Referal</button>
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

  