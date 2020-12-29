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
	        		<center><span style="color: #013569; font-size: 24px; font-family: Helvetica, Arial, sans-serif;" class="main-header" align="center">PEMULIHAN AKUN</span></center>
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
							Yth. <?php if (isset($nama)){ echo $nama; } ?>
							</td>	
						</tr>
						<tr><td height="15"></td></tr>
						<tr>
							<td mc:edit="subtitle4" style="color: #111; font-size: 14px; font-family: Helvetica, Arial, sans-serif; line-height: 24px;">
							Berdasarkan permintaan Anda untuk memulihkan akun, berikut ini kami sampaikan informasi dan petunjuk untuk memulihkan akun Anda:
							<br /><br />
							Email : <?php if (isset($email)){ echo $email; } ?><br />
							Password Sementara : <?php if (isset($temp_pwd)){ echo $temp_pwd; } ?><br />
			                <br />
							<strong>Petunjuk Pemulihan Akun:</strong><br />
							<ol>
								<li>Kunjungi tautan berikut ini: <a target="_blank" href="<?php $pid = random_string('alnum', 15); echo base_url().'recovery/signin?no-cache='.$pid; ?>"><?php echo base_url().'recovery/signin?no-cache='.$pid; ?></a></li>
								<li>Masukkan email dan password sementara. Jika berhasil, Anda akan diarahkan menuju halaman "Ganti Password".</li>
								<li>Masukkan lagi password sementara, lalu segera masukkan password baru sesuai keinginan Anda.</li>
								<li>Selesai!</li>
							</ol>
			                Perlu diingat bahwa password sementara tersebut <b>hanya berlaku selama 30 menit</b> sejak email ini dikirim dari server kami.<br /><br/>
							<span style="color: #F00;">Abaikan email ini jika Anda tidak pernah mengirimkan permintaan untuk pemulihan akun Anda.</span>
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
			<!-- Akhir Isi Email -->
			
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

<?php $this->load->view('email/footer'); ?>