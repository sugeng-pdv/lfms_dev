<div class="container row mt-0 mb-1">
    <div class="col-sm-8 alert-text">
        <!--<label class="font-weight-boldest text-success h2"> Permohonan Pembayaran Lahan PSN </label>-->
    </div>
    <div class="col-sm-4 text-right">
        <!--<button href="#" class="btn btn-success font-weight-bold btn-pill btn-lg" data-toggle="modal" id="btnAddPsn"><i class="fas fa-plus-circle"></i>INPUT PSN</button>-->
        <button class="btn btn-success font-weight-bold btn-pill" id="btnUndo"><i class="fas fa-undo"></i>Kembali</button>
    </div>
    <div class="mt-5" id="infoDataKosong" style="display:none">
        <p class="font-weight-boldest">
            Data Tidak Ada
        </p>
    </div>
</div>

<div class="container">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="font-size-lg text-auto font-weight-bold">
                SPP terlampir dibawah diapprove oleh Direktur Utama, Silahkan melakukan pembayaran atas SPP yang telah diterima & disetujui pada :
            </div>
            <br><br>
            <div class="table-responsive border">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th scope="row">Nomor SPP</th>
                            <td><label id="spp_num">TN. 1245</label></td>

                        </tr>
                        <tr>
                            <th scope="row">Nomor Surat Pembayaran</th>
                            <td><label id="spp_letter_number">TN. 1245</label></td>
                        </tr>
                        <tr>
                            <th scope="row">Nomor total yang harus di bayar</th>
                            <td><label id="nominal">Rp. 283.778.000,00</label></td>
                        </tr>
                        <tr>
                            <th scope="row">Ke No. Rekening</th>
                            <td><label id="rek_num">BCA 12344577778 (a.n Nana S)</label></td>
                        </tr>
                        <tr>
                            <th scope="row">Nama Rekening</th>
                            <td><label id="business_entity">PT. SSN ABADI</label></td>
                        </tr>
                        <tr>
                            <th scope="row">Berita</th>
                            <td><label id="info">Pembayaran untuk pengadaan Tanah PSN</label></td>
                        </tr>
                        <tr>
                            <th scope="row">Waktu transfer</th>
                            <td><label id="deadlines"><input type="date" class="form-control data-spp" id="date_transfer" name="date_transfer" /></label></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="font-weight-bold">Surat Instruksi Pembayaran</td>
                            <td>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <button href="#" class="btn btn-success font-weight-bold btn-pill btn-md mr-4" data-toggle="modal">
                                            <i class="far fa-file-alt"></i>Lihat File
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="hidden" class="form-control data-spp" id="id_doc_si" name="id_doc_si" readonly>
                                        <label for="doc_si" class="btn btn-outline-success btn-sm mr-3 data-dokumen" id="choose-file-label">UPLOAD DOKUMEN</label>
                                        <input type="file" class="form-control" id="doc_si" name="doc_si" accept="application/pdf" style="display:none">
                                    </div>
                                    
                                </div>
                                
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Dokumen SP2</th>
                            <td> <button href="#" class="btn btn-success font-weight-bold btn-pill btn-md mr-5" data-toggle="modal">
                                    <i class="far fa-file-alt"></i>Lihat File
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div>
                    <!--begin::Wizard 5-->
                    <div class="wizard wizard-5 d-flex flex-column flex-lg-row flex-row-fluid" id="kt_wizard">
                        <!--begin::Aside-->
                        <div class="wizard-aside bg-white d-flex flex-column flex-row-auto">
                            <!--begin::Aside Top-->
                            <div class="d-flex flex-column-fluid flex-columnlight-primary">
                                <!--begin: Wizard Nav-->
                                <div class="wizard-nav d-flex d-flex justify-content-center">
                                    <!--begin::Wizard Steps-->
                                    <div class="wizard-steps">
                                        <!--begin::Wizard Step 1 Nav-->
                                        <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                            <div class="wizard-wrapper">
                                                <div class="wizard-icon">
                                                    <i class="wizard-check ki ki-check"></i>
                                                    <span class="wizard-number">1</span>
                                                </div>
                                                <div class="wizard-label">
                                                    <h3 class="wizard-title">Nomor Kuitansi</h3>
                                                    <div class="wizard-desc">
                                                        <input type="text" class="form-control data-spp" placeholder="Tulis Nomor Kuitansi" name="receipt_num" id="receipt_num" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Wizard Step 1 Nav-->
                                        <!--begin::Wizard Step 2 Nav-->
                                        <div class="wizard-step" data-wizard-type="step">
                                            <div class="wizard-wrapper">
                                                <div class="wizard-icon">
                                                    <i class="wizard-check ki ki-check"></i>
                                                    <span class="wizard-number">2</span>
                                                </div>
                                                <div class="wizard-label">
                                                    <h3 class="wizard-title">Upload Bukti Transfer</h3>
                                                    <div class="wizard-desc">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 file-bt">
                                                            <button href="#" class="btn btn-success font-weight-bold btn-sm mr-4" data-toggle="modal">
                                                                <i class="far fa-file-alt"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="hidden" class="form-control data-spp" id="id_doc_bt" name="id_doc_bt" readonly>
                                                            <label for="doc_bt" class="btn btn-outline-success btn-sm  data-spp" id="choose-file-label">UPLOAD FILE</label>
                                                            <input type="file" class="form-control" id="doc_bt" name="doc_bt" accept="application/pdf" style="display:none">
                                                        </div>
                                                    </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Wizard Step 2 Nav-->
                                        <!--begin::Wizard Step 3 Nav-->
                                        <div class="wizard-step" data-wizard-type="step">
                                            <div class="wizard-wrapper">
                                                <div class="wizard-icon">
                                                    <i class="wizard-check ki ki-check"></i>
                                                    <span class="wizard-number">3</span>
                                                </div>
                                                <div class="wizard-label">
                                                    <div class="wizard-desc">Klik button ini apabila anda sudah melakukan transfer dan mengupload buktinya</div>
                                                    <div class="wizard-desc mt-3">
                                                        <button  class="btn btn-success font-weight-bold btn-pill btn-md font-weight-boldest" id="btnSaveSpp">SPP SUDAH TERBAYAR</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Wizard Step 3 Nav-->
                                    </div>
                                    <!--end::Wizard Steps-->
                                </div>
                                <!--end: Wizard Nav-->
                            </div>
                            <!--end::Aside Top-->
                        </div>
                        <!--begin::Aside-->
                        <!--begin::Content-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wizard 5-->
            </div>
            <br><br>
            <hr>
            <div class="card-title mt-5">
                <h6 class="card-label">Rincian SPP Beserta bidangnya</h6>
            </div>
            <div class="table-responsive table-hover text-nowarp">
                <table class="table table-bordered text-center table-fixed" id="tableSummarySpp">
                    <thead class="btn-lman">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Jenis Bidang</th>
                            <th scope="col">Harga/Nilai Tanah</th>
                            <th scope="col">Hasil Verifikasi Dokumen</th>
                            <th scope="col">Catatan Tertolak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Non Bidang</td>
                            <td class="text-left">Rp. 123.678.900,00</td>
                            <td>Diterima</td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Non Bidang</td>
                            <td class="text-left">Rp. 123.678.900,00</td>
                            <td>Diterima</td>
                            <td>---</td>
                        </tr>
                        <tr class="btn-lman font-weight-boldest">
                            <td colspan="2">Total Nilai</td>
                            <td class="text-left" colspan="3">Rp. 283.778.000,00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>







<?php if (isset($js)) {
    foreach ($js as $js) {
?>
        <script type="text/javascript" src="<?php echo $this->config->item('static_file_url') . PLATFORM_PATH . $js;
                                            ?>"></script>
<?php
}
}
?>
