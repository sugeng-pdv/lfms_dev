
				 <style>
					/* .tab-pane.active {
						animation: slide-down 2s ease-out;
					}

					@keyframes slide-down {
						0% { opacity: 0; transform: translateY(100%); }
						100% { opacity: 1; transform: translateY(0); }
					} */
					.modal {
						/* other stuff we already covered */
						height: 100%;
						max-height: 100%;

					}
				</style>   
			<div class="row">
				<div class="col-12">
					<div class="box box-default">
						<!-- <div class="box-header with-border">
						<h4 class="box-title">Horizontal alignment</h4>
						<h6 class="box-subtitle">Use default tab with class <code>nav-tabs &amp; justify-content-center </code></h6>
						</div> -->
						<!-- /.box-header -->
						<div class="box-body">
							
							<!-- Nav tabs -->
							<ul class="nav nav-tabs justify-content-center" role="tablist">
								<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#identitas_perusahaan" role="tab"><span><i class="glyphicon glyphicon-user"></i></span> <span class="hidden-xs-down ml-15">Identitas Perusahaan</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#izin_usaha" role="tab"><span><i class="glyphicon glyphicon-list-alt"></i></span> <span class="hidden-xs-down ml-15">Izin Usaha</span></a> </li>
								<!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#akta_pendirian" role="tab"><span><i class="glyphicon glyphicon-th-list"></i></span> <span class="hidden-xs-down ml-15">Akta Pendirian</span></a> </li> -->
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#pemilik" role="tab"><span><i class="glyphicon glyphicon-th-list"></i></span> <span class="hidden-xs-down ml-15">Pemilik</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#pengurus" role="tab"><span><i class="glyphicon glyphicon-th-list"></i></span> <span class="hidden-xs-down ml-15">Pengurus</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tenaga_ahli" role="tab"><span><i class="glyphicon glyphicon-th-list"></i></span> <span class="hidden-xs-down ml-15">Tenaga Ahli</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#peralatan" role="tab"><span><i class="glyphicon glyphicon-th-list"></i></span> <span class="hidden-xs-down ml-15">Peralatan</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#pengalaman" role="tab"><span><i class="glyphicon glyphicon-th-list"></i></span> <span class="hidden-xs-down ml-15">Pengalaman</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#pajak" role="tab"><span><i class="glyphicon glyphicon-th-list"></i></span> <span class="hidden-xs-down ml-15">Pajak</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#foto_kantor_workshop" role="tab"><span><i class="glyphicon glyphicon-picture"></i></span> <span class="hidden-xs-down ml-15">Foto Kantor dan / Workshop</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sertifikat" role="tab"><span><i class="glyphicon glyphicon-file"></i></span> <span class="hidden-xs-down ml-15">Sertifikat</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#dokumen" role="tab"><span><i class="glyphicon glyphicon-list"></i></span> <span class="hidden-xs-down ml-15">dokumen</span></a> </li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content tabcontent-border">
								<input type="hidden" id="token" required value="<?php echo $token;?>">
								<input type="hidden" id="token_csrf" required value="<?php echo $token_csrf;?>">
								<div class="tab-pane active" id="identitas_perusahaan" role="tabpanel">
									<!-- <div class="inner-content-div"> -->
									<div class="p-15" id="slimtest4">
										<h3 class="text-info">Identitas Perusahaan</h3>
										<form id="form_id_perusahaan">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<h5>Email<span class="text-danger">*</span></h5>
														<div class="controls">
															<input type="email" name="user_id_usaha" class="form-control" required data-validation-required-message="This field is required" readonly>
														</div>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
													<div class="form-group">
														<h5>Bentuk Usaha <span class="text-danger">*</span></h5>
														<div class="controls">
															<input type="text" name="jenis_usaha" class="form-control" required data-validation-required-message="This field is required" readonly>
														</div>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
													<!-- <div class="form-group">
														<h5>Jenis Usaha<span class="text-danger">*</span></h5>
														<select class="form-control select2" style="width: 100%;">
														<option selected="selected">Alabama</option>
														<option>Alaska</option>
														<option>California</option>
														<option>Delaware</option>
														<option>Tennessee</option>
														<option>Texas</option>
														<option>Washington</option>
														</select>
													</div> -->
													<div class="form-group">
														<h5>Nama Perusahaan <span class="text-danger">*</span></h5>
														<div class="controls">
															<input type="text" name="nm_perusahaan" class="form-control" required data-validation-required-message="This field is required" readonly>
														</div>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
													<div class="form-group">
														<h5>Tahun Pendirian<span class="text-danger">*</span></h5>
														<div class="controls">
															<input type="text" name="thn_pendirian_usaha" class="form-control" required data-validation-required-message="This field is required" readonly>
														</div>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
													<div class="form-group">
														<h5>NPWP<span class="text-danger">*</span></h5>
														<div class="controls">
															<input type="text" name="npwp_usaha" class="form-control" required data-validation-required-message="This field is required" readonly>
														</div>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
													<div class="form-group">
														<h5>No. SIUP/SIUJK/NIB <span class="text-danger">*</span></h5>
														<div class="controls">
															<input type="text" name="no_siup_siujk_nib_usaha" class="form-control" required data-validation-required-message="This field is required">
														</div>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
													<div class="form-group">
														<h5>Alamat Kantor <span class="text-danger">*</span></h5>
														<div class="controls">
															<textarea name="alamat_usaha" class="form-control" required data-validation-required-message="This field is required"></textarea>
														</div>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<h5>Provinsi<span class="text-danger">*</span></h5>
														<div class="controls">
															<select class="form-control select2" name="provinsi" style="width: 100%;"></select>
														</div>
													</div>
													<div class="form-group">
														<h5>Kab. / Kota<span class="text-danger">*</span></h5>
														<select class="form-control select2" name="kab_kota" style="width: 100%;"></select>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
													<div class="form-group">
														<h5>No. Telepon <span class="text-danger">*</span></h5>
														<div class="controls">
															<input type="text" name="no_tlp_perusahaan" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="No Characters Allowed, Only Numbers">
														</div>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
													<div class="form-group">
														<h5>No. Fax Perusahaan <span class="text-danger">*</span></h5>
														<div class="controls">
															<input type="text" name="no_fax_perusahaan" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="No Characters Allowed, Only Numbers">
														</div>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
													<div class="form-group">
														<h5>No. Handphone Perusahaan <span class="text-danger">*</span></h5>
														<div class="controls">
															<input type="text" name="no_hp_perusahaan" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="No Characters Allowed, Only Numbers">
														</div>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
													<div class="form-group">
														<h5>website <span class="text-danger">*</span></h5>
														<div class="controls">
															<input type="url" name="website_perusahaan" class="form-control" required data-validation-required-message="This field is required">
														</div>
														<!-- <div class="form-control-feedback"><small>Add <code>*</code> attribute to field for required validation.</small></div> -->
													</div>
												</div>
											</div>
											<div class="text-xs-right">
												<button type="submit" class="btn btn-lman">Simpan</button>
											</div>
										</form>
										
									</div>
									<!-- </div> -->
								</div>
								<div class="tab-pane" id="izin_usaha" role="tabpanel">
									<!-- class="animation" data-animation="fadeInDownBig" -->
									<h3 class="text-info">Izin Usaha Perusahaan</h3>
									<div class="p-15">
											<div class="text-xs-right">
												<button type="button" class="btn btn-rounded btn-lman mb-5 btn-add-ijin-usaha"><i class="fa fa-plus"></i> Tambah</button> <!-- modal-izin-usaha -->
											</div>
											<div class="table-responsive">
												<table id="tbl_izin_usaha" class="table table-bordered table-striped" style="width: 100%;">
													<thead class="bg-lman">
														<tr>
															<th>Izin Usaha</th>
															<th>Nomor Surat</th>
															<th>Instansi Penerbit</th>
															<th>Berlaku sampai</th>
															<th>Status Verifikasi</th>
															<th>file</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
													</tfoot>
												</table>
											</div>
									</div>
								</div>
								<!-- <div class="tab-pane" id="akta_pendirian" role="tabpanel">
									<div class="p-15">
										<h3>akta_pendirian</h3>
										<p>Duis cursus eros lorem, pretium ornare purus tincidunt eleifend. Etiam quis justo vitae erat faucibus pharetra. Morbi in ullamcorper diam. Morbi lacinia, sem vitae dignissim cursus, massa nibh semper magna, nec pellentesque lorem nisl quis ex.</p>
										<h4>Fusce porta eros a nisl varius, non molestie metus mollis. Pellentesque tincidunt ante sit amet ornare lacinia.</h4>
									</div>
								</div> -->
								<div class="tab-pane" id="pemilik" role="tabpanel">
									<div class="p-15">
										<div class="text-xs-right">
												<button type="button" class="btn btn-rounded btn-lman mb-5 btn-add-pemilik-perusahaan"><i class="fa fa-plus"></i> Tambah</button> <!-- modal-pemilik-perusahaan -->
										</div>
										<div class="table-responsive">
											<table id="tbl_pemilik_usaha" class="table table-bordered table-striped" style="width: 100%;">
												<thead class="bg-lman">
													<tr>
														<th>Nama Pemilik</th>
														<th>Nomor KTP</th>
														<th>Alamat</th>
														<th>Saham</th>
														<th>Status Verifikasi</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
												</tfoot>
											</table>
										</div>	
									</div>
								</div>
								<div class="tab-pane" id="pengurus" role="tabpanel">
									<div class="p-15">
										<div class="text-xs-right">
												<button type="button" class="btn btn-rounded btn-lman mb-5 btn-add-pengurus-perusahaan"><i class="fa fa-plus"></i> Tambah</button> <!-- modal-pemilik-perusahaan -->
										</div>
										<div class="table-responsive">
											<table id="tbl_pengurus_usaha" class="table table-bordered table-striped" style="width: 100%;">
												<thead class="bg-lman">
													<tr>
														<th>Nama</th>
														<th>Alamat</th>
														<th>KTP</th>
														<th>NPWP</th>
														<th>Posisi</th>
														<th>Jabatan</th>
														<th>Kewarganegaraan</th>
														<th>Mulai</th>
														<th>Sampai</th>
														<th>Status Verifikasi</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
												</tfoot>
											</table>
										</div>	
									</div>
								</div>
								<div class="tab-pane" id="tenaga_ahli" role="tabpanel">
									<div class="p-15">
										<div class="text-xs-right">
												<button type="button" class="btn btn-rounded btn-lman mb-5 btn-add-tenagaahli-perusahaan"><i class="fa fa-plus"></i> Tambah</button> <!-- modal-pemilik-perusahaan -->
										</div>
										<div class="table-responsive">
											<table id="tbl_tenagaahli_usaha" class="table table-bordered table-striped" style="width: 100%;">
												<thead class="bg-lman">
													<tr>
														<th>Nama</th>
														<th>Tanggal Lahir</th>
														<th>Pendidikan</th>
														<th>Pengalaman Kerja(Tahun)</th>
														<th>Profesi/Keahlian</th>
														<th>Status Verifikasi</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="peralatan" role="tabpanel">
									<div class="p-15">
										<div class="text-xs-right">
												<button type="button" class="btn btn-rounded btn-lman mb-5 btn-add-peralatan-perusahaan"><i class="fa fa-plus"></i> Tambah</button> <!-- modal-pemilik-perusahaan -->
										</div>
										<div class="table-responsive">
											<table id="tbl_peralatan_usaha" class="table table-bordered table-striped" style="width: 100%;">
												<thead class="bg-lman">
													<tr>
														<th>Nama</th>
														<th>Jumlah</th>
														<th>Kapasitas</th>
														<th>Merk/Type</th>
														<th>Kondisi</th>
														<th>Lokasi Sekarang</th>
														<th>Tahun Pembuatan</th>
														<th>Bukti Milik	</th>
														<th>Status Verifikasi</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="pengalaman" role="tabpanel">
									<div class="p-15">
										<div class="text-xs-right">
												<button type="button" class="btn btn-rounded btn-lman mb-5 btn-add-pengalaman-perusahaan"><i class="fa fa-plus"></i> Tambah</button> <!-- modal-pemilik-perusahaan -->
										</div>
										<div class="table-responsive">
											<table id="tbl_pengalaman_usaha" class="table table-bordered table-striped" style="width: 100%;">
												<thead class="bg-lman">
													<tr>
														<th>Pekerjaan</th>
														<th>Lokasi</th>
														<th>Pemberi Pekerjaan</th>
														<th>Alamat</th>
														<th>Tanggal Kontrak</th>
														<th>Selesai Kontrak</th>
														<th>Status Verifikasi</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="pajak" role="tabpanel">
									<h3 class="text-info">Data Pajak Perusahaan</h3>
									<div class="p-15">
											<div class="text-xs-right">
												<button type="button" class="btn btn-rounded btn-lman mb-5 btn-add-pajak-perusahaan"><i class="fa fa-plus"></i> Tambah</button> <!-- modal-izin-usaha -->
											</div>
											<div class="table-responsive">
												<table id="tbl_pajak_usaha" class="table table-bordered table-striped" style="width: 100%;">
													<thead class="bg-lman">
														<tr>
															<th>Pajak</th>
															<th>Tanggal</th>
															<th>Nomor Bukti</th>
															<th>Status Verifikasi</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
													</tfoot>
												</table>
											</div>
									</div>
								</div>
								<div class="tab-pane" id="foto_kantor_workshop" role="tabpanel">
									<h3 class="text-info">Foto Kantor / Workshop</h3>
									<div class="p-15">
										<div class="text-xs-right">
															<!-- <div class="kt-wizard-v2__form">
                                								<input type="hidden" id="s3_bucket" name="s3_bucket" value="" class="data-foto-aset">
                                								<input type="hidden" id="s3_object" name="s3_object" value="" class="data-foto-aset">
    															<div class="form-group m-form__group row">
    																<div class="col-xl-12 col-lg-12">
                                            								<div id="form_data"></div>
                                            								<div class="btn-file btn btn-success btn-block">
                                            									<span id="file_upload_cont" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Uploading.." data-default-text="<i class='fa fa-upload'></i> &nbsp; Pilih dan Upload Foto">
                                            										<i class="fa fa-upload"></i> &nbsp; Pilih dan Upload Foto
                                            									</span>
                                            									<input id="file_upload" type="file" name="file" />
                                            								</div>
                                            							<style>
                                            								.btn-file {
                                            								  position: relative;
                                            								}
                                            								  
                                            								.btn-file input { 
                                            								    position: absolute;
                                            								    top: 0;
                                            								    left: 0;
                                            								    opacity: 0;
                                            								    width: 100%;
                                            								    height: 100%;
                                            								    cursor: pointer;
                                            								}
                                            								.primary-image {
                                            								    border: 2px solid #36a3f7;
                                            								    background-color: #d5eef9;;
                                            								}
                                            							</style>
    																</div>
    															</div>

    														</div> -->
												<button type="button" class="btn btn-rounded btn-lman mb-5 btn-add-fotokantor-perusahaan"><i class="fa fa-plus"></i> Tambah Data Foto</button> <!-- modal-add foto -->
										</div>
										<div class="row fx-element-overlay">
											<div class="col-12 col-lg-6 col-xl-4">
												<div class="box box-default">
													<div class="fx-card-item">
														<div class="fx-card-avatar fx-overlay-1"> <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-1.png" alt="user">
															<div class="fx-overlay scrl-up">						
																<ul class="fx-info">
																	<li><a class="btn btn-outline image-popup-vertical-fit" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-1.png" title="View Picture"><i class="mdi mdi-magnify"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-delete"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-settings"></i></a></li>
																</ul>
															</div>
														</div>
														<div class="fx-card-content text-left mb-0">							
															<div class="product-text">
																<!-- <h2 class="pro-price text-blue">$270</h2> -->
																<h4 class="box-title mb-0">Foto Kantor</h4>
																<!-- <small class="text-muted db">Lorem Ipsum Dummy Text</small> -->
															</div>
														</div>
													</div>
												</div>
												<!-- /.box -->				  
											</div>
											<div class="col-12 col-lg-6 col-xl-4">
												<div class="box box-default">
													<div class="fx-card-item">
														<div class="fx-card-avatar fx-overlay-1"> <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-2.png" alt="user">
															<div class="fx-overlay scrl-up">						
																<ul class="fx-info">
																	<li><a class="btn btn-outline image-popup-vertical-fit" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-2.png"><i class="mdi mdi-magnify"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-delete"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-settings"></i></a></li>
																</ul>
															</div>
														</div>
														<div class="fx-card-content text-left mb-0">							
															<div class="product-text">
																<!-- <h2 class="pro-price text-blue">$270</h2> -->
																<h4 class="box-title mb-0">Foto Kantor</h4>
																<!-- <small class="text-muted db">Lorem Ipsum Dummy Text</small> -->
															</div>
														</div>
													</div>
												</div>
												<!-- /.box -->				  
											</div>
											<div class="col-12 col-lg-6 col-xl-4">
												<div class="box box-default">
													<div class="fx-card-item">
														<div class="fx-card-avatar fx-overlay-1"> <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-3.png" alt="user">
															<div class="fx-overlay scrl-up">						
																<ul class="fx-info">
																	<li><a class="btn btn-outline image-popup-vertical-fit" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-3.png"><i class="mdi mdi-magnify"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-delete"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-settings"></i></a></li>
																</ul>
															</div>
														</div>
														<div class="fx-card-content text-left mb-0">							
															<div class="product-text">
																<!-- <h2 class="pro-price text-blue">$270</h2> -->
																<h4 class="box-title mb-0">Foto Kantor</h4>
																<!-- <small class="text-muted db">Lorem Ipsum Dummy Text</small> -->
															</div>
														</div>
													</div>
												</div>
												<!-- /.box -->				  
											</div>
											<div class="col-12 col-lg-6 col-xl-4">
												<div class="box box-default">
													<div class="fx-card-item">
														<div class="fx-card-avatar fx-overlay-1"> <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-4.png" alt="user">
															<div class="fx-overlay scrl-up">						
																<ul class="fx-info">
																	<li><a class="btn btn-outline image-popup-vertical-fit" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-4.png"><i class="mdi mdi-magnify"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-delete"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-settings"></i></a></li>
																</ul>
															</div>
														</div>
														<div class="fx-card-content text-left mb-0">							
															<div class="product-text">
																<!-- <h2 class="pro-price text-blue">$270</h2> -->
																<h4 class="box-title mb-0">Foto Kantor</h4>
																<!-- <small class="text-muted db">Lorem Ipsum Dummy Text</small> -->
															</div>
														</div>
													</div>
												</div>
												<!-- /.box -->				  
											</div>
											<div class="col-12 col-lg-6 col-xl-4">
												<div class="box box-default">
													<div class="fx-card-item">
														<div class="fx-card-avatar fx-overlay-1"> <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-5.png" alt="user">
															<div class="fx-overlay scrl-up">						
																<ul class="fx-info">
																	<li><a class="btn btn-outline image-popup-vertical-fit" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-5.png"><i class="mdi mdi-magnify"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-delete"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-settings"></i></a></li>
																</ul>
															</div>
														</div>
														<div class="fx-card-content text-left mb-0">							
															<div class="product-text">
																<!-- <h2 class="pro-price text-blue">$270</h2> -->
																<h4 class="box-title mb-0">Foto Kantor</h4>
																<!-- <small class="text-muted db">Lorem Ipsum Dummy Text</small> -->
															</div>
														</div>
													</div>
												</div>
												<!-- /.box -->				  
											</div>
											<div class="col-12 col-lg-6 col-xl-4">
												<div class="box box-default">
													<div class="fx-card-item">
														<div class="fx-card-avatar fx-overlay-1"> <img src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-6.png" alt="user">
															<div class="fx-overlay scrl-up">						
																<ul class="fx-info">
																	<li><a class="btn btn-outline image-popup-vertical-fit" href="<?php echo $this->config->item('static_file_url').PLATFORM_PATH; ?>cms/images/product/product-6.png"><i class="mdi mdi-magnify"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-delete"></i></a></li>
																	<li><a class="btn btn-outline" href="javascript:void(0);"><i class="mdi mdi-settings"></i></a></li>
																</ul>
															</div>
														</div>
														<div class="fx-card-content text-left mb-0">							
															<div class="product-text">
																<!-- <h2 class="pro-price text-blue">$270</h2> -->
																<h4 class="box-title mb-0">Foto Kantor</h4>
																<!-- <small class="text-muted db">Lorem Ipsum Dummy Text</small> -->
															</div>
														</div>
													</div>
												</div>
												<!-- /.box -->				  
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="sertifikat" role="tabpanel">
									<h3 class="text-info">Data Sertifikat Perusahaan</h3>
									<div class="p-15">
											<div class="text-xs-right">
												<button type="button" class="btn btn-rounded btn-lman mb-5 btn-add-sertifikat-perusahaan"><i class="fa fa-plus"></i> Tambah</button> <!-- modal-izin-usaha -->
											</div>
											<div class="table-responsive">
												<table id="tbl_sertifikat_usaha" class="table table-bordered table-striped" style="width: 100%;">
													<thead class="bg-lman">
														<tr>
															<th>Nomor Sertifikat</th>
															<th>Keterangan</th>
															<th>Status Verifikasi</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
													</tfoot>
												</table>
											</div>
									</div>
								</div>
								<div class="tab-pane" id="dokumen" role="tabpanel">
									<div class="p-15">
										<h3>Doikument</h3>
										<p>Duis cursus eros lorem, pretium ornare purus tincidunt eleifend. Etiam quis justo vitae erat faucibus pharetra. Morbi in ullamcorper diam. Morbi lacinia, sem vitae dignissim cursus, massa nibh semper magna, nec pellentesque lorem nisl quis ex.</p>
										<h4>Fusce porta eros a nisl varius, non molestie metus mollis. Pellentesque tincidunt ante sit amet ornare lacinia.</h4>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				
			</div>	

			<!-- Modal -->
			<div id="modal-izin-usaha" class="modal center-modal fade" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-lman">
							<h5 class="modal-title" id="modal-izin-usaha-title"></h5>
							<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="form_add_izin_usaha">
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-form-label col-md-4">Jenis Dokumen</label>
											<div class="col-md-8">
												<input class="form-control" type="hidden" name="proses_jenis" required>
												<input class="form-control" type="hidden" name="id_token">
												<select class="form-control select2" name="jenis_dokumen_ijin_usaha" style="width: 100%;" required></select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Nomor</label>
											<div class="col-md-8">
												<input class="form-control" type="text" name="nomor_izin_usaha" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Penerbit</label>
											<div class="col-md-8">
												<input class="form-control" type="text" name="penerbit_izin_usaha" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Tlp. Penerbit</label>
											<div class="col-md-8">
												<input class="form-control" type="number" name="tlp_penerbit" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-form-label col-md-4">Tgl Terbit</label>
											<div class="col-md-8">
												<input class="form-control" type="date" name="tgl_terbit" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Berlaku Sampai</label>
											<div class="col-md-8">
												<input class="form-control" type="date" name="berlaku_sampai">
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Kualifikasi</label>
											<div class="col-md-8">
												<select class="form-control select2" name="kualifikasi_ijin_usaha" style="width: 100%;" required></select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">keterangan</label>
											<div class="col-md-8">
												<textarea class="form-control" name="keterangan_ijin_usaha" style="width: 100%;" required></textarea>
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="modal-footer modal-footer-uniform">
								<button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
							<div class="modal-footer modal-footer-uniform float-right">
								<button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>

			<!-- modal-pemilik-usaha -->
			<div id="modal-pemilik-usaha" class="modal center-modal fade" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-lman">
							<h5 class="modal-title" id="modal-pemilik-usaha-title"></h5>
							<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="form_add_pemilik_usaha">
							<div class="modal-body">
								<div class="form-group row">
									<label class="col-form-label col-md-4">Nama Pemilik</label>
									<div class="col-md-8">
										<input class="form-control" type="hidden" name="proses_jns_pemilik_usaha" required>
										<input class="form-control" type="hidden" name="id_token_pemilik">
										<input class="form-control" type="text" name="nama_pemilik_usaha" required>
										<span class="form-text text-muted"><code>*</code></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-4">Nomor KTP</label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="ktp_pemilik_usaha" required>
										<span class="form-text text-muted"><code>*</code></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-4">Alamat</label>
									<div class="col-md-8">
										<textarea class="form-control"  name="alamat_pemilik_usaha" required></textarea>
										<span class="form-text text-muted"><code>*</code></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-4">Saham</label>
									<div class="col-md-8">
										<input class="form-control" type="number" name="saham_pemilik_usaha" required>
										<span class="form-text text-muted"><code>*</code></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-4">Saham</label>
									<div class="col-md-8">
										<select class="form-control select2" name="satuan_saham_pemilik_usaha" style="width: 100%;" required>
											<option value="">Satuan Saham</option>
											<option value="Lembar">Lembar</option>
											<option value="Persen">Persen</option>
										</select>
										<span class="form-text text-muted"><code>*</code></span>
									</div>
								</div>
							</div>
							<div class="modal-footer modal-footer-uniform">
								<button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
							<div class="modal-footer modal-footer-uniform float-right">
								<button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>
			<!-- modal-pengurus-usaha -->
			<div id="modal-pengurus-usaha" class="modal center-modal fade" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-lman">
							<h5 class="modal-title" id="modal-pengurus-usaha-title"></h5>
							<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="form_add_pengurus_usaha">
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-form-label col-md-4">Nama</label>
											<div class="col-md-8">
												<input class="form-control" type="hidden" name="proses_jns_pengurus_usaha" required>
												<input class="form-control" type="hidden" name="id_token_pengurus">
												<input class="form-control" type="text" name="nama_pengurus_usaha" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Nomor KTP</label>
											<div class="col-md-8">
												<input class="form-control" type="text" name="ktp_pengurus_usaha" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Nomor NPWP</label>
											<div class="col-md-8">
												<input class="form-control" type="number" name="npwp_pengurus_usaha" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Alamat</label>
											<div class="col-md-8">
												<textarea class="form-control"  name="alamat_pengurus_usaha" required></textarea>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-form-label col-md-4">Posisi</label>
											<div class="col-md-8">
												<select class="form-control select2" name="posisi_pengurus_usaha" style="width: 100%;" required>
													<option value="">Posisi</option>
													<option value="DEWAN KOMISARIS">DEWAN KOMISARIS</option>
													<option value="DEWAN DIREKSI">DEWAN DIREKSI</option>
													<option value="MANAJER">MANAJER</option>
												</select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Jabatan</label>
											<div class="col-md-8">
												<input class="form-control" type="text" name="jabatan_pengurus_usaha" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Kewarganegaraan</label>
											<div class="col-md-8">
												<select class="form-control select2" name="kewarganegaraan_pengurus_usaha" style="width: 100%;" required>
													<option value="">Pilih Warga Negara</option>
													<option value="WNI">WNI</option>
													<option value="WNA">WNA</option>
												</select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Menjabat Sejak</label>
											<div class="col-md-8">
												<input type="date" class="form-control"  name="tgl_mulai_pengurus_usaha" required></input>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Sampai</label>
											<div class="col-md-8">
												<input type="date" class="form-control" placeholder="Sekarang" name="tgl_selesai_pengurus_usaha">
												<span class="form-text text-muted"><code>Kosongkan jika masih menjabat</code></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer modal-footer-uniform">
								<button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
							<div class="modal-footer modal-footer-uniform float-right">
								<button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>
			<div id="modal-tenagaahli-usaha" class="modal center-modal fade" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-lman">
							<h5 class="modal-title" id="modal-tenagaahli-usaha-title"></h5>
							<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="form_add_tenagaahli_usaha">
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-form-label col-md-4">Nama</label>
											<div class="col-md-8">
												<input class="form-control" type="hidden" name="proses_jns_tenagaahli_usaha" required>
												<input class="form-control" type="hidden" name="id_token_tenagaahli">
												<input class="form-control" type="text" name="nama_tenagaahli_usaha" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Tanggal Lahir</label>
											<div class="col-md-8">
												<input type="date" class="form-control"  name="tgl_lahir_tenagaahli" required></input>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Alamat</label>
											<div class="col-md-8">
												<textarea class="form-control"  name="alamat_tenagaahli" required></textarea>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Pendidikan Terakhir</label>
											<div class="col-md-8">
												<select class="form-control select2" name="pendidikan_akhir_tenagaahli" style="width: 100%;" required>
													<option value="">Pendidikan Terakhir</option>
													<option value="SD">SD</option>
													<option value="SMP">SMP</option>
													<option value="SMA">SMA</option>
													<option value="D1">D1</option>
													<option value="D2">D2</option>
													<option value="D3">D3</option>
													<option value="S1">S1</option>
													<option value="S2">S2</option>
													<option value="S3">S3</option>
												</select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Email</label>
											<div class="col-md-8">
												<input class="form-control" type="email" name="email_tenagaahli" >
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Profesi/Keahlian</label>
											<div class="col-md-8">
												<textarea class="form-control"  name="profesi_keahlian_tenagaahli" required></textarea>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-form-label col-md-4">Jenis Kelamin</label>
											<div class="col-md-8">
												<select class="form-control select2" name="jenis_kelamin_tenagaahli" style="width: 100%;" required>
													<option value="">Jenis Kelamin</option>
													<option value="Pria">Pria</option>
													<option value="Wanita">Wanita</option>
												</select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Kewarganegaraan</label>
											<div class="col-md-8">
												<select class="form-control select2" name="kewarganegaraan_tenagaahli" style="width: 100%;" required>
													<option value="">Pilih Warga Negara</option>
													<option value="WNI">WNI</option>
													<option value="WNA">WNA</option>
												</select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Pengalaman Kerja (tahun)</label>
											<div class="col-md-8">
												<input class="form-control" type="number" name="lama_pengalaman_tenagaahli" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Status Kepegawaian</label>
											<div class="col-md-8">
												<select class="form-control select2" name="status_tenagaahli" style="width: 100%;" required>
													<option value="">Pilih Status Kepegawaian</option>
													<option value="Permanen">Permanen</option>
													<option value="Kontrak">Kontrak</option>
													<option value="Outsourcing">Outsourcing</option>
												</select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Jabatan</label>
											<div class="col-md-8">
												<input class="form-control" type="text" name="jabatan_tenagaahli">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer modal-footer-uniform">
								<button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
							<div class="modal-footer modal-footer-uniform float-right">
								<button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>

			<!-- modal peralatan -->
			<div id="modal-peralatan-usaha" class="modal center-modal fade" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-lman">
							<h5 class="modal-title" id="modal-peralatan-usaha-title"></h5>
							<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="form_add_peralatan_usaha">
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-form-label col-md-4">Nama Alat</label>
											<div class="col-md-8">
												<input class="form-control" type="hidden" name="proses_jns_peralatan_usaha" required>
												<input class="form-control" type="hidden" name="id_token_peralatan">
												<input class="form-control" type="text" name="nama_peralatan_usaha" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Jumlah</label>
											<div class="col-md-8">
												<input type="number" class="form-control" name="jumlah_peralatan" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Jenis</label>
											<div class="col-md-8">
												<select class="form-control select2" name="jenis_peralatan" style="width: 100%;" required>
													<option value="">Jenis</option>
													<option value="Teknologi Informasi">Teknologi Informasi</option>
													<option value="Transportasi">Transportasi</option>
													<option value="Permesinan">Permesinan</option>
												</select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Status</label>
											<div class="col-md-8">
												<select class="form-control select2" name="status_peralatan" style="width: 100%;" required>
													<option value="">Status</option>
													<option value="Milik Sendiri">Milik Sendiri</option>
													<option value="Sewa">Sewa</option>
													<option value="Dukungan">Dukungan</option>
												</select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Lokasi Sekarang</label>
											<div class="col-md-8">
												<input type="text" class="form-control"  name="lokasi_peralatan">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-form-label col-md-4">Merk/Type</label>
											<div class="col-md-8">
												<input class="form-control"  name="merk_tipe_peralatan">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Spesifikasi</label>
											<div class="col-md-8">
												<input class="form-control" name="spesifikasi_peralatan" >
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Kapasitas</label>
											<div class="col-md-8">
												<input type="text" class="form-control"  name="kapasitas_peralatan">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Tahun Pembuatan</label>
											<div class="col-md-8">
												<input type="number" class="form-control"  name="thn_buat_peralatan" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Tahun Perolehan</label>
											<div class="col-md-8">
												<input type="number" class="form-control"  name="thn_perolehan_peralatan">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Kondisi</label>
											<div class="col-md-8">
												<select class="form-control select2" name="kondisi_peralatan" style="width: 100%;">
													<option value="">Kondisi</option>
													<option value="Baik">Baik</option>
													<option value="Rusak">Rusak</option>
												</select>
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										<!-- bukti_milik_peralatan -->
										<div class="form-group row">
											<label class="col-form-label col-md-4">Bukti Kepemilikan</label>
											<div class="col-md-8">
												<input type="text" class="form-control"  name="bukti_milik_peralatan">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										
									</div>
								</div>
							</div>
							<div class="modal-footer modal-footer-uniform">
								<button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
							<div class="modal-footer modal-footer-uniform float-right">
								<button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>
			

			<!-- modal pengalaman -->
			<div id="modal-pengalaman-usaha" class="modal center-modal fade" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-lman">
							<h5 class="modal-title" id="modal-pengalaman-usaha-title"></h5>
							<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="form_add_pengalaman_usaha">
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-form-label col-md-4">Nama Kontrak</label>
											<div class="col-md-8">
												<input class="form-control" type="hidden" name="proses_jns_pengalaman_usaha" required>
												<input class="form-control" type="hidden" name="id_token_pengalaman">
												<textarea class="form-control" name="nama_pengalaman_usaha" required></textarea>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Klasifikasi</label>
											<div class="col-md-8">
												<select class="form-control select2" name="klasifikasi_pengalaman" style="width: 100%;" required>
												</select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Lokasi</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="lokasi_pengalaman" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Instansi</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="instansi_pengalaman" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Alamat</label>
											<div class="col-md-8">
												<textarea class="form-control" name="alamat_pengalaman"></textarea>
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Nomor Telepon</label>
											<div class="col-md-8">
												<input type="number" class="form-control" name="no_tlp_pengalaman">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Nomor Kontrak</label>
											<div class="col-md-8">
												<input type="text" class="form-control" name="no_kontrak__pengalaman">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-form-label col-md-4">Nilai Kontrak</label>
											<div class="col-md-8">
												<div class="input-group">
													<div class="input-group-prepend">
														<select class="form-control select2 bg-blue" name="mata_uang_pengalaman" required>
															<option value="">Jenis</option>
															<option value="IDR">IDR</option>
															<option value="USD">USD</option>
															<!-- <option value="SGR">SGR</option> -->
														</select>
													</div>
													<input type="number" class="form-control" name="nilai_pengalaman" required>
												</div>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Tanggal Kontrak</label>
											<div class="col-md-8">
												<input type="date" class="form-control" name="tgl_kontrak_pengalaman">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Tanggal Pelaksanaan</label>
											<div class="col-md-8">
												<input type="date" class="form-control" name="tgl_mulai_pengalaman">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Selesai Kontrak</label>
											<div class="col-md-8">
												<input type="date" class="form-control" name="tgl_selesai_pengalaman">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Persentase Pelaksanaan</label>
											<div class="col-md-8">
												<div class="input-group mb-3">
													<input type="number" class="form-control" name="persentase_pengalaman" required>
													<div class="input-group-append">
														<span class="input-group-text">%</span>
													</div>
												</div>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Denda</label>
											<div class="col-md-8">
												<select class="form-control select2 bg-blue" name="denda_pengalaman" style="width: 100%;" required>
													<option value="">Pilih Status Denda</option>
													<option value="1">Ya</option>
													<option value="0">Tidak</option>
												</select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-form-label col-md-4">Tanggal Serah Terima</label>
											<div class="col-md-8">
												<input type="date" class="form-control" name="tgl_bast_pengalaman">
												<!-- <span class="form-text text-muted"><code>*</code></span> -->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer modal-footer-uniform">
								<button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
							<div class="modal-footer modal-footer-uniform float-right">
								<button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>

			<!-- Modal Pajak -->
			<div id="modal-pajak-usaha" class="modal center-modal fade" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-lman">
							<h5 class="modal-title" id="modal-pajak-usaha-title"></h5>
							<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="form_add_pajak_usaha">
							<div class="modal-body">
								<div class="form-group row">
									<label class="col-form-label col-md-4">Jenis Pajak</label>
									<div class="col-md-8">
										<input class="form-control" type="hidden" name="proses_jns_pajak_usaha" required>
										<input class="form-control" type="hidden" name="id_token_pajak">
										<input class="form-control" type="text" name="nama_pajak_usaha" required>
										<span class="form-text text-muted"><code>*</code></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-4">Masa Pajak Tahunan</label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="masa_pajak_usaha" required>
										<span class="form-text text-muted"><code>*</code></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-4">Nomor Bukti Pajak</label>
									<div class="col-md-8">
										<input class="form-control" type="text" name="no_bukti_pajak_usaha" required>
										<span class="form-text text-muted"><code>*</code></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-4">Tanggal Bukti Penerimaan</label>
									<div class="col-md-8">
										<input class="form-control" type="date" name="tgl_bukti_terima_pajak_usaha" required>
										<span class="form-text text-muted"><code>*</code></span>
									</div>
								</div>
							</div>
							<div class="modal-footer modal-footer-uniform">
								<button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
							<div class="modal-footer modal-footer-uniform float-right">
								<button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>

			<!-- Foto dan Video -->
			<div id="modal-fotokantor-usaha" class="modal center-modal fade" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-lman">
							<h5 class="modal-title" id="modal-fotokantor-usaha-title"></h5>
							<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="form_add_fotokantor_usaha">
							<div class="modal-body">
								<div class="form-group row">
									<label class="col-form-label col-md-4">Keterangan Foto</label>
									<div class="col-md-8">
										<input class="form-control" type="hidden" name="proses_jns_fotokantor_usaha" required>
										<input class="form-control" type="hidden" name="id_token_fotokantor">
										<input class="form-control" type="text" name="nama_fotokantor_usaha" required>
										<span class="form-text text-muted"><code>*</code></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-4">Pilih Foto</label>
									<div class="col-md-8">
										<input class="form-control" id="file_upload" type="file" name="file" required/>
										<span class="form-text text-muted"><code>*</code></span>
									</div>
								</div>
								<div class="form-group row">
									<!-- <label class="col-form-label col-md-4"></label> -->
									<div class="col-md-12">
										<center>
											<img id="preview_image" alt="Preview Image" accept="image/*" style="display:none;"/>
										</center>
									</div>
								</div>
							</div>
							<div class="modal-footer modal-footer-uniform">
								<button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
							<div class="modal-footer modal-footer-uniform float-right">
								<button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>
			

			<!-- modal Sertifikat -->
			<div id="modal-sertifikat-usaha" class="modal center-modal fade" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-lman">
							<h5 class="modal-title" id="modal-sertifikat-usaha-title"></h5>
							<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="form_add_sertifikat_usaha">
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group row">
											<label class="col-form-label col-md-4">Klasifikasi</label>
											<div class="col-md-8">
												<input class="form-control" type="hidden" name="proses_jns_sertifikat_usaha" required>
												<input class="form-control" type="hidden" name="id_token_sertifikat">
												<!-- <div class="col-md-8"> -->
												<select class="form-control select2" name="klasifikasi_sertifikat" style="width: 100%;" required>
												<!-- <select class="form-control select2" name="klasifikasi_sertifikat" style="width: 100%;" required> -->
												</select>
												<span class="form-text text-muted"><code>*</code></span>
												<!-- </div>\ -->
											</div>
										</div>
										<div class="div-sub-Klasifikasi">
											<div class="form-group row">
												<label class="col-form-label col-md-4">Sub Klasifikasi</label>
												<div class="col-md-8">
													<select class="form-control select2" name="sub_klasifikasi_sertifikat" style="width: 100%;display:block;" required>
													</select>
													<span class="form-text text-muted"><code>*</code></span>
												</div>
											</div>
										</div>
										<div class="form-group row div-kualifikasi">
											<label class="col-form-label col-md-4">Kualifikasi</label>
											<div class="col-md-8">
												<select class="form-control select2" name="kualifikasi_sertifikat" style="width: 100%;" required>
												</select>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="div-sub-kualifikasi">
											<div class="form-group row">
												<label class="col-form-label col-md-4">Sub Kualifikasi</label>
												<div class="col-md-8">
													<select class="form-control select2" name="sub_kualifikasi_sertifikat" style="width: 100%;" required>
													</select>
													<span class="form-text text-muted"><code>*</code></span>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Keterangan</label>
											<div class="col-md-8">
												<textarea class="form-control" name="keterangan_sertifikat" required></textarea>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Nomor Sertifikasi</label>
											<div class="col-md-8">
												<input Type="text" class="form-control" name="nomor_sertifikat" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Berlaku Mulai</label>
											<div class="col-md-8">
												<input type="date" class="form-control" name="berlaku_mulai_sertifikat" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-4">Berlaku Sampai</label>
											<div class="col-md-8">
												<input type="date" class="form-control" name="berlaku_sampai_sertifikat" required>
												<span class="form-text text-muted"><code>*</code></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer modal-footer-uniform">
								<button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
							<div class="modal-footer modal-footer-uniform float-right">
								<button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		
  