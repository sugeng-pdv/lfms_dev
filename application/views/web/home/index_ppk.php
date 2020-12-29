                                <div class="tab-content">
                                	<!-- begin: Tab pane-->
                                	<div class="tab-pane show active row text-center" id="kt-pricing-2_content1" role="tabpanel" aria-labelledby="pills-tab-1">
                                		<div class="card-body bg-white col-11 col-lg-12 col-xxl-10 mx-auto">
                                			<div class="alert-text text-center"><label class="font-weight-boldest text-success h3">Pilih aktivitas yang ingin anda lakukan</label>
                                			</div>

                                			<div class="row mt-3">
                                				<!-- begin: Pricing-->
                                				<div class="col-md-6">
                                					<div class="pt-30 pt-md-25 pb-15 px-5 text-center">
                                						<!--begin::Icon-->
                                						<img src="<?php echo $this->config->item('static_file_url') . PLATFORM_PATH; ?>assets/images/permohonan_pembayaran.png" alt="" width="175" height="200">
                                						<br><br><br>
                                						<!--end::Icon-->
                                						<!--begin::Content-->
                                						<h4 class="font-size-h3 mb-5">Permohonan Pembayaran</h4>
                                						<div class="d-flex flex-column line-height-xl pb-10">
                                							<span>Melakukan Permohonan Pembayaran Lahan PSN ke LMAN</span>
                                						</div>
                                						<div class="mt-7">
                                							<button type="button" class="btn btn-success text-uppercase font-weight-bolder px-15 py-3 btn-add-1">PILIH</button>
                                						</div>
                                						<!--end::Content-->
                                					</div>
                                				</div>
                                				<!-- end: Pricing-->
                                				<!-- begin: Pricing-->
                                				<div class="col-md-6">
                                					<div class="pt-30 pt-md-25 pb-15 px-5 text-center">
                                						<!--begin::Icon-->
                                						<img src="<?php echo $this->config->item('static_file_url') . PLATFORM_PATH; ?>assets/images/monitoring_spp.png" alt="" width="175" height="200">
                                						<br><br><br>
                                						<!--end::Icon-->
                                						<!--begin::Content-->
                                						<h4 class="font-size-h3 mb-5">Monitoring SPP</h4>
                                						<div class="d-flex flex-column line-height-xl pb-10">
                                							<span>Melakukan Permohonan Pembayaran Lahan PSN ke LMAN</span>
                                						</div>
                                						<div class="mt-7">
                                							<button type="button" class="btn btn-success text-uppercase font-weight-bolder px-15 py-3" id="btnCheckStatusRequest">PILIH</button>
                                						</div>
                                						<!--end::Content-->
                                					</div>
                                				</div>
                                				<!-- end: Pricing-->
                                			</div>
                                		</div>
                                	</div>
                                	<!-- end: Tab pane-->
                                </div>




                                <?php if (isset($js)) {
									foreach ($js as $js) { ?>
                                		<script type="text/javascript" src="<?php echo $this->config->item('static_file_url') . PLATFORM_PATH . $js; ?>"></script>
                                <?php }
								} ?>