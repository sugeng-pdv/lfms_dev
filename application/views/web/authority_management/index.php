						
						<div class="card card-custom">
							<div class="card-header">
								<div class="card-title">
											<span class="card-icon">
												<i class="flaticon2-supermarket text-primary"></i>
											</span>
											<h3 class="card-label">Authority Manajemen</h3>
										</div>
								<div class="card-toolbar">
									<button  class="btn btn-lman font-weight-bolder" id="btn_add_authority">
									<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>Tambah Authority Baru</a>
									<!--end::Button-->
								</div>
							</div>
							<div class="card-body">
								<!--begin: Datatable-->
								<table class="table table-bordered table-hover table-checkable" id="authority_tbl" style="margin-top: 13px !important">
									<thead>
										<tr>
										    <th>NO</th>
											<th>ROLE</th>
											<th>MENU</th>
											<th>AUTHORITY</th>
											<th>PILIHAN</th>
										</tr>
										</thead>
								</table>
								<!--end: Datatable-->
							</div>
			    		</div>
						<!--end::Card-->
				        <!-- Modal-->
                        <div class="modal fade" id="modalAuthority" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                         <h5 class="modal-title" id="AuthorityModalLabel">Tambah Authority Baru</h5>
                        
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i aria-hidden="true" class="ki ki-close"></i>
                        
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Role</label><span class="text-danger">&nbsp;*</span>
                                            <div class="col-sm-12">
												<select class="form-control select2" id="role" name="role" required>
                                                </select>
                                            </div>
                                            <input id="status" type="hidden" readonly="true">
                                            <input id="id" type="hidden" readonly="true">
                                        </div>
                                        <div class="form-group">
                                            <label>Menu<span class="text-danger">&nbsp;*</span></label>
                                            <div class="col-sm-12">
												<select class="form-control select2" id="menu" name="menu" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Authority<span class="text-danger">&nbsp;*</span></label>
                                            <div class="col-sm-12">
												<select class="form-control select2" id="authority" name="authority" required>
												    <option value=""></option>
                                                    <option value="R">READ</option>
                                                    <option value="RW">READ , WRITE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
                                        <button onclick="saveAuthority();" type="button" class="btn btn-success font-weight-bold">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>	
								<?php if(isset($js) ){ foreach ($js as $js){ ?>
                                    <script type="text/javascript" src="<?php echo $this->config->item('static_file_url').PLATFORM_PATH.$js; ?>"></script>
                                <?php }} ?>