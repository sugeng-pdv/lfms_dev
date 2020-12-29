<div class="container row mt-0 mb-1">
    <div class="col-sm-7 mb-2 alert-text">
        <label class="font-weight-boldest text-success h2"> Permohonan Pembayaran Lahan PSN </label>
    </div>
    <div class="col-sm-4 text-right">
        <button class="btn btn-success font-weight-bold btn-pill" id="btnUndo"><i class="fas fa-undo"></i>Kembali</button>
    </div>
</div>
<!--begin::Content-->
<div id="bidang-data">
    <!--<div class="flex-row-fluid ml-lg-12 mt-5" id="bidang-data-detail" style="display:block">-->
    <div class="card card-custom gutter-b">
        <!--begin::Body-->
        <!--<div class="card-header"></div>-->
        <div class="card-body">
            <!--begin::Container-->
            <div>
                <!--begin::Header-->
                <div class="d-flex align-items-center mb-5">
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Nama PSN</a>
                        <span class="text-dark-75 font-weight-bold spp-name-title"></span>
                    </div>
                    <div class="d-flex flex-column flex-grow-1">
                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Nilai Saldo Tabungan PSN : </a>
                        <span class="text-dark-75 font-weight-bold spp-nominal-title"></span>
                    </div>
                    <div class="d-flex flex-column flex-grow-1 text-right">
                        <a href="#" class="text-warning text-hover-primary mb-1 font-size-lg font-weight-bolder">Status</a>
                        <span class="text-warning font-weight-bold spp-status-title"></span>
                    </div>
                   
                </div>
                <!--begin::Body-->
                <div class="table-responsive">
                    <!--begin::Text-->
                    <!--<p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-2">-->
                        <table class="table table-bordered table-hover table-checkable" id="tableDetailBidang">
											<thead>
												<tr class="">
												    <th>No.</th>
                								    <th>No.SPP</th>
                                                    <th>Nama yang berhak</th>
                                                    <th>Jenis Bidang</th>
                                                    <th>NIK</th>
                                                    <th>Nomor Urut Nominatif</th>
                                                    <th>Nomor Induk Bidang Sementara</th>
                                                    <th>Lokasi(Desa,Kecamatan)</th>
                                                    <th>Jenis Bukti Kepemilikan</th>
                                                    <th>Luas</th>
                                                    <th>Harga/Nilai Tanah</th>
                                                    <th>Edit Bidang</th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
                    <!--</p>-->
                    <!--end::Text-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Body-->
        <div class="card-footer">
                <!--<form class="position-relative">-->
                    <button class="btn btn-success font-weight-bold btn-pill btn-lg btn-send-request-spp" id="btnInputField"><i class="fas fa-plus-circle"></i>Input Detail Bidang</button>
                    <button  class="btn btn-outline-success font-weight-bolder" id="btnGuidlineField"><i class="flaticon2-poll-symbol"></i> GUIDELINE INPUT DATA BIDANG</button>
                <!--</form>-->
                
        </div>
    </div>
    <!--</div>-->
    <div class="text-right mt-0">
            <button class="btn btn-success font-weight-bold btn-pill btn-lg btn-request-spp"><i class="fas fa-plus-circle"></i>KIRIM PERMOHONAN</button>
    </div>
</div>

<!--end::Content-->



