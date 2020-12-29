<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SuratTugas extends CI_Controller {
	 public function __construct(){
		 parent::__construct();
 		 $this->load->helper('url');
 		 $this->load->helper('form');
	 	 $this->load->library('main_library');
		 $this->load->library('MX_Encryption');
	 	 $this->main_library->check_login();
 		 $this->API=API_LMAN;
	 }
	protected function getdataurl($url){
		$uri = API_LMAN.'/'.$url;
		$apiKey = 'Lman@123';
		$params = array(
			'Content-Type: application/json',
			'x-api-key:'.$apiKey
			);
			$apiUser ="admin";
			$apiPass = "1234";

		$ch = curl_init($uri);
		// curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");

		// $data  = json_decode(curl_exec($ch));
		$data  = json_decode(curl_exec($ch));
		// echo $data;die();
 		return $data;
 	}

 	protected function senddataurl($url,$data,$type){
 		$time = time();
 		$uri = API_LMAN.'/'.$url;
 		// die($uri);
		 $apiKey = 'Lman@123';
		 // API auth credentials
		$apiUser = "admin";
		$apiPass = "1234";
 		$params = array(
 			'Content-Type: application/x-www-form-urlencoded',
 			'x-api-key:'.$apiKey
 			);

 		$ch = curl_init($uri);
 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$type);
 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 		curl_setopt($ch, CURLOPT_HEADER, false);
 		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
 		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
 		$ex = curl_exec($ch);
 		$result  = json_decode($ex);
 		// $ex = curl_exec($ch);
 		//  $result  = json_encode($ex);
 		//    echo $result;
 		#debug file
 				 // file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
 					// array(
 					// 	"body" => $ex,
 					// 	"url" => $uri,
 					// 	"data" => $data,
 				 // ),true), FILE_APPEND);
 		return $result;
 	}
 	
 	
	function tanggal_indo($tanggal)
	{
			$bulan = array (1 =>   'Januari',
						'Februari',
						'Maret',
						'April',
						'Mei',
						'Juni',
						'Juli',
						'Agustus',
						'September',
						'Oktober',
						'November',
						'Desember'
					);
			$split = explode('-', $tanggal);
			return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	}
	public function cetak_st($no_st){
		$this->load->helper('pdf_helper');
		tcpdf();
		

		// $this->load->helper('cetakan_helper');
			$id    = $this->mx_encryption->decrypt($no_st);
	    	// $id    = $this->mx_encryption->decrypt('533364506e011707360537200b0f7d715567650b680a475461');
			// print_r($id);die();
			// $id=405;
			$dataSt = $this->getdataurl('perjadin/Perjadin/detailSt/'.$id);
			$dataSpd = $this->getdataurl('perjadin/Perjadin/detailSpd/'.$id);
			$jumlahSdp = $this->getdataurl('perjadin/Perjadin/JumlahSpd/'.$id);
			$SetMargin = $this->getdataurl('perjadin/Perjadin/GetMargin');
			// print($dataSt[0]->jenis_st);die();
			$margin = $SetMargin[0]->nm_margin;
			// $margin =0;
			// if($jumlahSdp == 7){
			// 	$margin =55;
			// }elseif ($jumlahSdp >7 && $jumlahSdp <=8){
			// 	$margin =40;
			// }elseif ($jumlahSdp >8 && $jumlahSdp <10){
			// 	$margin =10;
			// }elseif ($jumlahSdp >=10 && $jumlahSdp <12){
			// 	$margin =25;
			// }elseif ($jumlahSdp >=12 && $jumlahSdp <15){
			// 	$margin =5;
			// }
			// print_r($dataSpd->Countable);die();
			// print_r($jumlahSdp."dhfjdf".$id);die();

			// $jumlahPegawaiSpd = $this->getdataurl('perjadin/Perjadin/JumlahPegawaiSt/'.$id);
			// echo  $dataSt[0]->tgl_mulai;die();
			$tgl_mulai = $dataSt[0]->tgl_mulai;
			$tgl_selesai = $dataSt[0]->tgl_selesai;
			$tgl_tugas = tanggal_indo($tgl_mulai)." s.d ".tanggal_indo($tgl_selesai);
			// print_r($dataSt[0]->type_st);die();
			if($dataSt[0]->kd_dipa =="NON_DIPA"){
				$biaya="tidak";
			}else {
				$biaya="";
			}
			// print_r($dataSt[0]->tgl_st);die();

			if($dataSt[0]->stat_plh == 1){
				$jdlTtd		 = "Plh. Direktur Utama";
				$NmPejabat = $dataSt[0]->nm_plh;
			}else{
				if($dataSt[0]->tgl_st < "2020-11-11"){
					if($dataSt[0]->tgl_st > "2020-03-06" && $dataSt[0]->tgl_st <= "2020-03-12"){
						$info 	=  "";
						$jdlTtd		 = "Plt. Direktur Utama";
						$NmPejabat = "Rahayu Puspasari";
					}elseif($dataSt[0]->tgl_st > '2020-03-12' && $dataSt[0]->tgl_st < '2020-04-06'){
						$info 	=  "";
						$jdlTtd		 = "Plt. Direktur Utama";
						$NmPejabat = "Basuki Purwadi";
					}elseif($dataSt[0]->tgl_st > '2020-04-05'){
						$info 	=  "";
						$jdlTtd		 = "Direktur Utama";
						$NmPejabat = "Basuki Purwadi";
					}
					else{
						$info 	=  "";
						$jdlTtd		 = "Direktur Utama";
						$NmPejabat = "Rahayu Puspasari";
					}
				}else{
					if($dataSt[0]->type_st == 1){
						if($dataSt[0]->jenis == 10){
							$info 	=  "a.n Direktur Utama";
							$jdlTtd		 = "Direktur Keuangan dan Organisasi";
							$NmPejabat = "Sutanto Basuki";
						}else{
							$info 	=  "";
							$jdlTtd		 = "Direktur Utama";
							$NmPejabat = "Basuki Purwadi";
						}
					}if($dataSt[0]->type_st == 2){
						$info 	=  "";
						$jdlTtd		 = "Direktur Utama";
						$NmPejabat = "Basuki Purwadi";
					}else{
						$info 	=  "a.n Direktur Utama ";
						$jdlTtd		 = "Direktur Keuangan dan Organisasi";
						$NmPejabat = "Sutanto Basuki";
					}

				}
				
			}
			// print_r($jdlTtd	);die();
			$selisih = strtotime($dataSt[0]->tgl_selesai) -  strtotime($dataSt[0]->tgl_mulai);
			$lama = ($selisih/(60*60*24)+1);
			// print_r($dataSt[0]->perihal);
			$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      		$pdf->SetMargins(20.9,10, 12.9);
			$pdf->SetAutoPageBreak(true,$margin);
			// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetPrintHeader(false);
			$pdf->AddPage();
			$header = '<table>
								<tr>
										<td ROWSPAN="5" width="80" valign="bottom"><img width="300" height="280" src="'.IMAGES_PDF_.'logo_kop.jpg"></td>
										<td COLSPAN="1" width="10"></td>
										<td COLSPAN="4" align="center" width="400">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</td>


								</tr>';
			$header .='<tr>
								<td COLSPAN="1" width="10">&nbsp;</td>
								<td COLSPAN="4" align="center" width="400"><font face="Arial:bold" size="11">DIREKTORAT JENDERAL KEKAYAAN NEGARA</font></td>
								</tr>';
			$header .='<tr>
								<td COLSPAN="1" width="10">&nbsp;</td>
								<td COLSPAN="4" align="center" width="400"><font face="Arial:bold" size="11">LEMBAGA MANAJEMEN ASET NEGARA</font></td>
								</tr>';
			$header .='<tr>
								<td COLSPAN="1" width="10">&nbsp;</td>
								<td COLSPAN="4" align="center" width="400">&nbsp;</td>
								</tr>';
			$header .='<tr>
								<td COLSPAN="1" width="10">&nbsp;</td>
								<td COLSPAN="4" align="center" width="400"><font face="Arial" size="7">GEDUNG DHANADYAKSA HUTAMA,JALAN DIPONEGORO NOMOR 62A PEGANGSAAN, MENTENG, JAKARTA PUSAT<br>TELEPON 021-21392822; FAKSIMILE 021-21392823; LAMAN www.lman.kemenkeu.go.id</font></td>
								</tr>';

			$header .='</table>';
			$header .='<hr>';
			$judul = '<table>
								<tr>
										<td COLSPAN="10" align="center">SURAT TUGAS<br>'.$dataSt[0]->no_st.'</td>
								</tr></table>';

		 $isi 		= '<table>
		 							<tr>
										<td COLSPAN="1" width="20"></td>
										<td COLSPAN="4" width="480">Dalam rangka melaksanakan tugas berdasarkan Nota Dinas Nomor: '.$dataSt[0]->no_nd.'</td></tr>';
		$isi 		.= '<tr>
									 <td COLSPAN="5">tanggal '.tanggal_indo($dataSt[0]->tgl_nd).', kami menugasi:</td>
									 </tr>';
		$isi 		.= '<tr>
									 <td COLSPAN="5"></td>
									 </tr>';
		$noUrut = 1;
	 foreach ($dataSpd as $dataSpd2) {
		 $tgl_mulaiSpd = $dataSpd2->tgl_mulaiSt;
		 $tgl_selesaiSpd = $dataSpd2->tgl_selesaiSt;
		 $tgl_tugasSpd = tanggal_indo($tgl_mulaiSpd)." s.d ".tanggal_indo($tgl_selesaiSpd);
		 

		if($dataSt[0]->jenis_st == "Internal"){
			$dataPegawai = $this->getdataurl('Users/'.$dataSpd2->nip_spd);
			$statusPegawai = $dataPegawai[0]->k_jab;
			if($statusPegawai == "Honorer"){
				$jabatan = "Honorer";
			}else{
				$jabatan = $dataPegawai[0]->d_jabatan;
			}
		}else{
			$dataPegawai = $this->getdataurl('Users/UserExt/'.$dataSpd2->nip_spd);
			// print_r($dataPegawai[0]->panggol);die();
			$jabatan = $dataPegawai[0]->panggol;
		}
		// print($dataSt[0]->is_st_covid);die();
	if($dataSt[0]->is_st_covid == 1){
		$perihal = $dataSt[0]->perihal;
	}else{
		$perihal = $dataSt[0]->perihal.' di '.$dataSt[0]->kota_tujuan;
	}
	 $panggol = $dataPegawai[0]->panggol;
	 if($panggol== "" || empty($panggol)){
		 $panggol ="-";
	 }
	 if ($dataSt[0]->jenis_st == "Internal") {
	 	$namaPeg = $dataPegawai[0]->nama;
	 }else{
			$namaPeg =$dataPegawai[0]->nmpeg;
	 }
	 $isi 		.= '<tr>
	 								<td COLSPAN="1" width="20"></td>
									<td ROWSPAN="4" width="18">'.$noUrut++.'.</td>
									<td COLSPAN="1" width="110">Nama</td>
									<td COLSPAN="1" width="5">:</td>
									<td COLSPAN="1" width="347">'.$namaPeg.'</td>
									</tr>
									<tr>
							 	 	<td COLSPAN="1" width="20"></td>
							 		<td COLSPAN="1" width="110">Pangkat / Golongan</td>
							 		<td COLSPAN="1" width="5">:</td>
							 		<td COLSPAN="1" width="347">'.$panggol.'</td>
							 		</tr>
									<tr>
							 	 	<td COLSPAN="1" width="20"></td>
							 		<td COLSPAN="1" width="110">Jabatan</td>
							 		<td COLSPAN="1" width="5">:</td>
							 		<td COLSPAN="1" width="347">'.$jabatan.'</td>
							 		</tr>
									<tr>
							 	 	<td COLSPAN="1" width="20"></td>
							 		<td COLSPAN="1" width="110">Tanggal Penugasan</td>
							 		<td COLSPAN="1" width="5">:</td>
							 		<td COLSPAN="1" width="347">'.$tgl_tugasSpd.'</td>
							 		</tr>';
								}
		$isi 			.='</table>';
		$isi_detail ='<table border="0">
											<tr>
												<td>Untuk melaksanakan perjalanan dinas dalam rangka '.$perihal.'. Biaya Perjalanan dinas ini '.$biaya.' dibebankan pada '.$dataSt[0]->sumber_dipa.'.</td>
											</tr>
											<tr height="28">
												<td></td>
											</tr>
											<tr height="28">
												<td></td>
											</tr>
											<tr>
												<td>Surat Tugas ini disusun untuk dilaksanakan dan setelah selesai dilaksanakan, pelaksana segera menyampaikan laporan. Kepada instansi terkait, kami mohon bantuan demi kelancaran pelaksanaan tugas tersebut.</td>
											</tr>
									</table>';
		// $isi_detail ='<table border="0">
		// 							<tr>
		// 								<td>Untuk melaksanakan '.$dataSt[0]->perihal.'.Biaya Perjalanan dinas ini '.$biaya.' dibebankan pada '.$dataSt[0]->sumber_dipa.'.
		// 								Dalam hal sewaktu diperlukan oleh atasan untuk menyelesaikan tugas di kantor, agar memenuhi perintah tersebut.</td>
		// 							</tr>
		// 							<tr height="28">
		// 								<td></td>
		// 							</tr>
		// 							<tr height="28">
		// 								<td></td>
		// 							</tr>
		// 							<tr>
		// 								<td>Surat Tugas ini disusun untuk dilaksanakan dan setelah selesai dilaksanakan, pelaksana segera menyampaikan laporan. Kepada instansi terkait, kami mohon bantuan demi kelancaran pelaksanaan tugas tersebut.</td>
		// 							</tr>
		// 					</table>';
											$ttd_footer ='<table><tr><td height="20">&nbsp;</td></tr></table>
													<table >
															<tr>
																	<td COLSPAN="9" ROWSPAN="7" align="left" width="250"></td>
																	<td align="Left" width="180">Jakarta,'.tanggal_indo($dataSt[0]->tgl_st).'</td>
															</tr>';

																$ttd_footer .= '
															<tr>
																		<td align="left" width="180">'.$info.'<br>'.$jdlTtd.',</td>
																</tr>
																<tr>
																		<td width="180">&nbsp;</td>
																</tr>
																<tr>
																		<td width="180">&nbsp;</td>
																</tr>
																<tr>
																		<td width="180">&nbsp;</td>
																</tr>
																<tr>
																		<td align="center" width="180"></td>
																</tr>

																<tr>
																		<td align="left" width="180">'.$NmPejabat.'</td>
																</tr>';

															$ttd_footer .= '</table>';

			// return $header;
		// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER,false);
		// $pdf->SetFont('arial','B', 13);
		// $pdf->writeHtml($header, true, false, true, false, '');
		$pdf->SetFont('','B', 13);
		$pdf->writeHtml($header, true, false, true, false, '');
		$pdf->SetFont('Arial','B', 11);
		$pdf->writeHtml($judul, true, false, true, false, '');
		$pdf->writeHtml($isi, true, false, true, false, '');
		$pdf->setFontStretching(100);
		$pdf->setFontSpacing(0.000);
		$pdf->writeHtml($isi_detail, true, false, true, false, 'J');
		// $pdf->writeHtml($isi_penutup, true, false, true, false, 'J');
		$pdf->writeHtml($ttd_footer, true, false, true, false, 'J');
		// $pdf->SetFont('courier', '', 8);
		// $pdf->writeHtml($judul, true, false, false, false, '');
		// $pdf->writeHtml($lampiran, true, false, false, false, '');
		// $pdf->writeHtml($tbl, true, false, false, false, '');
		// $pdf->writeHtml($footer, true, false, false, false, '');
		$pdf->SetY(260);
		// $pdf->writeHtml($ematerai_nota, true, false, false, false, '');
		// $pdf->writeHtml($jml_footer, true, false, false, false, '');
		// $pdf->writeHtml($tgl_footer, true, false, false, false, '');
		// $pdf->writeHtml($barcoded, true, false, false, false, '');
		// $pdf->writeHtml($ttd_footer, true, false, false, false, '');
		//$pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
		// $pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 17, 3, 20, 15, '', '', '', true, 70);
		// $pdf->write1DBarcode($obj->data->proforma_id, 'C128', 3, 30, '', 18, 0.4, $style, 'N');
		//$pdf->write1DBarcode($obj->data->proforma_id,3, 30, '', 18, 0.4, $style, 'N');
		// if (\strpos($dataSt[0]->kota_tujuan,'JAKARTA') !== false) {
		// print_r($dataSt[0]->kota_berangkat);die();
		if ($dataSt[0]->kota_tujuan == "JAKARTA" && $dataSt[0]->kota_berangkat == "JAKARTA") {
			if($dataSt[0]->status_spd == 1){
				$pdf->AddPage();
				$lampiranKanan = '<table>
														<tr>
																<td COLSPAN="1" width="200"></td>
																<td COLSPAN="3" width="250">LAMPIRAN SURAT TUGAS DALAM KOTA</td>
														</tr>
														<tr>
																<td COLSPAN="1" width="200"></td>
																<td COLSPAN="1" width="80">Nomor</td>
																<td COLSPAN="1" width="10">:</td>
																<td COLSPAN="1" width="120">'.$dataSt[0]->no_st.'</td>
														</tr>
														<tr>
																<td COLSPAN="1" width="200"></td>
																<td COLSPAN="1" width="80">Tanggal</td>
																<td COLSPAN="1" width="10">:</td>
																<td COLSPAN="1" width="120">'.tanggal_indo($tgl_mulai).'</td>
														</tr></table>';
				$lampiranIsi ='<table border="1">
												<tr>
													<td ROWSPAN="2" align="center" width="20"><br><br>No.</td>
													<td ROWSPAN="2" align="center" width="170"><br><br>Pelaksana SPD</td>
													<td ROWSPAN="2" align="center" width="50"><br><br>Hari</td>
													<td ROWSPAN="2" align="center" width="85"><br><br>Tanggal</td>
													<td COLSPAN="3" align="center" width="160">Pejabat / Petugas yang mengesahkan</td>
												</tr>
												<tr>
													<td COLSPAN="1" align="center"><br> Nama</td>
													<td COLSPAN="1" align="center"><br> Jabatan</td>
													<td COLSPAN="1" align="center">Tanda Tangan</td>
												</tr>';
												$noTbl =1;
												// $day = date('D', strtotime($tanggal));
												$dayList = array(
													'Sun' => 'Minggu',
													'Mon' => 'Senin',
													'Tue' => 'Selasa',
													'Wed' => 'Rabu',
													'Thu' => 'Kamis',
													'Fri' => 'Jumat',
													'Sat' => 'Sabtu'
												);
											foreach ($dataSpd as $dataSpd2) {
												// print_r($dataSt[0]->no_st);die();
												if($dataSt[0]->jenis_st == "Internal"){
													$dataPegawai = $this->getdataurl('Users/'.$dataSpd2->nip_spd);
													$statusPegawai = $dataPegawai[0]->k_jab;
													$namaPeg = $dataPegawai[0]->nama;
													$nipPeg = $dataPegawai[0]->nip;
													if($statusPegawai == "Honorer"){
														$jabatan = "Honorer";
													}else{
														$jabatan = $dataPegawai[0]->d_jabatan;
													}
												}else{
													$dataPegawai = $this->getdataurl('Users/UserExt/'.$dataSpd2->nip_spd);
													$jabatan = $dataPegawai[0]->panggol;
											 		$namaPeg =$dataPegawai[0]->nmpeg;
													$nipPeg = $dataPegawai[0]->nippeg;
												}
												// print_r($id."----".$dataSpd2->nip_spd);die();
										 	 // $dataPegawai = $this->getdataurl('Users/'.$dataSpd2->nip_spd);
												 $dataStNip = $this->getdataurl('perjadin/Perjadin/detailStNip/'.$id.'/'.$dataSpd2->nip_spd);
												//  print_r($dataStNip);die();
											 	$tgl_mulai2 = $dataStNip[0]->tgl_mulaiSt;
												$tgl_selesai2 = $dataStNip[0]->tgl_selesaiSt;
											 	$tgl_mulai2 = date ("Y-m-d", strtotime("-1 day", strtotime($tgl_mulai2)));
											 	while (strtotime($tgl_mulai2) < strtotime($tgl_selesai2)) {
																	  // echo "$tgl_mulai\n";
													$tgl_mulai2 = date ("Y-m-d", strtotime("+1 day", strtotime($tgl_mulai2)));

				$lampiranIsi .='<tr>
														<td COLSPAN="1" align="center">'.$noTbl.'.</td>
														<td COLSPAN="1" align="left"> '.$namaPeg.'<br> NIP/NPP '.$nipPeg.'</td>';
				$lampiranIsi .=			'<td COLSPAN="1" align="center">'.$dayList[date('D', strtotime($tgl_mulai2))].'</td>
													<td COLSPAN="1" align="center">'.tanggal_indo($tgl_mulai2).'</td>
													<td COLSPAN="1"></td>
													<td COLSPAN="1"></td>
													<td COLSPAN="1"></td>
												</tr>';
												$noTbl++;
											 }
											 
										 }
		  $lampiranIsi .='</table>';
		$lampiranTtd = '<table>
														<tr>
																<td COLSPAN="1" width="280"></td>
																<td COLSPAN="3" width="200">Mengetahui</td>
														</tr>
														<tr>
																<td COLSPAN="1" width="280"></td>
																<td COLSPAN="3" width="200">PPK LMAN</td>
														</tr>
														<tr>
																<td COLSPAN="1" width="280"></td>
																<td COLSPAN="3" width="200"></td>
														</tr>
														<tr>
																<td COLSPAN="1" width="280"></td>
																<td COLSPAN="3" width="200"></td>
														</tr>
														<tr>
																<td COLSPAN="1" width="280"></td>
																<td COLSPAN="3" width="200"></td>
														</tr>
														<tr>
																<td COLSPAN="1" width="280"></td>
																<td COLSPAN="3" width="200"></td>
														</tr>
														<tr>
																<td COLSPAN="1" width="280"></td>
																<td COLSPAN="3" width="200">Luhur Nugroho Joko Hartono</td>
														</tr>
														<tr>
																<td COLSPAN="1" width="280"></td>
																<td COLSPAN="3" width="200">NIP 19760528 200212 1 002</td>
														</tr>
														</table>';

				$pdf->SetFont('Arial','B', 11);
				$pdf->writeHtml($lampiranKanan, true, false, true, false, '');
				$pdf->writeHtml($lampiranIsi, true, false, true, false, '');
				$pdf->writeHtml($lampiranTtd, true, false, true, false, '');
			}
		}

		$output_name = $dataSt[0]->no_st.".pdf";
		$pdf->Output($output_name, 'I');
	}

	

}
