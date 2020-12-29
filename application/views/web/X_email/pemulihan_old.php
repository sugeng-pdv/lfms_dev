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
				<h1>Akun Lelang DJKN</h1>
			</div>
			<div class="body">
                <h4 class="h4">YTH. <?php if (isset($name)){ echo $name; } ?></h4>
                Berdasarkan permintaan Anda untuk memulihkan akun, berikut ini kami sampaikan informasi dan petunjuk untuk memulihkan akun Anda:
                <br /><br />
				Email : <?php if (isset($email)){ echo $email; } ?><br />
				Password Sementara : <?php if (isset($temp_pwd)){ echo $temp_pwd; } ?><br />
                <br />
				<strong>Petunjuk Pemulihan Akun:</strong><br />
				<ol>
					<li>Kunjungi tautan berikut ini: <a target="_blank" href="<?php $pid = random_string('alnum', 10); echo base_url().'recovery/signin?PID='.$pid; ?>"><?php echo base_url().'recovery/signin?PID='.$pid; ?></a></li>
					<li>Masukkan email dan password sementara. Jika berhasil, Anda akan diarahkan menuju halaman "Ganti Password".</li>
					<li>Masukkan lagi password sementara, lalu segera masukkan password baru sesuai keinginan Anda.</li>
					<li>Selesai!</li>
				</ol>
                Perlu diingat bahwa password sementara tersebut <b>hanya berlaku selama 10 menit</b> sejak email ini dikirim dari server kami.<br /><br/>
				<span style="color: #F00;">Jangan hiraukan email ini jika Anda tidak pernah mengirimkan permintaan untuk pemulihan akun Anda.</span>
			</div>
			<div class="footer">
			</div>
		</div>
	</div>