<div class="container row mt-0 mb-1">
     <div class="col-sm-8">
        <!--<div class="col-sm-4 mr-1">-->
        <!--    <select class="form-control data-budget select2" id="payment_type" name="payment_type" required>-->
        <!--        <option value="">Pilih Jenis Pembayaran</option>-->
        <!--        <option value="all">Semua Pembayaran</option>-->
        <!--        <option value="Langsung">Pembayaran Langsung</option>-->
        <!--        <option value="Talangan">Pembayaran Talangan</option>-->
        <!--        <option value="COF">COF</option>-->
        <!--    </select>-->
        <!--</div>-->
        <!--<div class="col-sm-4 mr-1">-->
        <!--    <select class="form-control data-budget select2" id="fiscal_year" name="fiscal_year" required></select>-->
        <!-- </div>-->
    </div>
    <div class="col-sm-4 text-right">
        <button href="#" class="btn btn-success font-weight-bold btn-pill btn-lg" data-toggle="modal" id="btnAddPsn"><i class="fas fa-plus-circle"></i>INPUT PSN</button>
    </div>
    <div class="row justify-content-between ml-10 mt-2 mb-2">
    <!--<div class="col-10-md">-->
            <!--<button type="button" class="btn btn-outline-success btn-lg mr-5 active">Monitoring SPP</button>-->
            <select class="form-control select2 mr-2 data-search" id="payment_type_search" name="payment_type_search">
                <option value="">Pilih Jenis Pembayaran</option>
                <option value="all">Semua Pembayaran</option>
                <option value="Langsung">Pembayaran Langsung</option>
                <option value="Talangan">Pembayaran Talangan</option>
                <option value="COF">COF</option>
            </select>
            <select class="form-control select2 mr-2 data-search" id="fiscal_year_search" name="fiscal_year_search"></select>
            <div class="input-icon mr-2">
                <input type="text" class="form-control data-search" width="100%" placeholder="Nama PSN" name="psn_search" id="psn_search" /> <span>
                    <i class="flaticon2-search-1 text-muted"></i>
                </span>
    
            </div>
        <!--</div>-->
        
        
    </div>
    <div class="row justify-content-between ml-10 mt-2 mb-2">
        <div class="row mt-5" id="infoDataKosong" style="display:none">
            <p class="font-weight-boldest">
                Data Tidak Ada
            </p>
        </div>
    <!--<div class="col-10-md">-->
            <!--<button type="button" class="btn btn-outline-success btn-lg mr-5 active">Monitoring SPP</button>-->
           
        <!--</div>-->
        
        
    </div>
    <!--<div class="text-right">-->
    <!--    <button href="#" class="btn btn-success font-weight-bold btn-pill btn-sm" data-toggle="modal" id="btnAddPsn"><i class="fas fa-plus-circle"></i>INPUT PSN</button>-->
    <!--</div>-->
    
    <!-- <div class="col-sm-10">-->
    <!--    <div class="col-sm-4 mr-1">-->
    <!--        <select class="form-control data-budget select2" id="payment_type" name="payment_type" required>-->
    <!--            <option value="">Pilih Jenis Pembayaran</option>-->
    <!--            <option value="all">Semua Pembayaran</option>-->
    <!--            <option value="Langsung">Pembayaran Langsung</option>-->
    <!--            <option value="Talangan">Pembayaran Talangan</option>-->
    <!--            <option value="COF">COF</option>-->
    <!--        </select>-->
    <!--    </div>-->
    <!--    <div class="col-sm-4 mr-1">-->
    <!--        <select class="form-control data-budget select2" id="fiscal_year" name="fiscal_year" required></select>-->
    <!--     </div>-->
    <!--</div>-->
    <!--<div class="col-sm-2 text-right">-->
    <!--    <button href="#" class="btn btn-success font-weight-bold btn-pill btn-sm" data-toggle="modal" id="btnAddPsn"><i class="fas fa-plus-circle"></i>INPUT PSN</button>-->
    <!--</div>-->
    
</div>


