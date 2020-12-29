
				 <style>
					.modal {
						/* other stuff we already covered */
						height: 100%;
						max-height: 100%;

					}
				</style>   
			<div class="row">

				<div class="col-6">
					<div class="box">
						<div class="box-header">
							<h4 class="box-title">Ganti Password</h4>  
						</div>
						<form id="form-ganti-password">
							<div class="box-body">
								<div class="form-group row">
									<label class="col-form-label col-md-3">Password Lama</label>
									<div class="col-md-9">
										<div class="input-group mb-3">
											<input type="hidden" id="token_id" required value="<?php echo $id;?>">
											<input type="hidden" id="token" required value="<?php echo $token;?>">
											<input type="hidden" id="token_csrf" required value="<?php echo $token_csrf;?>">
											<div class="input-group-prepend">
												<span class="input-group-text bg-lman bt-0 bl-0 br-0 no-radius text-white"><i class="ti-lock"></i></span>
											</div>
											<input type="password" class="form-control pl-15 bg-transparent bt-0 bl-0 br-0 text-lman" name="password_lama" placeholder="Password Lama" required>
										</div>
										<span class="form-text text-muted"> <code>*</code></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-3">Password Baru</label>
									<div class="col-md-9">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-lman bt-0 bl-0 br-0 no-radius text-white"><i class="ti-lock"></i></span>
											</div>
											<input type="password" class="form-control pl-15 bg-transparent bt-0 bl-0 br-0 text-lman" name="password_baru" placeholder="Password Baru" required>
										</div>
										<span class="form-text text-muted"> <code>*</code></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-md-3">Ulangi Password</label>
									<div class="col-md-9">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-lman bt-0 bl-0 br-0 no-radius text-white"><i class="ti-lock"></i></span>
											</div>
											<input type="password" class="form-control pl-15 bg-transparent bt-0 bl-0 br-0 text-lman" name="password_baru2" placeholder="Ulangi Password" required>
										</div>
										<span class="form-text text-muted"> <code>*</code></span>
									</div>
								</div>
								
							</div>
							<div class="modal-footer modal-footer-uniform float-right">
								<button type="submit" class="btn btn-bold btn-pure btn-lman float-right">Simpan</button>
							</div>
						</form>
					</div>
				</div>
		  	</div>
