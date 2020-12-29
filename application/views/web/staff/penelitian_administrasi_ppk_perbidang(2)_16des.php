<div class="container row mt-0 mb-1 ml-5">
    <div class="col-sm-8 alert-text">
        <label class="font-weight-boldest text-success h2"> Preview Dokumen Bidang</label>
    </div>
    <div class="col-sm-4 text-right">
        <button class="btn btn-success font-weight-bold btn-pill" id="btnUndo"><i class="fas fa-undo"></i>Kembali</button>
    </div>
</div>


<!--begin::Content-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <!--<div class="d-flex flex-row flex-column-fluid page">-->
        <!--begin::Wrapper-->
        <!--<div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">-->
            <!--<div class="content d-flex flex-column flex-column-fluid" id="kt_content">-->
                <!--<div class="d-flex flex-column-fluid">-->
                    <!--<div class="container ml-5">-->
                        <div class="card card-custom">
                            <div class="card-body p-0">
								    <!--<div class="example-preview">-->
										<ul class="nav nav-light-success nav-pills" role="tablist">
															<li class="nav-item">
																<a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#nav-id">
																	<span class="nav-icon">
																		<i class="flaticon2-chat-1"></i>
																	</span>
																	<span class="nav-text">Fotocopi Identitas</span>
																</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" id="nav-tab-2" data-toggle="tab" href="#nav-bk" aria-controls="profile">
																	<span class="nav-icon">
																		<i class="flaticon2-layers-1"></i>
																	</span>
																	<span class="nav-text">Foto Copy bukti kepemilikan</span>
																</a>
															</li>
															
															<li class="nav-item">
																<a class="nav-link" id="nav-tab-3" data-toggle="tab" href="#nav-lhp" aria-controls="contact">
																	<span class="nav-icon">
																		<i class="flaticon2-rocket-1"></i>
																	</span>
																	<span class="nav-text">Fotocopi Laporan Hasil Kepemilikan</span>
																</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" id="nav-tab-4" data-toggle="tab" href="#nav-bpn" aria-controls="contact">
																	<span class="nav-icon">
																		<i class="flaticon2-rocket-1"></i>
																	</span>
																	<span class="nav-text">Surat Validasi BPN</span>
																</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" id="nav-tab-5" data-toggle="tab" href="#nav-sptjm" aria-controls="contact">
																	<span class="nav-icon">
																		<i class="flaticon2-rocket-1"></i>
																	</span>
																	<span class="nav-text">SPTJM</span>
																</a>
															</li>
														</ul>
											<div class="tab-content mt-2" id="">
												<div class="row justify-content-center py-5 px-4 py-lg-6 px-lg-5">
                                                    <div class="col-xl-8 col-xxl-8 mt-5" >
                                                        <div style="width:45%;position:fixed;height:60px;background:#252525;">
        												<div class="tab-pane fade show active" id="nav-id" role="tabpanel" aria-labelledby="nav-tab-1">
        												    <embed src="" frameborder="0" width="100%" height="900px" id="embed_view_id">
                                                                         <!--<img src="https://pbs.twimg.com/media/CCmLdVSWYAA5LDI.png" class="d-block w-100" alt="...">-->
                                                                        
        												</div>
        												<div class="tab-pane fade" id="nav-bk" role="tabpanel" aria-labelledby="nav-tab-2">
        															     <embed src="" frameborder="0" width="100%" height="900px" id="embed_view_bk">
        												</div>
        												<div class="tab-pane fade" id="nav-lhp" role="tabpanel" aria-labelledby="cnav-tab-3">
        															     <embed src="" frameborder="0" width="100%" height="900px" id="embed_view_lhp">
        															</div>
        															<div class="tab-pane fade" id="nav-bpn" role="tabpanel" aria-labelledby="nav-tab-4">
        															     <embed src="" frameborder="0" width="100%" height="900px" id="embed_view_bpn">
        															</div>
        															<div class="tab-pane fade" id="nav-sptjm" role="tabpanel" aria-labelledby="nav-tab-5">
        															     <embed src="" frameborder="0" width="100%" height="900px" id="embed_view_sptjm">
        															</div>
        												</div>
        												</div>	
        													
        											<div class="col-xl-4 col-xxl-4">
        											    <div data-scroll="true" class="scroll ps" >
                                                        <!--begin: Wizard Form-->
                                                        <form class="form" id="kt_form">
                                                            <!--begin: Wizard Step 2-->
                                                            <div class="p-1" data-wizard-type="step-content">
                                                                <p class="mb-5 font-weight-bold text-dark ">Klik Centang atau Silang untuk meneliti detail SPP dengan benar sesuai ketentuan</p>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">No SPP</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="no_spp"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnSppOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnSppNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Nama yang Berhak</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="name"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnNameOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnNameNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Jenis Bidang</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="jns_bidang"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnJnsOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnJnsNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">NIK</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="nik"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnNikOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnNikNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Nomor Urut Nominatif</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="no_nominatif"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnNominatifOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnNominatifNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Nomor Induk Bidang Sementara</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="nibs"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnNibsOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnNibsNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Lokasi Kecamatan</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="kecamatan"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnKecOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnKecNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Lokasi Desa</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="desa"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnDesaOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnDesaNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Kabupaten</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="kabupaten"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnKabOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnKabNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Jenis Bukti Kepemilikan</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="bukti_milik"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnJnsBuktiOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnJnsBuktiNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Luas Bidang Tanah</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="luas"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnLuasOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnLuasNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Harga/Nilai</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="harga"/>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnHargaOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnHargaNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Nomor LHV pengawasan BPKP</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" id="nomor_lhv"/>
                                                                        <div class="input-group-append">
                                                                            <!--<button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnLhvOk"><i class="flaticon2-check-mark icon-md"></i></button>-->
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <!--<button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnLhvNok"><i class="flaticon2-cross icon-md"></i></button>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="col-12 col-form-label">Tanggal LHV pengawasan BPKP</label>
                                                                <div class="col-10">
                                                                    <div class="input-group">
                                                                        <input type="date" class="form-control" aria-label="Text input with checkbox" id="tgl_lhv"/>
                                                                        <div class="input-group-append">
                                                                            <!--<button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id=""><i class="flaticon2-check-mark icon-md"></i></button>-->
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <!--<button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id=""><i class="flaticon2-cross icon-md"></i></button>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <hr>
                                                            <div class="timeline timeline-2 mt-5">
                                                                <div class="timeline-bar"></div>
                                                                <div class="timeline-item">
                                                                    <div class="timeline-badge" id="badge_id"></div>
                                                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                                                        <span class="mr-3">
                                                                            Fotocopy Identitas
                                                                        </span>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnCopyIdOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnCopyIdNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="timeline-item">
                                                                    <span class="timeline-badge" id="badge_bk"></span>
                                                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                                                        <span class="mr-3">
                                                                            Fotocopy Bukti Kepemilikan
                                                                        </span>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnCopyBmOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnCopyBmNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="timeline-item">
                                                                    <span class="timeline-badge" id="badge_lhp"></span>
                                                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                                                        <span class="mr-3">
                                                                            Fotocopy Laporan Hasil Penilaian
                                                                        </span>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnCopyLhpOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnCopyLhpNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="timeline-item">
                                                                    <span class="timeline-badge" id="badge_bpn"></span>
                                                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                                                        <span class="mr-3">
                                                                            Surat Validasi BPN
                                                                        </span>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnBpnOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnBpnNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="timeline-item">
                                                                    <span class="timeline-badge" id="badge_sptjm"></span>
                                                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                                                        <span class="mr-3">
                                                                            SPTJM
                                                                        </span>
                                                                        <div>
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnSptjmOk"><i class="flaticon2-check-mark icon-md"></i></button>
                                                                            <button type="button" class="btn btn-light btn-icon ml-3 icon-sm" id="btnSptjmNok"><i class="flaticon2-cross icon-md"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <!--end: Wizard Step 2-->
                                                            <!--begin: Wizard Actions-->
                                                            <div class="d-flex justify-content-between border-top mt- pt-10">
                                                                <div class="mr-2">
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-submit" id="btnSimpanLhv">Simpan</button>
                                                                </div>
                                                            </div>
                                                            <!--end: Wizard Actions-->
                                                        </form>
                                                        
                                                        </div>
                                                        <!--end: Wizard Form-->
                                                    </div>
														    
												</div>
											</div>
									<!--</div>-->
						
                            </div>
                        </div>
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
<?php if (isset($js)) {
    foreach ($js as $js) {
?>
        <script type="text/javascript" src="<?php echo $this->config->item('static_file_url') . PLATFORM_PATH . $js;
                                            ?>"></script>
<?php
    }
}
?>