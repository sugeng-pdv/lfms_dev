<div class="row">
    <div class="col-lg-6">
        <div class="card card-custom card-stretch">
            <div class="card-body">
                <div class="d-flex flex-column flex-center">
                <img src="<?php echo $this->config->item('static_file_url') . PLATFORM_PATH; ?>assets/images/permohonan_pembayaran_2.png" alt="" width="230">

                    <span class="card-title font-weight-bolder text-dark-85 text-hover-dark font-size-h4 m-5 pt-7 pb-5 h1 display-4">Permohonan Pembayaran</span>
                    <div class="font-weight-bold text-dark-850 font-size-sm pb-6 display-5 text-success">
                        Silakan pilih jenis pembayaran yang akan anda lakukan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-custom card-stretch card-stretch-third gutter-b">
            <div class="card card-custom mb-2 bg-diagonal bg-diagonal-light-info">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between p-4">
                        <div class="d-flex flex-column mr-5">
                            <a href="#" class="h4 text-dark text-hover-primary mb-5">Pembayaran Talangan</a>
                        </div>

                        <div class="ml-6 flex-shrink-0">
                            <button data-toggle="modal" data-target="#kt_chat_modal" class="btn font-weight-bolder text-uppercase font-size-lg btn-success py-3 px-10 btn-byr-tlg">PILIH</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-custom card-stretch card-stretch-third gutter-b">
            <div class="card card-custom mb-2 bg-diagonal bg-diagonal-light-success">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between p-4">
                        <div class="d-flex flex-column mr-5">
                            <a class="h4 text-dark text-hover-primary mb-5">Pembayaran Langsung</a>
                        </div>
                        <div class="ml-6 flex-shrink-0">
                            <button data-toggle="modal" data-target="#kt_chat_modal" class="btn font-weight-bolder text-uppercase font-size-lg btn-success py-3 px-10 btn-byr-lsg">PILIH</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-custom card-stretch card-stretch-third">
            <div class="card card-custom mb-2 bg-diagonal bg-diagonal-light-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between p-4">
                        <!--begin::Content-->
                        <div class="d-flex flex-column mr-5">
                            <a href="#" class="h4 text-dark text-hover-primary mb-5">Cost Of Fund</a>
                        </div>
                        <div class="ml-6 flex-shrink-0">
                            <a href="#" data-toggle="modal" class="btn font-weight-bolder text-uppercase font-size-lg btn-success py-3 px-10 btn-byr-cof">PILIH</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="requestPaymentModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<h5 class="modal-title" id="requestPaymentModalTitle">Permohonan Pembayaran</h5>-->
                <div class="d-flex flex-column flex-center py-2 pb-0">
                    <span class="card-title font-weight-bolder text-dark-20 text-hover-dark font-size-h4 m-5 pt-2 pb-0 h1 display-5">Permohonan Pembayaran</span>
                    <div class="font-weight-bold text-dark-850 font-size-sm pb-0 display-5 text-success">
                        Silakan pilih jenis pembayaran yang akan anda lakukan
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
                            <div class="card card-custom gutter-b">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between flex-column pt-4 h-100">
                                        <div class="pb-5">
                                            <div class="d-flex flex-column flex-center position-relative mb-25">
                                                <span class="svg svg-fill-primary opacity-4 position-absolute">
                                                    <svg width="200" height="200">
                                                        <polyline points="87,0 174,50 174,150 87,200 0,150 0,50 87,0" />
                                                    </svg>
                                                </span>
                                                <span class="svg-icon svg-icon-success svg-icon-5x">
                                                <img src="<?php echo $this->config->item('static_file_url') . PLATFORM_PATH; ?>assets/images/pembayaran_warga.png" alt="" width="150">

                                                </span>
                                                <p class="card-title font-weight-bolder text-dark-75 font-size-sm mt-5">Pembayaran langsung ke Warga</p>
                                            </div>
                                            <div class="text-center">
                                                <button class="btn btn-success font-weight-boldest font-size-lg btn-add-1 mb-5">PILIH</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
                            <div class="card card-custom gutter-b">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between flex-column pt-4 h-100">
                                        <div class="pb-5">
                                            <div class="d-flex flex-column flex-center position-relative mb-25">
                                                <span class="svg svg-fill-primary opacity-4 position-absolute">
                                                    <svg width="200" height="200">
                                                        <polyline points="87,0 174,50 174,150 87,200 0,150 0,50 87,0" />
                                                    </svg>
                                                </span>
                                                <span class="svg-icon svg-icon-success svg-icon-5x">
                                                <img src="<?php echo $this->config->item('static_file_url') . PLATFORM_PATH; ?>assets/images/pengadilan.png" alt="" width="170">

                                                </span>
                                                <p class="card-title font-weight-bolder text-dark-75 font-size-sm mt-5">Pembayaran langsung ke Pengadilan</p>
                                            </div>
                                            <div class="text-center">
                                                <button class="btn btn-success font-weight-boldest font-size-lg btn-add-2 mb-5">PILIH</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
                            <div class="card card-custom gutter-b">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between flex-column pt-4 h-100">
                                        <div class="pb-5">
                                            <div class="d-flex flex-column flex-center position-relative mb-25">
                                                <span class="svg svg-fill-primary opacity-4 position-absolute">
                                                    <svg width="200" height="200">
                                                        <polyline points="87,0 174,50 174,150 87,200 0,150 0,50 87,0" />
                                                    </svg>
                                                </span>
                                                <span class="svg-icon svg-icon-success svg-icon-5x">
                                                 <img src="<?php echo $this->config->item('static_file_url') . PLATFORM_PATH; ?>assets/images/pembayaran_transfer.png" alt="" width="145">

                                                </span>
                                                <p class="card-title font-weight-bolder text-dark-75 font-size-sm mt-5">Pembayaran Via Rekening KL</p>
                                            </div>
                                            <div class="text-center">
                                                <button class="btn btn-success font-weight-boldest font-size-lg btn-add-3 mb-5">PILIH</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!--Penambahan modal di menu cost of found-->