<!-- Modal -->
<div class="modal fade" id="modalInputBidang" tabindex="-1" data-backdrop="static" aria-labelledby="modalSppTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBidangTitle">Input Detail Bidang yang akan diajukan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnCloseFormBidang">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInputBidang">
                    <div class="form-group row mb-0">
                        <!--<div class="form-group row">-->
                            <label for="spp_num" class="col-sm-5 col-form-label">No SPP<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <input type="hidden" class="form-control data-bidang" id="id_spp" name="id_spp" readonly="readonly" required="required">
                                <input type="hidden" class="form-control data-bidang" id="id_bidang" name="id_bidang" readonly="readonly" required="required">
                                <input type="text" class="form-control data-bidang" id="spp_num" name="spp_num" readonly="readonly" required="required">
                                <!--<select class="form-control data-bidang select2" id="psn_sector" name="psn_sector" required></select>-->
                            </div>
                        <!--</div>-->
                    </div>
                    <div id="talangan-eligible" class="ml-2">
                        <div class="form-group row mb-0">
    							<label class="col-sm-5 col-form-label">Apakah Bidang Eligible</label>
    							<div class="col-sm-7 mb-2">
    								<div class="radio-inline data-bidang">
    									<label class="radio radio-primary">
    									<input type="radio" name="is_eligible" value='1'>
    									<span></span>Ya</label>
    									<label class="radio radio-danger">
    									<input type="radio" name="is_eligible" value='0'>
    									<span></span>Tidak</label>
    									<!--<label class="radio radio-primary radio-disabled">-->
    									<!--<input type="radio" name="radios11" disabled="disabled">-->
    									<!--<span></span>Disabled</label>-->
    								</div>
    								<!--<span class="form-text text-muted">Some help text goes here</span>-->
    							</div>
    					</div>
    				</div>
                    <div id="talangan-eligible2" class="ml-2">
                            <div class="form-group row mb-0">
        						<!--</div>-->
        						<!--<div class="form-group row">-->
                                    <label for="lhv_num" class="col-sm-5 col-form-label">No LHV BPKP<span class="text-danger">*</span></label>
                                    <div class="col-sm-7 mb-2">
                                        <input type="text" class="form-control data-bidang" id="lhv_num" name="lhv_num">
                                        <!--<select class="form-control data-bidang select2" id="psn_sector" name="psn_sector" required></select>-->
                                    </div>
                                <!--</div>-->
                                <!--<div class="form-group row">-->
                                    <label for="lhv_date" class="col-sm-5 col-form-label">Tanggal LHV<span class="text-danger">*</span></label>
                                    <div class="col-sm-7 mb-2">
                                        <input type="date" class="form-control data-bidang" id="lhv_date" name="lhv_date">
                                        <!--<select class="form-control data-bidang select2" id="psn_sector" name="psn_sector" required></select>-->
                                    </div>
                            </div>
                    </div>
                    <div id="talangan-konsinyasi" class="ml-2">
                        <div class="form-group row mb-0">
    						<!--<div class="form-group row">-->
    							<label class="col-sm-5 col-form-label">Konsinyasi</label>
    							<div class="col-sm-7 col-form-label mb-2">
    								<div class="radio-inline">
    									<label class="radio radio-primary">
    									<input type="radio" name="is_konsinyasi" value="1">
    									<span></span>Ya</label>
    									<label class="radio radio-danger">
    									<input type="radio" name="is_konsinyasi" value="0">
    									<span></span>Tidak</label>
    									<!--<label class="radio radio-primary radio-disabled">-->
    									<!--<input type="radio" name="radios11" disabled="disabled">-->
    									<!--<span></span>Disabled</label>-->
    								</div>
    								<!--<span class="form-text text-muted">Some help text goes here</span>-->
    							</div>
    						<!--</div>-->
    					</div>
					</div>
					
					<div id="input-konsinyasi" class="ml-2">
                        <div class="form-group row mb-0">
                            <!--<div class="form-group row">-->
                                <label for="val_num" class="col-sm-5 col-form-label">No Validasi<span class="text-danger">*</span></label>
                                <div class="col-sm-7 mb-2">
                                    <input type="text" class="form-control data-bidang" id="val_num" name="val_num">
                                    <!--<select class="form-control data-bidang select2" id="psn_sector" name="psn_sector" required></select>-->
                                </div>
                            <!--</div>-->
                            <!--<div class="form-group row">-->
                                <label for="val_date" class="col-sm-5 col-form-label">Tanggal Validasi<span class="text-danger">*</span></label>
                                <div class="col-sm-7 mb-2">
                                    <input type="date" class="form-control data-bidang" id="val_date" name="val_date">
                                    <!--<select class="form-control data-bidang select2" id="psn_sector" name="psn_sector" required></select>-->
                                </div>
                            <!--</div>-->
                        </div>
                    </div>
                        
                        
                        
                        <!--<div class="form-group" id="div-psn-name" style="display:none">-->
                        <!--    <label for="psn_name_data" class="col-sm-5 col-form-label">Nama PSN</label>-->
                        <!--    <div class="col-sm-7 mb-2">-->
                        <!--        <select class="form-control data-bidang select2" id="psn_name_data" name="psn_name_data" required></select>-->
                        <!--    </div>-->
                        <!--</div>-->
                    <div class="form-group row mb-0">
                        <!--<div class="form-group row">-->
                            <label for="name" class="col-sm-5 col-form-label">Nama pihak yang berhak<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <input type="text" class="form-control data-bidang" id="name" name="name">
                            </div>
                        <!--</div>-->
                        <!--<div class="form-group row">-->
                            <label for="type" class="col-sm-5 col-form-label">Jenis Obyek pengadaan tanah<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <select class="form-control data-bidang select2" id="type" name="type" required>
                                    
                                </select>
                            </div>
                        <!--</div>-->
                        <!--<div class="form-group row">-->
                            <label for="type" class="col-sm-5 col-form-label">Kondisi Bidang<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <select class="form-control data-bidang select2" id="field_condition" name="field_condition">
                                    <option value="">Pilih Kondisi Bidang</option>
                                    <option value="Paket">Paket</option>
                                    <option value="Sebagian">Sebagian</option>
                                </select>
                            </div>
                        <!--</div>-->
                        <!--<div class="form-group row">-->
                            <label for="nik" class="col-sm-5 col-form-label">NIK<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <input type="number" class="form-control data-bidang" id="nik" name="nik">
                            </div>
                        <!--</div>-->
                        <!--<div class="form-group row">-->
                            <label for="nib_temp" class="col-sm-5 col-form-label">Nomor Urut Nominatif<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <input type="number" class="form-control data-bidang" id="no_nominatif" name="no_nominatif">
                            </div>
                        <!--</div>-->
                        <!--<div class="form-group row">-->
                            <label for="nib_temp" class="col-sm-5 col-form-label">Nomor Induk Bidang Sementara<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <input type="number" class="form-control data-bidang" id="nib_temp" name="nib_temp">
                            </div>
                        <!--</div>-->
                        <!--<div class="form-group row">-->
                            <label for="location" class="col-sm-5 col-form-label">Lokasi Kecamatan - Kelurahan<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <div class="input-group">
                                    <div style="width:90%" id="div_province">
                                        <select class="form-control data-bidang select2" id="province" name="province" required></select>
                                    </div>
                                    <div id="div_district" style="width:90%">
                                        <select class="form-control data-bidang select2" id="district" name="district" required></select>
                                    </div>
                                    <div style="width:90%" id="div_subdistrict">
                                        <select class="form-control data-bidang select2" id="sub_district" name="sub_district" required></select>
                                    </div>
                                    <div style="width:90%" id="div_village">
                                        <select class="form-control data-bidang select2" id="village" name="village" required></select>
                                    </div>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <!--<a href="#" class="btn btn-icon btn-success" id="btn_reset_location">-->
                                                <i class="flaticon-refresh icon-md" id="btn_reset_location"></i>
                                            <!--</a>-->
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                        <!--</div>-->
                        <!--<div class="form-group row">-->
                            <label for="ownership_type" class="col-sm-5 col-form-label">Jenis Bukti Kepemilikan<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <input type="text" class="form-control data-bidang" id="ownership_type" name="ownership_type">
                            </div>
                        <!--</div>-->
                        <!--<div class="form-group row">-->
                            <label for="field_area" class="col-sm-5 col-form-label">Luas Bidang<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <div class="input-group">
                                    <input type="text" class="form-control data-bidang" id="field_area" name="field_area">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">m<sup>2</sup></span>
                                    </div>
                                </div>
                            </div>
                        <!--</div>-->
                        <!--<div class="form-group row">-->
                            <label for="price" class="col-sm-5 col-form-label">Harga/Nilai<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control data-bidang" id="price" name="price">
                                </div>
                            </div>
                        <!--</div>-->
                    </div>
                        <div id="form-compensation" class="ml-2">
                            <div class="form-group row mb-0">
                                <label for="type" class="col-sm-5 col-form-label">Bentuk Ganti Rugi<span class="text-danger">*</span></label>
                                <div class="col-sm-7 mb-2">
                                    <select class="form-control data-bidang select2" id="compensation_type" name="compensation_type">
                                        <option value="">Pilih Kondisi Bidang</option>
                                        <option value="Uang">Uang</option>
                                        <option value="Tanah Pengganti">Tanah Pengganti</option>
                                        <option value="Bangunan Pengganti">Bangunan Pengganti</option>
                                        <option value="Relokasi">Relokasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="form-general-payment" class="ml-2">
                            <div class="form-group row mb-0">
                                <label for="" class="col-sm-5 col-form-label">Fotokopi Identitas dan dok. pendukung<span class="text-danger">*</span></label>
                                <div class="col-sm-7 mb-2">
                                    <input type="hidden" class="form-control data-bidang" id="id_doc_nik" name="id_doc_nik" readonly>
                                    <label for="doc_nik" class="btn btn-outline-success btn-sm mr-3 data-dokumen id_doc_nik" id="choose-file-label">UPLOAD DOKUMEN</label>
                                    <input type="file" class="form-control" id="doc_nik" name="doc_nik" accept="application/pdf" style="display:none">
                                </div>
                            <!--</div>-->
                            <!--<div class="form-group row">-->
                                <label for="" class="col-sm-5 col-form-label">Fotokopi Bukti Kepemilikan dan data pendukung<span class="text-danger">*</span></label>
                                <div class="col-sm-7 mb-2">
                                    <input type="hidden" class="form-control data-bidang" id="id_doc_poo" name="id_doc_poo" readonly>
                                    <label for="doc_poo" class="btn btn-outline-success btn-sm mr-3 data-dokumen doc_poo" id="choose-file-label">UPLOAD DOKUMEN</label>
                                    <input type="file" class="form-control" id="doc_poo" name="doc_poo" accept="application/pdf" style="display:none">
                                </div>
                            </div>
                           
                        </div>
                        <div id="form-langsung-konsinyasi" class="ml-2">
                            <div class="form-group row mb-0">
                                <label for="" class="col-sm-5 col-form-label">Fotokopi Laporan Hasil Penilaian<span class="text-danger">*</span>
                                <span class="form-text text-muted">* Yang sudah dilegalisasi</span></label>
                                
                                <div class="col-sm-7 mb-2">
                                    <input type="hidden" class="form-control data-bidang" id="id_doc_result" name="id_doc_result" readonly>
                                    <label for="doc_result" class="btn btn-outline-success btn-sm mr-3 data-dokumen doc_result" id="choose-file-label">UPLOAD DOKUMEN</label>
                                    <input type="file" class="form-control" id="doc_result" name="doc_result" accept="application/pdf" style="display:none">
                                </div>
                            </div>
                        </div>
                        
                        <!--change to spp-->
                        
                        <!--<div class="form-group row">-->
                        <!--    <label for="" class="col-sm-5 col-form-label">Surat Validasi BPN<span class="text-danger">*</span></label>-->
                        <!--    <div class="col-sm-7 mb-2">-->
                        <!--        <input type="hidden" class="form-control data-bidang" id="id_doc_letter" name="id_doc_letter" readonly>-->
                        <!--        <label for="doc_letter" class="btn btn-outline-success btn-sm mr-3 data-dokumen doc_letter" id="choose-file-label">UPLOAD DOKUMEN</label>-->
                        <!--        <input type="file" class="form-control" id="doc_letter" name="doc_letter" accept="application/pdf" style="display:none">-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="form-group row">-->
                        <!--    <label for="" class="col-sm-5 col-form-label">SPTJM<span class="text-danger">*</span></label>-->
                        <!--    <div class="col-sm-7 mb-2">-->
                        <!--        <input type="hidden" class="form-control data-bidang" id="id_doc_sptjm" name="id_doc_sptjm" readonly>-->
                        <!--        <label for="doc_sptjm" class="btn btn-outline-success btn-sm mr-3 doc_sptjm data-dokumen" id="choose-file-label">UPLOAD DOKUMEN</label>-->
                        <!--        <input type="file" class="form-control" id="doc_sptjm" name="doc_sptjm" accept="application/pdf" style="display:none">-->
                        <!--    </div>-->
                        <!--</div>-->
                    
                        <div id="form-talangan" class="mb-0 ml-2">
                            <div class="form-group row mb-0">
                                <label for="" class="col-sm-5 col-form-label">Kuitansi Pembayaran<span class="text-danger">*</span></label>
                                <div class="col-sm-7 mb-2">
                                    <input type="hidden" class="form-control data-bidang" id="id_doc_receipt" name="id_doc_receipt" readonly>
                                    <label for="doc_receipt" class="btn btn-outline-success btn-sm mr-3 doc_receipt data-dokumen" id="choose-file-label">UPLOAD DOKUMEN</label>
                                    <input type="file" class="form-control" id="doc_receipt" name="doc_receipt" accept="application/pdf" style="display:none">
                                </div>
                            <!--</div>-->
                            <!--<div class="form-group row">-->
                                <label for="" class="col-sm-5 col-form-label">BAUGR<span class="text-danger">*</span></label>
                                <div class="col-sm-7 mb-2">
                                    <input type="hidden" class="form-control data-bidang" id="id_doc_baugr" name="id_doc_baugr" readonly>
                                    <label for="doc_baugr" class="btn btn-outline-success btn-sm mr-3 doc_baugr data-dokumen" id="choose-file-label">UPLOAD DOKUMEN</label>
                                    <input type="file" class="form-control" id="doc_baugr" name="doc_baugr" accept="application/pdf" style="display:none">
                                </div>
                            <!--</div>-->
                            <!--<div class="form-group row">-->
                                <label for="" class="col-sm-5 col-form-label">BAPH<span class="text-danger">*</span></label>
                                <div class="col-sm-7 mb-2">
                                    <input type="hidden" class="form-control data-bidang" id="id_doc_baph" name="id_doc_baph" readonly>
                                    <label for="doc_baph" class="btn btn-outline-success btn-sm mr-3 doc_baph data-dokumen" id="choose-file-label">UPLOAD DOKUMEN</label>
                                    <input type="file" class="form-control" id="doc_baph" name="doc_baph" accept="application/pdf" style="display:none">
                                </div>
                            </div>
                        </div>
                        <div id="form-konsinyasi">
                                <div class="form-group row mb-0">
                                        <label for="" class="col-sm-5 col-form-label">Fotokopi surat rekomendasi BPN/ BA penitipan dari P2T<span class="text-danger">*</span></label>
                                        <div class="col-sm-7 mb-2">
                                            <input type="hidden" class="form-control data-bidang" id="id_doc_rek_bpn" name="id_doc_rek_bpn" readonly>
                                            <label for="doc_rek_bpn" class="btn btn-outline-success btn-sm mr-3 doc_rek_bpn data-dokumen" id="choose-file-label">UPLOAD DOKUMEN</label>
                                            <input type="file" class="form-control" id="doc_rek_bpn" name="doc_rek_bpn" accept="application/pdf" style="display:none">
                                        </div>
                                    <!--</div>-->
                                    <!--<div class="form-group row">-->
                                        <label for="" class="col-sm-5 col-form-label">Fotokopi penetapan pengadilan<span class="text-danger">*</span></label>
                                        <div class="col-sm-7 mb-2">
                                            <input type="hidden" class="form-control data-bidang" id="id_doc_court" name="id_doc_court" readonly>
                                            <label for="doc_court" class="btn btn-outline-success btn-sm mr-3 doc_court data-dokumen" id="choose-file-label">UPLOAD DOKUMEN</label>
                                            <input type="file" class="form-control" id="doc_court" name="doc_court" accept="application/pdf" style="display:none">
                                        </div>
                                    <!--</div>-->
                                </div>
                                <div id="form-konsinyasi-talangan">
                                    <div class="form-group row mb-0">
                                        <label for="" class="col-sm-5 col-form-label">Fotokopi BA penyimpanan penitipan ganti rugi dari pengadilan<span class="text-danger">*</span></label>
                                        <div class="col-sm-7 mb-2">
                                            <input type="hidden" class="form-control data-bidang" id="id_ba_court" name="id_ba_court" readonly>
                                            <label for="doc_ba_court" class="btn btn-outline-success btn-sm mr-3 doc_ba_court data-dokumen" id="choose-file-label">UPLOAD DOKUMEN</label>
                                            <input type="file" class="form-control" id="doc_ba_court" name="doc_ba_court" accept="application/pdf" style="display:none">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="" class="col-sm-5 col-form-label">Dokumen Tambahan<span class="text-danger">*</span></label>
                            <div class="col-sm-7 mb-2">
                                <input type="hidden" class="form-control data-bidang" id="id_doc_add" name="id_doc_add" readonly>
                                <label for="doc_add" class="btn btn-outline-success btn-sm mr-3 doc_add data-dokumen" id="choose-file-label">UPLOAD DOKUMEN</label>
                                <input type="file" class="form-control" id="doc_add" name="doc_add" accept="application/pdf" style="display:none">
                            </div>
                        </div>
                    <!--</div>-->


                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-lg btn-block" id="btnSaveField">SIMPAN</button>
                        <!--<button type="button" id="btnSaveSpp" class="btn btn-success">SIMPAN</button>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalTutorialBidang" tabindex="-1" data-backdrop="static" aria-labelledby="modalSppTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h3 class="modal-title font-weight-boldest" id="modalTutorialTitle">TUTORIAL INPUT DATA BIDANG</h3>
                    <!--<a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Most Sales</a>-->
                    <div class="font-size-lg text-success font-weight-bold mt-1">Silahkan menonton video tersebut dengan seksama sebelum melakukan input data bidang
                    </div>
                </div>
                <!--<h5 class="modal-title" id="modalTutorialTitle2">TUTORIAL INPUT DATA BIDANG</h5>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close videoTutorialBidang"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item rounded" src="" allowfullscreen="allowfullscreen"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalSuccessRequestBidang" tabindex="-1"  aria-labelledby="modalSppTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!--<div class="modal-header">-->
            <!--    <center >-->
            <!--        <a href="#" class="btn btn-icon btn-success btn-circle btn-lg mr-4">-->
            <!--            <i class="flaticon2-check-mark"></i>-->
            <!--        </a>-->
            <!--    </center>-->
                <!--<h5 class="modal-title" id="modalSuccessRequestBidangTitle"></h5>-->
                
            <!--</div>-->
            <div class="modal-body">
                <form id="formInfoRequest">
                    <blockquote class="blockquote text-center">
                        <a href="#" class="btn btn-icon btn-success btn-circle btn-lg mr-4">
                            <i class="flaticon2-check-mark"></i>
                        </a>
                        <p class="mb-0"></p>
                        <footer class="">
                        </footer>
                        <div class="d-flex align-items-center mb-5">
                            <div class="d-flex flex-column flex-grow-1">
                                <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Permohonan Pembayaran Anda telah berhasil terkirim</a>
                                <span class="text-muted font-size-lg font-weight-bold spp-reuest-code">Silahkan monitor status permohonan ini dengan memasukkan kode</span>
                            </div>
                        </div>
                        <div class="h1 text-success font-size-lg font-weight-bold" id="codeRequest">123BC</div>
                    </blockquote>
                    
                    
                    <div class="modal-footer">
                        <blockquote class="blockquote text-center">
                            <div class="d-flex align-items-center mb-5">
                                <div class="d-flex flex-column flex-grow-1">
                                    <span class="text-success font-size-lg font-weight-bold spp-reuest-code">Harap selanjutnya mengirimkan dokumen hardcopy surat yang telah dipersyaratkan</span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-success btn-lg" id="btnBackToHome">Kembali ke Beranda</button>
                            <button type="button" class="btn btn-success btn-lg" id="btnCheckStatusRequest">Cek Status Permohonan</button>
                        </blockquote>
                    </div>
                </form>
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