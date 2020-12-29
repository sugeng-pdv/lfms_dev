<div class="container mt-0">
    <!--<div class="alert-text">-->
    <!--    <label class="font-weight-boldest text-success h2"> Permohonan Pembayaran Lahan PSN </label>-->
    <!--</div>-->
    <!--<br>-->
    <!--<button href="#" class="btn btn-success font-weight-bold btn-pill btn-lg" data-toggle="modal" id="btnAddSpp"><i class="fas fa-plus-circle"></i>INPUT SPP</button>-->
    <!--<button class="btn btn-success font-weight-bold btn-pill" id="btnUndo"><i class="fas fa-undo"></i>Kembali</button>-->
    <div class="mt-5" id="infoDataKosong" style="display:none">
        <p class="font-weight-boldest">
            Tidak Ada Data pengajuan SPP
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
                                        <th class="p-0 min-w-80px"></th>
                                        <th class="p-0 min-w-1600px"></th>
                                        <th class="p-0 min-w-120px"></th>
                                        <th class="p-0 min-w-50px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pl-0" colspan="2">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Jenis Pembayaran
                                            </a>
           <!--                                 <span class="navi-label">-->
           <!--                                     <span class="label label-rounded label-light-danger font-weight-bolder">New</span>-->
											<!--</span>-->
                                            <div>
                                                <span class="text-muted font-weight-bold text-hover-primary" id="spp_type"></span>
                                                <!--<a class="text-muted font-weight-bold text-hover-primary" href="#"></a>-->
                                            </div>
                                        </td>
                                        <td class="pr-0 text-right" colspan="2">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Status</a>
                                            <div>
                                                <span id="status_spp">Approved</span>
                                            </div>
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-0">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">No. SPP</a>
                                            <div>
                                                <span class="text-muted font-weight-bold text-hover-primary" id="spp_no">Nomor SPP</span>
                                                <!--<a class="text-muted font-weight-bold text-hover-primary" href="#"></a>-->
                                            </div>
                                        </td>
                                         <td class="pl-0" colspan="2">
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Nama PSN</a>
                                            <div>
                                                <span class="text-muted font-weight-bold text-hover-primary" id="psn_name">Nama PSN</span>
                                            </div>
                                        </td>
                                        <td class="pr-0 text-right" id="infoDetail">
                                            <button class="btn btn-outline-success font-weight-bold btn-pill btn-lg btnDetail" id="btnDetail">
                                                <!--<i class="fas fa-plus-circle"></i>-->
                                                Lihat Detail
                                            </button>
                                           
                                        </td>
                                        <td class="pr-0 text-right" id="infoDecision">
                                            <button class="btn btn-success font-weight-bold btn-lg btnDecision" id="btnDecision">
                                                Buat Keputusan
                                            </button>
                                           
                                        </td>
                                        
                                    </tr>
                                    <tr class="min-w-420px" id="info-pic">
                                        <td class="pl-0" colspan="3">
                                            <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg" id="staff_pic">Staff Divisi Pendanaan Lahan : </span>
                                        </td>
                                        <td class="pr-0 text-right">
                                            <button class="btn font-weight-bold btn-pill btn-lg btnTask" id="btnTask">
                                                <!--<i class="fas fa-plus-circle"></i>-->
                                                Tambah Penugasan Baru
                                            </button>
                                           
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


<div class="modal fade" id="modalUpdatePic" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                 <h5 class="modal-title" id="picModalLabel">Update Data PIC</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i>

                </button>
            </div>
            <div class="modal-body form-modal">
                <div class="form-group">
                    <label>Pic</label>
                    <div class="col-sm-12">
                        <input type="hidden" class="form-control data-update-pegawai" id="id_spp" name="id_spp">
                        <select class="form-control select2 data-update-pegawai" id="name_pic" name="name_pic" required></select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                <button onclick="saveUpdatePic();" type="button" class="btn btn-success font-weight-bold">Simpan</button>
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