<!--Updated tanggal 16 Oktober 2020-->

<div class="modal fade" id="requestPaymentModalCof" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<h5 class="modal-title" id="requestPaymentModalTitle">Permohonan Pembayaran</h5>-->
                <div class="d-flex flex-column py-2 pb-0">
                    <span class="card-title font-weight-bolder text-dark-20 text-hover-dark font-size-h4 m-5 pt-2 pb-0 h1 display-5">Cost of Founding</span>
                    <div class="font-weight-bold text-dark-850 font-size-sm pb-0 display-5 text-success">
                        Silahkan cetak bidang yang telah disetujui untuk melanjutkan pembayaran cost of founding
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Table  -->
                <table class="table table-bordered">
                    <!-- Table head -->
                    <thead class="btn-lman">
                        <tr>
                            <th>No.</th>
                            <th>Jenis Bidang</th>
                            <th>No. SPP</th>
                            <th>Nama PSN</th>
                            <th>
                                <!-- Default unchecked -->
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="tableDefaultCheck1" checked>
                                    <label class="custom-control-label" for="tableDefaultCheck1">Centang Semua</label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <!-- Table head -->

                    <!-- Table body -->
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Non Bidang</td>
                            <td>TN. 120</td>
                            <td>Jalan Tol Bakauheni</td>
                            <th scope="row">
                                <!-- Default unchecked -->
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="tableDefaultCheck2">
                                    <label class="custom-control-label" for="tableDefaultCheck2">Checked</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Bidang</td>
                            <td>TN. 120</td>
                            <td>Jalan Tol Bakauheni</td>
                            <th scope="row">
                                <!-- Default unchecked -->
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="tableDefaultCheck3">
                                    <label class="custom-control-label" for="tableDefaultCheck3">Checked</label>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                    <!-- Table body -->
                </table>
                <!-- Table  -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lman" id="nextCof">Selanjutnya</button>
            </div>
            <!--end::Advance Table Widget 7-->
        </div>
        <!--end::Content-->
    </div>
</div>

<div class="modal fade" id="modalDetailBidangCof" tabindex="-1" data-backdrop="static" aria-labelledby="modalDetailBidangRejectedTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text detail-info-reject">Cost Of Funding</div>
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
                <button type="button" id="btnNextNewCof" class="btn btn-success">SELANJUTNYA</button>
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