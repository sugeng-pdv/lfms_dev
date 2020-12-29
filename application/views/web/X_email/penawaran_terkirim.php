<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<style type="text/css">
			.wrap{
				width: 100%;
				height: 100%;
				background-color:#FAFAFA;
				margin: 0px;
				padding: 0px;
			}

			.container{
				margin: 0 auto;
				width: 600px;
			}
			.header{
				text-align: left;
				padding: 20px;
			}
			.body{
				border: 1px solid #DDDDDD;
				background-color:#FFF;
				padding: 20px;
				margin-bottom: 15px;
				/*@editable*/ color:#505050;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:14px;
				/*@editable*/ line-height:150%;
				/*@editable*/ text-align:left;
			}
			
			.link{
				background-color:#FAFAFA;
				border:0;
				padding: 10px;
				margin: 10px 0 10px 0;
				text-align: center;
			}

			h1, .h1{
				color:#202020;
				display:block;
				font-family:Arial;
				font-size:34px;
				font-weight:bold;
				line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
			}

			h2, .h2{
				 color:#202020;
				display:block;
				 font-family:Arial;
				 font-size:30px;
				 font-weight:bold;
				 line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
			}

			h3, .h3{
				 color:#202020;
				display:block;
				 font-family:Arial;
				 font-size:26px;
				 font-weight:bold;
				 line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
			}

			h4, .h4{
				 color:#202020;
				display:block;
				 font-family:Arial;
				 font-size:22px;
				 font-weight:bold;
				 line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
			}

		</style>
	<div class="wrap">
		<div class="container">
			<div class="header">
				<h1>Penawaran Lelang</h1>
			</div>
			<div class="body">
                <h4 class="h4">YTH. <?php if (isset($nama)){ echo $nama; } ?></h4>
                Bersama ini kami informasikan bahwa kami telah menerima penawaran yang Anda kirim dengan detail berikut:
                <br /><br />
				Objek Lelang : <?php if (isset($objek_lelang)){ echo $objek_lelang; } ?><br />
				Kode Lelang : <?php if (isset($kode_lelang)){ echo $kode_lelang; } ?><br />
				Kode Penawaran Anda : <?php if (isset($kode_penawaran)){ echo $kode_penawaran; } ?><br />
				Nilai Penawaran Anda : <?php if (isset($nilai_penawaran)){ echo $nilai_penawaran; } ?><br />
                <br /><br />
				<b>Informasi Penting :</b><br />
				Untuk menghindari penipuan, sistem kami TIDAK PERNAH mengirim email maupun SMS yang berisi informasi nomor rekening pembayaran maupun instruksi untuk melakukan transfer ke rekening tertentu.<br />
				Informasi rekening, rincian pelunasan serta petunjuk pembayaran hanya terdapat website kami (lelangdjkn.kemenkeu.go.id).<br />
			</div>
			<div class="footer">
			</div>
		</div>
	</div>