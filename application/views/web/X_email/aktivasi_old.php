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
                Anda berhasil mendaftar pada sistem lelang Direktorat Jenderal Kekayaan Negara. Berikut ini informasi akun Anda:
                <br /><br />
				Email : <?php if (isset($email)){ echo $email; } ?><br />
				Kode Aktivasi : <?php if (isset($act_code)){ echo $act_code; } ?><br />
                <br />
                Harap diingat bahwa akun Anda baru dapat digunakan setelah Anda mengaktifkannya pada halaman berikut ini:<br />
				<div class="link">
					&nbsp;<a href="<?php echo base_url().'activate'; ?>"><?php echo base_url().'activate'; ?></a>&nbsp;
				</div>
				Jika tautan tersebut tidak bekerja, Anda dapat mengaktifkan secara manual dengan mengunjungi alamat <b><?php echo base_url().'activate'; ?></b>, lalu masukkan alamat email dan kode aktivasi Anda pada form yang disediakan.
			</div>
			<div class="footer">
			</div>
		</div>
	</div>