								<!--<div class="row">-->								    <div class="row d-flex flex-row-fluid bgi-size-cover bgi-position-center py-6" style="background-image: url('<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>assets/media/bg/bg-9.jpg')">        				<!--			    <div class="row">-->        							                								<div class="col-lg-8">        										<!--begin::Mixed Widget 16-->        										<div class="card card-custom card-stretch gutter-b" style="background-color:#1c42131f">        											<!--begin::Body-->        											<div class="card-body d-flex flex-column">        												<!--begin::Chart-->        												<!--<div class="flex-grow-1">-->        												<!--	<div id="kt_mixed_widget_16_chart" style="height: 200px"></div>-->        												<!--</div>-->        												<!--end::Chart-->        												<!--begin::Items-->        												<div class="mt-35 mb-5">        													<div class="row row-paddingless mb-10">        														<!--begin::Item-->        														<div class="col">        															<div class="d-flex align-items-center mr-2">        																<!--begin::Title-->        																<div>        																	<div class="font-size-h4 text-dark-75 font-weight-bolder">Sistem Informasi Landfunding</div>        																	<div class="font-size-sm text-muted font-weight-bold mt-1">-</div>        																</div>        																<!--end::Title-->        															</div>        														</div>        														<!--end::Item-->        													</div>        												</div>        												<!--end::Items-->        											</div>        											<!--end::Body-->        										</div>        										<!--end::Mixed Widget 16-->        									</div>        									<div class="col-lg-4">        										<!--begin::Base Table Widget 2-->        										<div class="card card-custom card-stretch gutter-b">        											<div class="card-header  pt-6">        											    <div class="pb-13 pt-lg-2">                                                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Selamat datang,</h3>                                                            <span class="text-muted font-weight-bold font-size-h4">Silakan masuk sistem</span>                                                        </div>        												<!--<h3 class="card-title">Selamat Datang</h3>-->        												<div class="card-toolbar">        													<div class="example-tools justify-content-center">        														<span class="example-toggle" data-toggle="tooltip" title="View code"></span>        														<span class="example-copy" data-toggle="tooltip" title="Copy code"></span>        													</div>        												</div>        											</div>        											<!--begin::Form-->        											<form>        												<div class="card-body form-modal-login">        													<div class="form-group mb-8">        														<div class="alert alert-custom alert-default" role="alert">        															<div class="alert-icon">        																<span class="svg-icon svg-icon-primary svg-icon-xl">        																	<!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->        																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">        																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">        																			<rect x="0" y="0" width="24" height="24" />        																			<path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />        																			<path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />        																		</g>        																	</svg>        																	<!--end::Svg Icon-->        																</span>        															</div>        															<div class="alert-text">        															    <img alt="Logo" src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>assets/media/logos/logo-lman-40-teks-green.png" class="max-h-30px" />        															</div>        														</div>        													</div>        													<div class="form-group">        														<label>NIP, NPP atau E-Mail Anda        														<span class="text-danger">*</span></label>        														<input type="email" id="user" class="form-control" placeholder="masukkan  NIP, NPP atau Email Anda" />        														<!--<span class="form-text text-muted">LMAN tidak akan share email anda kesiapapun.</span>-->        													</div>        													<div class="form-group">        														<label for="password">Password        														<span class="text-danger">*</span></label>        														<input type="password" class="form-control" id="password" placeholder="Password" />        													</div>        												</div>        												<div class="card-footer">        													<button type="button" onclick="login();" class="btn btn-lman mr-4">Masuk</button>        													<!--<button type="reset" class="btn btn-secondary">Cancel</button>-->        												</div>        											</form>        											<!--end::Form-->        										</div>        										<!--end::Base Table Widget 2-->        									</div>        							   <!-- </div>-->        						    </div>								<!--</div>-->																<!--end::Dashboard-->								<?php if(isset($js) ){ foreach ($js as $js){ ?>                                    <script type="text/javascript" src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH.$js; ?>"></script>                                <?php }} ?>							