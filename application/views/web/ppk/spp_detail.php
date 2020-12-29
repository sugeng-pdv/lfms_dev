<div class="container mt-0">
    <div class="alert-text">
        <label class="font-weight-boldest text-success h2"> Permohonan Pembayaran Lahan PSN </label>
    </div>
    <br>
    <button href="#" class="btn btn-success font-weight-bold btn-pill btn-lg" data-toggle="modal" id="btnAddSpp"><i class="fas fa-plus-circle"></i>INPUT SPP</button>
    <button class="btn btn-success font-weight-bold btn-pill" id="btnUndo"><i class="fas fa-undo"></i>Kembali</button>
    <div class="mt-5" id="infoDataKosong" style="display:none">
        <p class="font-weight-boldest">
            Anda belum Memiliki SPP, silahkan menginput untuk memulai permohonan pembyaran
        </p>
    </div>
</div>


<!--begin::Content-->
<div id="spp-data">
    <div class="flex-row-fluid ml-lg-12 mt-5" id="spp-data-detail" style="display:none">
        <div class="card card-custom gutter-b">
            <div class="card-body pt-2 pb-0 mt-n3">
                <div class="tab-content mt-5" id="myTabTables12">
                    
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade show active" id="kt_tab_pane_12_3" role="tabpanel" aria-labelledby="kt_tab_pane_12_3">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-borderless table-vertical-center">
                                <thead>
                                    <tr>
                                        <!--<th class="p-0 w-50px"></th>-->
                                        <!--<th class="p-0 min-w-200px"></th>-->
                                        <th class="p-0 min-w-100px"></th>
                                        <th class="p-0 min-w-120px"></th>
                                        <th class="p-0 min-w-120px"></th>
                                        <th class="p-0 min-w-50px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pl-0">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Jenis Pembayaran</a>
                                            <div>
                                                <span class="text-muted font-weight-bold text-hover-primary" id="spp_type"></span>
                                                <!--<a class="text-muted font-weight-bold text-hover-primary" href="#"></a>-->
                                            </div>
                                        </td>
                                        <td class="pl-0">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">No. SPP</a>
                                            <div>
                                                <span class="text-muted font-weight-bold text-hover-primary" id="spp_no">Nomor SPP</span>
                                                <!--<a class="text-muted font-weight-bold text-hover-primary" href="#"></a>-->
                                            </div>
                                        </td>
                                        <td class="pl-0">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">No. SPP GK PPK
</a>
                                            <div>
                                                <span class="text-muted font-weight-bold text-hover-primary" id="spp_gk_no">Nomor SPP</span>
                                                <!--<a class="text-muted font-weight-bold text-hover-primary" href="#"></a>-->
                                            </div>
                                        </td>
                                        <td class="pr-0 text-right">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Status</a>
                                            <div>
                                                <span class="label label-lg label-light-primary label-inline" id="status_spp">Approved</span>
                                            </div>
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <!--<td class="pl-0">-->
                                        <!--    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">No. SPP</a>-->
                                        <!--    <div>-->
                                        <!--        <span class="text-muted font-weight-bold text-hover-primary" id="spp_no">Nomor SPP</span>-->
                                                <!--<a class="text-muted font-weight-bold text-hover-primary" href="#"></a>-->
                                        <!--    </div>-->
                                        <!--</td>-->
                                         <td class="pl-0" colspan="3">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Nama PSN</a>
                                            <div>
                                                <span class="text-muted font-weight-bold text-hover-primary" id="psn_name">Nama PSN</span>
                                                <!--<a class="text-muted font-weight-bold text-hover-primary" href="#"></a>-->
                                            </div>
                                        </td>
                                        <!--<td class="text-right">-->
                                        <!--    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Status</a>-->
                                        <!--    <div>-->
                                                <!--<span class="text-muted font-weight-bold text-hover-primary" id="psn_name">Nama PSN</span>-->
                                        <!--    <span class="label label-lg label-light-primary label-inline" id="status_spp">Approved</span>-->
                                                <!--<a class="text-muted font-weight-bold text-hover-primary" href="#"></a>-->
                                        <!--    </div>-->
                                        <!--</td>-->
                                        <td class="pr-0 text-right">
                                            <button class="btn btn-success font-weight-bold btn-pill btn-lg btnCompleteField" id="btnCompleteField">
                                                <i class="fas fa-plus-circle"></i>Lengkapi Bidang
                                        </button>
                                           
                                        </td>
                                    </tr>
                                    <tr class="min-w-420px bg-light-success">
                                        <td class="pl-0" colspan="4">
                                            <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg h3" id="saldo_spp">Rp. 100.000.000,00</span>
                                            <!--<span class="text-muted font-weight-bold d-block">-->
                                            <!--    <span class="font-weight-bolder text-dark-75">FTP:</span>bprow@bnc.cc</span>-->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Tap pane-->
                </div>
            </div>
            
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 7-->
    </div>
</div>

<!--end::Content-->



