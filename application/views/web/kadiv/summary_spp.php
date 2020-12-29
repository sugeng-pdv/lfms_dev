<div class="container mt-5 mb-5">
    <!--<div class="row">-->
    <!-- <div class="alert-text">-->
    <!-- <label class="font-weight-boldest text-success h2">Summary Penelitian SPP</label>-->
    <!-- </div>-->
    <!--</div>-->
    <div class="row justify-content-between mt-5 mb-5">
        <div class="col-8-md">
            <button class="btn btn-success font-weight-bold btn-pill" id="btnUndo"><i class="fas fa-undo"></i>Kembali</button>
        </div>
        <div class="input-icon">
            <p class="text-success font-weight-bold h5">Status : Nota Terkirim</p>
        </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="container mt-5 mb-5">
            <div class="table-responsive">
                <table class="table table-borderless table-vertical-center">
                    <thead>
                        <tr>
                            <th class="p-0 min-w-80px"></th>
                            <th class="p-0 min-w-180px"></th>
                            <th class="p-0 min-w-120px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="pl-0"> <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">No. SPP</a> 
                                <div> <span class="text-muted font-weight-bold text-hover-primary" id="spp_no">Nomor SPP</span> 
                                </div>
                            </td>
                            <td class="pl-0" colspan="2"> <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Nama PSN</a> 
                                <div> <span class="text-muted font-weight-bold text-hover-primary" id="psn_name">Nama PSN</span> 
                                </div>
                            </td>
                            <td class="pl-0"> <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Jenis Pembayaran</a> 
                                <div> <span class="text-muted font-weight-bold text-hover-primary" id="spp_type">Langsung</span> 
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-hover table-fixed" id="tableSummarySpp">
                <!-- Table head -->
                <thead class="btn-lman">
                    <tr>
                        <th>No.</th>
                        <th>Jenis Bidang</th>
                        <th>Harga / Nilai Tanah</th>
                        <th>Hasil Verifikasi Dokumen</th>
                        <th>Catatan Tertolak</th>
                    </tr>
                </thead>
                <!-- Table head -->
                <!-- Table body -->
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Non Bidang</td>
                        <td>12345676678</td>
                        <td>1343 m2</td>
                        <td>1 Juni 2020</td>
                    </tr>
                </tbody>
                <!-- Table body -->
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <!--begin::List Widget 10-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                 <h3 class="card-title font-weight-bolder text-dark">Keterangan Tambahan</h3> 
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0">
                <!--begin::Item-->
                <div class="mb-0">
                    <!--begin::Content-->
                    <div class="d-flex align-items-center flex-grow-1">
                        <!--begin::Section-->
                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                            <!--begin::Info-->
                            <div class="d-flex flex-column align-items-cente py-2 w-100">
                                <!--begin::Title--> 
                                <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">Sudah terverifikasi semua,namun ada berkas tertolak yang mungkin bisa dilampirkan untuk direview ataur dipertimbangkan ulang</a> 
                                <!--end::Title-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Label--> 
                            <!--<span class="label label-lg label-light-primary label-inline font-weight-bold py-4">Approved</span> -->
                            <!--end::Label-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Item-->
                
                <!--end: Item-->
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: Card-->
        <!--end: List Widget 10-->
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header h-auto py-4">
                <div class="card-title">
                    <h3 class="card-label">Lampiran Dokumen
                    <!--<span class="d-block text-muted pt-2 font-size-sm">company profile preview</span></h3>-->
                </div>
                <div class="card-toolbar">
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-4">
                <div class="form-group row my-2">
                    <label class="col-8 col-form-label">Nota Dinas:</label>
                    <div class="col-4">
                        <button type="button" class="btn btn-success btn-block" id="">Lihat File</button>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-8 col-form-label">Surat Dirut</label>
                    <div class="col-4">
                        <button type="button" class="btn btn-success btn-block" id="">Lihat File</button>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-8 col-form-label">Nota Dinas Pembukaan Rekening</label>
                    <div class="col-4">	
                        <button type="button" class="btn btn-success btn-block" id="">Lihat File</button>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-8 col-form-label">Dokumen SP2</label>
                    <div class="col-4">
                        <button type="button" class="btn btn-success btn-block" id="">Lihat File</button>
                    </div>
                </div>
                
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
</div>
<?php if (isset($js)) { foreach ($js as $js) { ?>
<script type="text/javascript" src="<?php echo $this->config->item('static_file_url') . PLATFORM_PATH . $js;
 ?>"></script>
<?php } } ?>