<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pembayaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pembayaran Paket</li>
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
                <h3 class="card-title">Pembayaran</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 
                 <!-- Content Wrapper. Contains page content -->
                 <h2><font color="blue">Data Pembayaran</font></h2>
                 <br>
                 <div class="row">
                <table style="width: 200px;text-align: center;" id="data_tagihan" name="data_tagihan" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th colspan="5">Kewajiban</th>
                    </tr>
                    <tr>
                      <th>keterangan</th>
                      <th>Nilai</th>
                    </tr>
                  </thead>
                  <tbody id="tagihan">
                  </tbody>
                </table>
                &nbsp;
                &nbsp;
                <table style="width: 200px;text-align: center;" id="data_pembayaran" name="data_pembayaran" class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th colspan="5">Pembayaran</th>
                    </tr>
                    <tr>
                      <th>No pem</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th>Nilai</th>
                    </tr>
                  </thead>
                  <tbody id="pembayaran">
                  </tbody>
                </table>
                &nbsp;
                &nbsp;
                <table style="width: 200px;text-align: center;" id="data_rekapitulasi" name="data_rekapitulasi" class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th colspan="5">Rekapitulasi</th>
                    </tr>
                    <tr>
                      <th>kewajiban</th>
                      <th>pembayaran</th>
                      <th>potongan</th>
                    </tr>
                  </thead>
                  <tbody id="rekapitulasi">
                  </tbody>
                </table>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                Pembayaran
                            </h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            Silahkan Lakukan Pembayaran dengan cara transfer melalui ATM Lalu kirim bukti pembayaran ke tombol berikut <button id="bayar" data-toggle="modal" data-target="#modal-pembayaran" class="btn btn-sm btn-info text-white">Bayar</button>
                        </div>
                    </div>
                </div>
          <!--  <table style="border:none;" class="table table-simai-nu table-striped-nu" width="940px">
            <thead>
            <tr>
                <th colspan="2">KEWAJIBAN</th>
                <th style="background-color: white; border:none;"></th>
                <th colspan="3">PEMBAYARAN</th>
                <th style="background-color: white; border:none;"></th>
                <th colspan="2">REKAPITULASI</th>
            </tr>
            <tr>
                <th width="200px">Keterangan</th>
                <th width="90px">Nilai (Rp)</th>
                <th style="background-color: white; border:none;" width="10px"></th>
                <th width="100px">Nomor Pem</th>
                <th width="90px">Tanggal</th>
                <th width="90px">Nilai (Rp)</th>
                <th style="background-color: white; border:none;" width="10px"></th>
                <th width="200px">Keterangan</th>
                <th width="90px">Nilai (Rp)</th>
            </tr>
            </thead>
            <tbody id="bodyKeuangan">
              <tr>
                <td>Paket a</td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;"></td>
                <td>Kewajiban</td>
                <td align="right"><b></b></td>
              </tr>
              <tr>
                <td>Paket b</td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;"></td>
                <td>Potongan</td>
                <td align="right"><b></b></td>
              </tr>
              <tr>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td><div style="font-weight:bold;" align="right">TOTAL KEWAJIBAN</div></td>
                <td align="right"><b></b></td>
              </tr>
              <tr>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;"></td>
                <td></td>
                <td align="right"></td>
              </tr>
              <tr>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;"></td>
                <td>Pembayaran</td>
                <td align="right"><b></b></td>
              </tr>
              <tr>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;"></td>
                <td>Lebih Bayar Bulan Lalu</td>
                <td align="right"><b></b></td>
              </tr>
              <tr>
                <td><div style="font-weight:bold;" align="right"></div></td>
                <td align="right"><b></b></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td><div style="font-weight:bold;" align="right">TOTAL PEMBAYARAN</div></td>
                <td align="right"><b></b></td>
              </tr>
              <tr>
                <td colspan="2" style="color: rgb(0, 0, 255); font-weight: bold; font-style: italic;">DENDA</td>
                <td style="background-color: white; border:none;"></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;"></td>
                <td></td>
                <td align="right"></td>
              </tr>
              <tr>
                <td>Terlambat Pembayaran</td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td align="right"></td>
              </tr>
              <tr>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td><div style="font-weight:bold;" align="center">DEPOSIT</div></td>
                <td align="right"><b></b></td>
              </tr>
              <tr>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td align="right"></td>
              </tr>
              <tr>
                <td colspan="2" style="color: rgb(0, 0, 255); font-weight: bold; font-style: italic;">BIAYA ADMINISTRASI</td>
                <td style="background-color: white; border:none;"></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;"></td>
                <td></td>
                <td align="right"></td>
              </tr>
              <tr>
                <td>Angsuran</td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td align="right"></td>
              </tr>
              <tr>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td></td>
                <td align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td></td>
                <td align="right"></td>
              </tr>
              <tr>
                <td style="font-weight:bold;" align="right">TOTAL KEWAJIBAN</td>
                <td style="font-weight:bold;" align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td style="font-weight:bold;" colspan="2" align="right">TOTAL PEMBAYARAN</td>
                <td style="font-weight:bold;" align="right"></td>
                <td style="background-color: white; border:none;" ></td>
                <td><b>Pembayaran Lain-lain</b></td>
                <td align="right"><b></b></td>
              </tr>
            </tbody>
        </table>
                  -->

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