<!-- Modal -->
<div class="modal fade" id="modalInputSpp" tabindex="-1" data-backdrop="static" aria-labelledby="modalSppTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSppTitle">Input Dokumen Surat Pengajuan Pembayaran (SPP)</h5>
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                <!--    <span aria-hidden="true">&times;</span>-->
                <!--</button>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="spp_num" class="col-sm-6 col-form-label">Nomor SPP Menteri/Kepala</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control data-spp" id="spp_num" name="spp_num">
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="spp_date" class="col-sm-6 col-form-label">Tanggal</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control data-spp" id="spp_date" name="spp_date">
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="psn_name" class="col-sm-6 col-form-label">Sektor PSN</label>
                        <div class="col-sm-12">
                            <!--<input type="text" class="form-control data-spp" id="psn_name" name="psn_name">-->
                            <select class="form-control data-spp select2" id="psn_sector" name="psn_sector" required></select>
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group" id="div-psn-name" style="display:none">-->
                        <div id="div-psn-name" style="display:none">
                            <label for="psn_name_data" class="col-sm-6 col-form-label">Nama PSN</label>
                            <div class="col-sm-12">
                                <select class="form-control data-spp select2" id="psn_name_data" name="psn_name_data" required></select>
                            </div>
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="spp_gk_num" class="col-sm-6 col-form-label">Nomor SPP GK PPK</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control data-spp" id="spp_gk_num" name="spp_gk_num">
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="value" class="col-sm-6 col-form-label">Nilai Nominal</label>
                        <div class="col-sm-12">
                            <div class="input-group">
								<div class="input-group-prepend">
								<span class="input-group-text">Rp</span>
							</div>
							<!--<input type="text" class="form-control" placeholder="Email">-->
                            <input type="text" class="form-control data-spp" id="value" name="value">
						</div>
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="area" class="col-sm-6 col-form-label">Luasan Objek Pengadaan Tanah  (m<sup>2</sup>)<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" class="form-control data-spp" id="area" name="area">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">m<sup>2</sup></span>
                                </div>
                            </div>
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="field_count" class="col-sm-6 col-form-label">Jumlah Bidang Tanah</label>
                        <div class="col-sm-12">
                            <input type="text" min="0" class="form-control data-spp" id="field_count" name="field_count">
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="non_field_count" class="col-sm-6 col-form-label">Jumlah Non Bidang Tanah</label>
                        <div class="col-sm-12">
                            <input type="text" min="0" class="form-control data-spp" id="non_field_count" name="non_field_count">
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <div id="div-bank-name" style="display:none">
                            <label for="bank_id" class="col-sm-6 col-form-label" id="bank_id_title">Nomor Rekening</label>
                            <div class="col-sm-12">
                                <input type="text" min="0" class="form-control data-spp" id="bank_id" name="bank_id">
                            </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                            <label for="bank_name_data" class="col-sm-6 col-form-label">Nama BANK</label>
                            <div class="col-sm-12">
                                <select class="form-control data-spp select2" id="bank_name_data" name="bank_name_data" required></select>
                            </div>
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="" class="col-sm-6 col-form-label">Upload SPP Menteri/Kepala dan Lampiran</label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control data-spp" id="id_doc_spp" name="id_doc_spp" readonly>
                            <label for="doc_spp" class="btn btn-outline-success btn-sm mr-3" id="choose-file-label">UPLOAD DOKUMEN</label>
                            <input type="file" class="form-control" id="doc_spp" name="doc_spp" accept="application/pdf" style="display:none">

                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="" class="col-sm-6 col-form-label">Upload SPTJM</label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control data-spp" id="id_doc_sptjm" name="id_doc_sptjm" readonly>
                            <label for="doc_sptjm" class="btn btn-outline-success btn-sm mr-3" id="choose-file-label">UPLOAD DOKUMEN</label>
                            <input type="file" class="form-control" id="doc_sptjm" name="doc_sptjm" accept="application/pdf" style="display:none">

                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="" class="col-sm-6 col-form-label">Upload Surat Kesesuaian Dokumen</label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control data-spp" id="id_doc_letter" name="id_doc_letter" readonly>
                            <label for="doc_letter" class="btn btn-outline-success btn-sm mr-3" id="choose-file-label">UPLOAD DOKUMEN</label>
                            <input type="file" class="form-control" id="doc_letter" name="doc_letter" accept="application/pdf" style="display:none">

                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="" class="col-sm-6 col-form-label">Upload Validasi BPN</label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control data-spp" id="id_doc_bpn" name="id_doc_bpn" readonly>
                            <label for="doc_bpn" class="btn btn-outline-success btn-sm mr-3" id="choose-file-label">UPLOAD DOKUMEN</label>
                            <input type="file" class="form-control" id="doc_bpn" name="doc_bpn" accept="application/pdf" style="display:none">

                        </div>
                    </div>
                    
                    

                    <div class="modal-footer">
                        <button type="button" id="btnSaveSpp" class="btn btn-success">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalDetailBidangRejected" tabindex="-1" data-backdrop="static" aria-labelledby="modalDetailBidangRejectedTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text detail-info-reject">Anda memiliki 2 bidang yang dikembalikan dari permohonan pembayaran yang anda lakukan sebelumnya</div>
                    <div class="alert-close">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
                        <!--    <span aria-hidden="true"><i class="ki ki-close"></i></span>-->
                        <!--</button>-->
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <p class="font-weight-boldest text-success">Silahkan centang sisa bidang yang dikembalikan untuk melengkapi dokumen yang kurang/salah</p>
                <div class="table-responsive">
                    <!--begin::Text-->
                    <!--<p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-2">-->
                        <table class="table table-bordered table-hover table-checkable" id="tableDetailBidangRejected">
							<thead>
								<tr class="">
								    <th></th>
									<th>No.</th>
                					<th>No.SPP</th>
                					<th>Tanggal Input</th>
                                    <th>Nama PSN</th>
                                    <th>Jenis Bidang</th>
                                    <th>Alasan tertolak</th>
                                    <th class="text-success">Centang semua</th>
								</tr>
							</thead>
							<tbody>
												
							</tbody>
						</table>
                    <!--</p>-->
                    <!--end::Text-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSKipRejectField" class="btn btn-success">LEWATI</button>
                <button type="button" id="btnNextNewField" class="btn btn-outline-success">SELANJUTNYA</button>
            </div>
        </div>
    </div>
</div>
<?php if (isset($js)) {
    foreach ($js as $js) {
        ?>
        <script type="text/javascript" src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH.$js;
            ?>"></script>
        <?php
    }}
?>