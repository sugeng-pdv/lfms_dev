<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('email/header'); ?>
			<!-- Judul -->
			<tr>
				<td style="text-align:center;border-collapse:collapse;background:#ffffff;">
					<table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="240">
						<tbody>
							<tr>
								<td align="center">
								<img src="https://www.djkn.kemenkeu.go.id/static/lelang/email/divider.png" editable="true" style="display: block;" alt="divider" height="4" width="240">
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			
	    	<tr>
	        	<td style="padding-top:30px;border-collapse:collapse;background:#ffffff;">
	        		<center><span style="color: #013569; font-size: 24px; font-family: Helvetica, Arial, sans-serif;" class="main-header" align="center">AKUN ANDA TELAH AKTIF</span></center>
				</td>
	        </tr>
			<!-- Akhir Judul -->
	        
	        <!-- Divider -->
			<tr>
				<td style="padding:30px 0px;text-align:center;border-collapse:collapse;background:#ffffff;">
					<table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="240">
						<tbody>
							<tr>
								<td align="center">
								<img src="https://www.djkn.kemenkeu.go.id/static/lelang/email/divider.png" editable="true" style="display: block;" alt="divider" height="4" width="240">
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
	        <!-- Akhir Divider -->
	        
			<!-- Isi Email -->
			<tr>
				<td style="padding:30px;text-align:justify;border-collapse:collapse;background:#ffffff;">
					<table class="section-item" align="left" border="0" cellpadding="0" cellspacing="0" width="100%"><tbody>
						<tr>
							<td mc:edit="title4" style="color: #013569; font-size: 17px; font-weight: bold; font-family: Helvetica, Arial, sans-serif;" class="section-title">
							Yth. <?php if (isset($nama)){ echo strtoupper($nama); } ?>
							</td>	
						</tr>
						<tr><td height="15"></td></tr>
						<tr>
							<td mc:edit="subtitle4" style="color: #111; font-size: 14px; font-family: Helvetica, Arial, sans-serif; line-height: 24px;">
							Bersama ini kami sampaikan bahwa akun Anda telah aktif. Selanjutnya Anda dapat sign in (masuk) menggunakan alamat email <b><?php if (isset($email)){ echo $email; } ?></b>.
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
			<!-- Akhir Isi Email -->
			
	        <!-- Divider -->
			<tr>
				<td style="padding:10px 30px 0px;text-align:center;border-collapse:collapse;background:#ffffff;">
					<table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="240">
						<tbody>
							<tr>
								<td align="center">
								<img src="https://www.djkn.kemenkeu.go.id/static/lelang/email/divider.png" editable="true" style="display: block;" alt="divider" height="4" width="240">
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
	        <!-- Akhir Divider -->
	        
			<!-- Petunjuk Penggunaan -->
			<tr>
				<td style="padding:30px;text-align:justify;border-collapse:collapse;background:#ffffff;">
					
					<table class="section-item" align="left" border="0" cellpadding="0" cellspacing="0" width="100%"><tbody>
						<tr>
							<td style="padding-right:20px;">
								<img src="https://www.djkn.kemenkeu.go.id/static/lelang/email/icon-petunjuk-penggunaan.png" editable="true" style="display: block;" alt="petunjuk penggunaan" height="150" width="150">
							</td>
							<td>
								<table class="section-item" align="left" border="0" cellpadding="0" cellspacing="0" width="100%"><tbody>
									<tr>
										<td mc:edit="title4" style="color: #013569; font-size: 17px; font-weight: bold; font-family: Helvetica, Arial, sans-serif;" class="section-title">
										Petunjuk Penggunaan
										</td>	
									</tr>
									<tr><td height="5"></td></tr>
									<tr>
										<td mc:edit="subtitle4" style="color: #111; font-size: 14px; font-family: Helvetica, Arial, sans-serif; line-height: 24px;">
										Berikut ini kami sertakan petunjuk penggunaan untuk mempermudah Anda dalam mengikuti lelang melalui aplikasi yang telah kami sediakan. 
										<br /><br />
										<a href="<?php echo base_url().'petunjuk_penggunaan'; ?>" style="text-decoration:none;"><span style="color: #FFF; border: solid 1px #003568;background-color:#428bca;margin-top:20px;padding: 7px 15px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">Baca Petunjuk Penggunaan </span></a>
										
										</td>
									</tr>
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
				
				</td>
			</tr>
			<!-- Akhir Petunjuk Penggunaan -->
	        
	        <!-- Divider -->
			<tr>
				<td style="padding:10px 30px 0px;text-align:center;border-collapse:collapse;background:#ffffff;">
					<table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="240">
						<tbody>
							<tr>
								<td align="center">
								<img src="https://www.djkn.kemenkeu.go.id/static/lelang/email/divider.png" editable="true" style="display: block;" alt="divider" height="4" width="240">
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
	        <!-- Akhir Divider -->
	        
			<!-- Tips Keamanan -->
			<tr>
				<td style="padding:30px;text-align:justify;border-collapse:collapse;background:#ffffff;">
					
					<table class="section-item" align="left" border="0" cellpadding="0" cellspacing="0" width="100%"><tbody>
						<tr>
							<td style="padding-right:20px;">
								<img src="https://www.djkn.kemenkeu.go.id/static/lelang/email/icon-tips-keamanan.png" editable="true" style="display: block;" alt="petunjuk penggunaan" height="150" width="150">
							</td>
							<td>
								<table class="section-item" align="left" border="0" cellpadding="0" cellspacing="0" width="100%"><tbody>
									<tr>
										<td mc:edit="title4" style="color: #013569; font-size: 17px; font-weight: bold; font-family: Helvetica, Arial, sans-serif;" class="section-title">
										Tips Keamanan
										</td>	
									</tr>
									<tr><td height="5"></td></tr>
									<tr>
										<td mc:edit="subtitle4" style="color: #111; font-size: 14px; font-family: Helvetica, Arial, sans-serif; line-height: 24px;">
										Tidak lupa kami juga menyarankan agar Anda meluangkan waktu sejenak untuk membaca tips-tips keamanan yang telah kami susun, sehingga kerahasiaan dan keamanan transaksi yang Anda lakukan tetap terjaga. 
										<br /><br />
										<a href="<?php echo base_url().'tips_keamanan'; ?>" style="text-decoration:none;"><span style="color: #FFF; border: solid 1px #003568;background-color:#428bca;margin-top:20px;padding: 7px 15px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">Baca Tips Keamanan </span></a>
										</td>
									</tr>
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
				
				</td>
			</tr>
			<!-- Akhir Tips Keamanan -->
	        
	        <!-- Divider -->
			<tr>
				<td style="padding:30px 0px;text-align:center;border-collapse:collapse;background:#ffffff;">
					<table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="240">
						<tbody>
							<tr>
								<td align="center">
								<img src="https://www.djkn.kemenkeu.go.id/static/lelang/email/divider.png" editable="true" style="display: block;" alt="divider" height="4" width="240">
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
	        <!-- Akhir Divider -->
			
<?php $this->load->view('email/peringatan_penipuan'); ?>

<?php $this->load->view('email/footer'); ?>