<!--begin::Content-->
<div id="psn-data">
    <div class="flex-row-fluid ml-lg-12 mt-5" id="psn-data-detail" style="display:none">
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
                                        <th class="p-0 min-w-80px"></th>
                                        <th class="p-0 min-w-1600px"></th>
                                        <th class="p-0 min-w-120px"></th>
                                        <th class="p-0 min-w-50px"></th>
                                        <th class="p-0 min-w-30px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pl-0" colspan="4">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Nama PSN</a>
                                            <div>
                                                <span class="text-muted font-weight-bold text-hover-primary" id="psn_name_data"></span>
                                                <!--<a class="text-muted font-weight-bold text-hover-primary" href="#"></a>-->
                                            </div>
                                        </td>
                                        <td class="pr-0 text-right" colspan="1">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Tahun Anggaran</a>
                                            <div>
                                                <span class="label label-lg label-light-primary label-inline" id="fiscal_year_data">Approved</span>
                                            </div>
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-0">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Luasan</a>
                                            <div>
                                                <span class="text-muted font-weight-bold text-hover-primary" id="area_data"></span>
                                                <span class="text-muted font-weight-bold text-hover-primary">m</span><sup class="text-muted font-weight-bold text-hover-primary">2</sup></span>
                                                <!--<a class="text-muted font-weight-bold text-hover-primary" href="#"></a>-->
                                            </div>
                                        </td>
                                         <td class="pl-0" colspan="3">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Nama Badan Usaha</a>
                                            <div>
                                                <span class="text-muted font-weight-bold text-hover-primary" id="institution_data"></span>
                                                <!--<a class="text-muted font-weight-bold text-hover-primary" href="#"></a>-->
                                            </div>
                                        </td>
                                        <td class="pr-0 text-right">
                                            <button class="btn btn-success font-weight-bold btn-pill btn-sm btnEditDetailPsn mr-1" id="btnEditDetailPsn">
                                                <i class="fas fa-plus-circle"></i>Edit Detail
                                            </button>
                                           
                                        <!--</td>-->
                                        <!--<td class="pr-0 text-right">-->
                                            <button class="btn btn-success font-weight-bold btn-pill btn-sm btnCompleteField" id="btnCompleteField">
                                                <i class="fas fa-plus-circle"></i>Edit Anggaran
                                            </button>
                                           
                                        </td>
                                    </tr>
                                    <tr class="min-w-420px bg-light-success">
                                        <td class="pl-0" colspan="5">
                                            <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg h3" id="saldo_psn">Rp. 100.000.000,00</span>
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
<div class="modal fade" id="modalInputPsn" tabindex="-1" data-backdrop="static" aria-labelledby="modalSppTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSppTitle">Input dan alokasi anggaran PSN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body mt-0">
                <form>
                    <div class="form-group">
                        <label for="psn_sector" class="col-sm-6 col-form-label">Sektor PSN<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control data-budget" id="id" name="id">
                            <input type="hidden" class="form-control data-budget" id="type" name="type">
                            <select class="form-control data-budget select2" id="psn_sector" name="psn_sector" required></select>
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group" id="div-psn-name">-->
                        <label for="psn_name" class="col-sm-6 col-form-label">Nama PSN<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                             <input type="text" class="form-control data-budget" id="psn_name" name="psn_name">
                            <!--<select class="form-control data-budget select2" id="psn_name_data" name="psn_name_data" required></select>-->
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="kepdirut_num" class="col-sm-6 col-form-label">Nomor Kepdirut<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                             <input type="text" class="form-control data-budget" id="kepdirut_num" name="kepdirut_num">
                            <!--<select class="form-control data-budget select2" id="psn_name_data" name="psn_name_data" required></select>-->
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="payment_type" class="col-sm-6 col-form-label">Jenis Pembayaran<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select class="form-control data-budget select2" id="payment_type" name="payment_type" required>
                                <option value="">Pilih Jenis Pembayaran</option>
                                <option value="Langsung">Pembayaran Langsung</option>
                                <option value="Talangan">Pembayaran Talangan</option>
                                <option value="COF">COF</option>
                                <!--<option>COF</option>-->
                            </select>
                            <!--<input type="text" class="form-control data-budget" id="fiscal_year" name="fiscal_year">-->
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                         <!--awal - akhir-->
                        <label for="allocation_ttl" class="col-sm-6 col-form-label">Total Alokasi<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <div class="input-group">
								<div class="input-group-prepend">
								<span class="input-group-text">Rp</span>
							</div>
							<!--<input type="text" class="form-control" placeholder="Email">-->
                            <input type="text" class="form-control data-budget" id="allocation_ttl" name="allocation_ttl">
						</div>
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        
                        <label for="realization_ttl" class="col-sm-6 col-form-label">Total Realisasi <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <div class="input-group">
								<div class="input-group-prepend">
								<span class="input-group-text">Rp</span>
							</div>
							<!--<input type="text" class="form-control" placeholder="Email">-->
                            <input type="text" class="form-control data-budget" id="realization_ttl" name="realization_ttl">
						</div>
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        
                        <label for="remaining_fund" class="col-sm-6 col-form-label">Sisa Dana Tahun Sebelumnya <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <div class="input-group">
								<div class="input-group-prepend">
								<span class="input-group-text">Rp</span>
							</div>
							<!--<input type="text" class="form-control" placeholder="Email">-->
                            <input type="text" class="form-control data-budget" id="remaining_fund" name="remaining_fund">
						</div>
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="fiscal_year" class="col-sm-6 col-form-label">Tahun Anggaran<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select class="form-control data-budget select2" id="fiscal_year" name="fiscal_year" required></select>
                            <!--<input type="text" class="form-control data-budget" id="fiscal_year" name="fiscal_year">-->
                        </div>
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <label for="value" class="col-sm-6 col-form-label">Nilai Nominal<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <div class="input-group">
								<div class="input-group-prepend">
								<span class="input-group-text">Rp</span>
							</div>
							<!--<input type="text" class="form-control" placeholder="Email">-->
                            <input type="text" class="form-control data-budget" id="value" name="value">
						</div>
                        </div>
                    <!--</div>-->
                    <div class="div_business_entity">
                        <label for="business_entity" class="col-sm-6 col-form-label">Nama Badan Usaha<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select class="form-control data-budget select2" id="business_entity" name="business_entity" required></select>
                        </div>
                    </div>
                    <!--<div class="form-group">-->
                        <label for="area" class="col-sm-6 col-form-label">Luasan (m<sup>2</sup>)<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" class="form-control data-budget" id="area" name="area">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">m<sup>2</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="btnSaveBudget" class="btn btn-success">SIMPAN</button>
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